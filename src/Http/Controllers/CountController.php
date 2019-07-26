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


use Illuminate\Http\Request;
use Woisks\Count\Models\Services\GetCountService;

/**
 * Class CountController.
 *
 * @package Woisks\Count\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/14 11:17
 */
class CountController extends BaseController
{
    /**
     * countService.  2019/6/14 11:17.
     *
     * @var  \Woisks\Count\Models\Services\GetCountService
     */
    private $countService;

    /**
     * CountController constructor. 2019/6/14 11:17.
     *
     * @param \Woisks\Count\Models\Services\GetCountService $countService
     *
     * @return void
     */
    public function __construct(GetCountService $countService)
    {
        $this->countService = $countService;
    }

    /**
     * get. 2019/6/14 11:17.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function get(Request $request)
    {
        $numeric = $request->get('numeric');
        $model = $request->get('model');
        $type = $request->get('type');

        $db = $this->countService->whereGetd($numeric, $model, $type);

        if ($db->isEmpty()) {
            return res(404, 'param error ');
        }

        return res(200, 'success', $db);
    }
}