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
use Woisks\Count\Models\Repository\CountRepository;
use Woisks\Count\Models\Repository\LogRepository;

/**
 * Class GetController.
 *
 * @package Woisks\Count\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/14 11:17
 */
class GetController extends BaseController
{
    /**
     * countRepo.  2019/7/28 13:47.
     *
     * @var  CountRepository
     */
    private $countRepo;
    /**
     * logRepo.  2019/7/28 13:47.
     *
     * @var  LogRepository
     */
    private $logRepo;

    /**
     * GetController constructor. 2019/7/28 13:47.
     *
     * @param CountRepository $countRepo
     * @param LogRepository $logRepo
     *
     * @return void
     */
    public function __construct(CountRepository $countRepo, LogRepository $logRepo)
    {
        $this->countRepo = $countRepo;
        $this->logRepo   = $logRepo;
    }


    /**
     * count. 2019/7/28 13:47.
     *
     * @param $type
     * @param $numeric
     *
     * @return JsonResponse
     */
    public function count($type, $numeric)
    {
        $db = $this->countRepo->all($type, $numeric);

        if ($db->isEmpty()) {
            return res(404, 'data not exists ');
        }

        return res(200, 'success', $db);
    }

    /**
     * logs. 2019/7/28 14:06.
     *
     * @param $model
     * @param $type
     * @param $numeric
     *
     * @return JsonResponse
     */
    public function logs($model, $type, $numeric)
    {
        if ($type == 'all') {

            if (!is_null($db = $this->logsAll($model, $numeric))) {
                return res(200, 'success', $db);
            }

        }

        if (!is_null($db = $this->logsLog($model, $type, $numeric))) {
            return res(200, 'success', $db);
        }

        return res(404, 'data not exists ');
    }

    /**
     * logsAll. 2019/7/28 14:41.
     *
     * @param $model
     * @param $numeric
     *
     * @return mixed|null
     */
    private function logsAll($model, $numeric)
    {
        $db = $this->logRepo->logsAll($model, $numeric);
        if ($db->isEmpty()) {
            return null;
        }
        return $db;
    }

    /**
     * logsLog. 2019/7/28 14:41.
     *
     * @param $model
     * @param $type
     * @param $numeric
     *
     * @return mixed|null
     */
    private function logsLog($model, $type, $numeric)
    {
        $db = $this->logRepo->logs($model, $type, $numeric);
        if ($db->isEmpty()) {
            return null;
        }
        return $db;
    }

    /**
     * user. 2019/7/28 14:20.
     *
     * @param $uid
     * @param $model
     * @param $type
     *
     * @return JsonResponse
     */
    public function user($model, $type, $uid)
    {
        if ($type == 'all') {

            if (!is_null($db = $this->userAll($model, $uid))) {
                return res(200, 'success', $db);
            }
        }

        if (!is_null($db = $this->userLog($model, $type, $uid))) {
            return res(200, 'success', $db);
        }

        return res(404, 'data not exists ');
    }

    /**
     * userAll. 2019/7/28 14:37.
     *
     * @param $model
     * @param $uid
     *
     * @return mixed|null
     */
    private function userAll($model, $uid)
    {
        $db = $this->logRepo->userAll($model, $uid);
        if ($db->isEmpty()) {
            return null;
        }
        return $db;
    }

    /**
     * userLog. 2019/7/28 14:37.
     *
     * @param $model
     * @param $type
     * @param $uid
     *
     * @return mixed|null
     */
    private function userLog($model, $type, $uid)
    {
        $db = $this->logRepo->user($model, $type, $uid);
        if ($db->isEmpty()) {
            return null;
        }
        return $db;
    }
}
