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


use Woisks\Count\Http\Requests\GetUserRequest;
use Woisks\Count\Models\Services\GetUserService;

/**
 * Class UserCountController.
 *
 * @package Woisks\Count\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/14 10:52
 */
class UserCountController extends BaseController
{
    /**
     * getUserService.  2019/6/14 10:52.
     *
     * @var  \Woisks\Count\Models\Services\GetUserService
     */
    private $getUserService;

    /**
     * UserCountController constructor. 2019/6/14 10:52.
     *
     * @param \Woisks\Count\Models\Services\GetUserService $getUserService
     *
     * @return void
     */
    public function __construct(GetUserService $getUserService)
    {
        $this->getUserService = $getUserService;
    }


    public function get(GetUserRequest $request)
    {
        $model = $request->get('model');
        $type = $request->get('type');
        $sort = $request->get('desc');

        return $this->getUserService->whereGetd($model, $type, $sort);
    }
}