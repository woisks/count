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
use Woisks\Count\Http\Requests\CreateRequest;
use Woisks\Count\Models\Repository\CountRepository;
use Woisks\Count\Models\Repository\LogRepository;
use Woisks\Count\Models\Repository\TypeRepository;
use Woisks\Jwt\Services\JwtService;

/**
 * Class CreateController.
 *
 * @package Woisks\Count\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/14 9:51
 */
class CreateController extends BaseController
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
     * create. 2019/7/28 13:22.
     *
     * @param CreateRequest $request
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function create(CreateRequest $request)
    {
        $numeric = $request->get('numeric');
        $model   = $request->get('model');
        $type    = $request->get('type');


        if (!$type_db = $this->typeRepo->first($model, $type)) {
            return res(404, 'param type error or not exists');
        }

        if ($this->logRepo->exists($model, $type, $numeric, JwtService::jwt_account_uid())) {
            return res(200, 'success');
        }

        try {
            DB::beginTransaction();

            $type_db->increment('count');
            $count = $this->countRepo->firstOrCreated($model, $type, $numeric);
            $this->logRepo->created($model, $type, $numeric, JwtService::jwt_account_uid());

        } catch (Throwable $e) {

            DB::rollBack();
            return res(500, 'Come back later');
        }

        DB::commit();
        return res(200, 'success', $count);
    }
}
