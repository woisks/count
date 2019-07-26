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
use Throwable;
use Woisks\Count\Http\Requests\CreateRequest;
use Woisks\Count\Models\Services\CreateService;
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
     * createService.  2019/6/14 9:51.
     *
     * @var  \Woisks\Count\Models\Services\CreateService
     */
    private $createService;

    /**
     * CreateController constructor. 2019/6/14 9:51.
     *
     * @param \Woisks\Count\Models\Services\CreateService $createService
     *
     * @return void
     */
    public function __construct(CreateService $createService)
    {
        $this->createService = $createService;
    }


    /**
     * create. 2019/7/26 10:56.
     *
     * @param \Woisks\Count\Http\Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function create(CreateRequest $request)
    {
        $numeric = $request->get('numeric');
        $model = $request->get('model');
        $type = $request->get('type');

        $model_count = $this->createService->first($model, $type);

        if (!$model_count) {
            return res(422, 'param error');
        }

        try {
            DB::beginTransaction();

            $model_count->increment('count');

            $count = $this->createService->count((int)$numeric, $model, $type);
            $this->createService->userLog((int)$numeric, $model, $type, JwtService::jwt_account_uid());

        } catch (Throwable $e) {
            DB::rollBack();

            return res(422, 'param error');
        }
        DB::commit();

        return res(200, 'success', [$count]);
    }
}