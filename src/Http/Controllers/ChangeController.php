<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <bolelin@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

namespace Woisks\Count\Http\Controllers;


use DB;
use Illuminate\Http\JsonResponse;
use Throwable;
use Woisks\Count\Http\Requests\ChangeRequest;
use Woisks\Count\Models\Repository\CountRepository;
use Woisks\Count\Models\Repository\LogRepository;
use Woisks\Count\Models\Repository\TypeRepository;
use Woisks\Jwt\Services\JwtService;

/**
 * Class ChangeController.
 *
 * @package Woisks\Count\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/14 9:51
 */
class ChangeController extends BaseController
{
    /**
     * countRepo.  2019/7/28 12:31.
     *
     * @var  CountRepository
     */
    private $countRepo;
    /**
     * typeRepo.  2019/7/28 12:31.
     *
     * @var  TypeRepository
     */
    private $typeRepo;
    /**
     * logRepo.  2019/7/28 12:31.
     *
     * @var  LogRepository
     */
    private $logRepo;

    /**
     * ChangeController constructor. 2019/7/28 12:31.
     *
     * @param CountRepository $countRepo
     * @param TypeRepository $typeRepo
     * @param LogRepository $logRepo
     *
     * @return void
     */
    public function __construct(CountRepository $countRepo, TypeRepository $typeRepo, LogRepository $logRepo)
    {
        $this->countRepo = $countRepo;
        $this->typeRepo  = $typeRepo;
        $this->logRepo   = $logRepo;
    }


    /**
     * change. 2019/7/28 13:22.
     *
     * @param ChangeRequest $request
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function change(ChangeRequest $request)
    {
        $numeric = $request->get('numeric');
        $model   = $request->get('model');
        $type    = $request->get('type');

        $type_db = $this->typeRepo->first($model, $type);
        if (!$type_db) {
            //效验模块类型合法性
            return res(404, 'param type not exists');
        }

        $account_uid = JwtService::jwt_account_uid();

        if ($this->logRepo->exists($model, $type, $numeric, $account_uid)) {
            //如果存在取消并递减
            try {
                \DB::beginTransaction();

                $type_db->decrement('count');
                $this->countRepo->decrement($model, $type, $numeric);
                $this->logRepo->delete($model, $type, $numeric, $account_uid);

            } catch (\Throwable $e) {

                \DB::rollBack();
                return res(500, 'Come back later');
            }

            \DB::commit();
            return res(200, 'cancel success');
        }

        //如果不存在创建记录递增
        try {
            DB::beginTransaction();

            $type_db->increment('count');
            $count = $this->countRepo->firstOrCreated($model, $type, $numeric);
            $this->logRepo->created($model, $type, $numeric, $account_uid);

        } catch (Throwable $e) {

            DB::rollBack();
            return res(500, 'Come back later');
        }

        DB::commit();
        return res(200, 'success', $count);

    }


}
