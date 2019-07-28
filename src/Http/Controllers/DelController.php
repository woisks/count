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


use Illuminate\Http\JsonResponse;
use Woisks\Count\Http\Requests\DelRequest;
use Woisks\Count\Models\Repository\CountRepository;
use Woisks\Count\Models\Repository\LogRepository;
use Woisks\Count\Models\Repository\TypeRepository;
use Woisks\Jwt\Services\JwtService;

/**
 * Class DelController.
 *
 * @package Woisks\Count\Http\Controllers
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/7/28 13:43
 */
class DelController extends BaseController
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
     * CreateController constructor. 2019/7/28 12:31.
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
     * del. 2019/7/28 13:43.
     *
     * @param DelRequest $request
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function del(DelRequest $request)
    {
        $numeric = $request->get('numeric');
        $model   = $request->get('model');
        $type    = $request->get('type');


        if (!$type_db = $this->typeRepo->first($model, $type)) {
            return res(404, 'param model type error or not exists');
        }

        if (!$this->logRepo->exists($model, $type, $numeric, JwtService::jwt_account_uid())) {
            return res(404, 'data not exists');
        }

        try {
            \DB::beginTransaction();

            $type_db->decrement('count');
            $this->countRepo->decrement($model, $type, $numeric);
            $this->logRepo->delete($model, $type, $numeric, JwtService::jwt_account_uid());

        } catch (\Throwable $e) {

            \DB::rollBack();
            return res(500, 'Come back later');
        }
        \DB::commit();
        return res(200, 'success');
    }
}
