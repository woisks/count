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

namespace Woisks\Count\Models\Repository;


use Woisks\Count\Models\Entity\LogEntity;

/**
 * Class LogRepository.
 *
 * @package Woisks\Count\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/13 10:35
 */
class LogRepository
{

    /**
     * model.  2019/7/28 14:27.
     *
     * @var static LogEntity
     */
    private static $model;


    /**
     * LogRepository constructor. 2019/7/28 14:27.
     *
     * @param LogEntity $userLog
     *
     * @return void
     */
    public function __construct(LogEntity $userLog)
    {
        self::$model = $userLog;
    }

    /**
     * created. 2019/7/28 13:21.
     *
     * @param $model
     * @param $type
     * @param $numeric
     * @param $account_uid
     *
     * @return mixed
     */
    public function created($model, $type, $numeric, $account_uid)
    {
        return self::$model->create([
            'id'          => create_numeric_id(),
            'account_uid' => $account_uid,
            'model'       => $model,
            'type'        => $type,
            'numeric'     => $numeric,
        ]);
    }

    /**
     * exists. 2019/7/28 13:20.
     *
     * @param $model
     * @param $type
     * @param $numeric
     * @param $account_uid
     *
     * @return mixed
     */
    public function exists($model, $type, $numeric, $account_uid)
    {
        return self::$model->where('account_uid', $account_uid)->where('model', $model)->where('type', $type)->where('numeric', $numeric)->exists();
    }

    /**
     * delete. 2019/7/28 13:36.
     *
     * @param $model
     * @param $type
     * @param $numeric
     * @param $account_uid
     *
     * @return mixed
     */
    public function delete($model, $type, $numeric, $account_uid)
    {
        return self::$model->where('account_uid', $account_uid)->where('model', $model)->where('type', $type)->where('numeric', $numeric)->delete();
    }

    /**
     * logs. 2019/7/28 14:04.
     *
     * @param $model
     * @param $type
     * @param $numeric
     *
     * @return mixed
     */
    public function logs($model, $type, $numeric)
    {
        return self::$model->where('numeric', $numeric)->where('model', $model)->where('type', $type)->paginate();
    }

    /**
     * logsAll. 2019/7/28 14:27.
     *
     * @param $model
     * @param $numeric
     *
     * @return mixed
     */
    public function logsAll($model, $numeric)
    {
        return self::$model->where('numeric', $numeric)->where('model', $model)->paginate();
    }

    /**
     * user. 2019/7/28 14:16.
     *
     * @param $model
     * @param $type
     * @param $account_uid
     *
     * @return mixed
     */
    public function user($model, $type, $account_uid)
    {
        return self::$model->where('account_uid', $account_uid)
            ->where('model', $model)
            ->where('type', $type)
            ->paginate();
    }

    /**
     * userAll. 2019/7/28 14:16.
     *
     * @param $model
     * @param $account_uid
     *
     * @return mixed
     */
    public function userAll($model, $account_uid)
    {
        return self::$model->where('account_uid', $account_uid)->where('model', $model)->paginate();
    }
}
