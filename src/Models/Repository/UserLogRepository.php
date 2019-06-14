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


use Woisks\Count\Models\Entity\UserLogEntity;
use Woisks\Jwt\Services\JwtService;

/**
 * Class UserLogRepository.
 *
 * @package Woisks\Count\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/13 10:35
 */
class UserLogRepository
{
    /**
     * model.  2019/6/13 10:35.
     *
     * @var static \Woisks\Count\Models\Entity\UserLogEntity
     */
    private static $model;

    /**
     * UserLogRepository constructor. 2019/6/13 10:35.
     *
     * @param \Woisks\Count\Models\Entity\UserLogEntity $userLog
     *
     * @return void
     */
    public function __construct(UserLogEntity $userLog)
    {
        self::$model = $userLog;
    }

    /**
     * created. 2019/6/14 9:45.
     *
     * @param int    $numeric
     * @param string $model
     * @param string $type
     * @param int    $account_uid
     *
     * @return mixed
     */
    public function created(int $numeric, string $model, string $type, int $account_uid)
    {
        return self::$model->create([
            'id'            => create_numeric_id(),
            'account_uid'   => $account_uid,
            'count_numeric' => $numeric,
            'model_name'    => $model,
            'type'          => $type,
        ]);
    }

    /**
     * whereGet. 2019/6/14 10:52.
     *
     * @param $model
     * @param $type
     * @param $desc
     *
     * @return mixed
     */
    public function whereGet($model, $type, $desc)
    {

        return self::$model->where('account_uid', JwtService::jwt_account_uid())
                           ->when($model, function ($query) use ($model) {
                               return $query->where('model_name', $model);
                           })
                           ->when($type, function ($query) use ($type) {
                               return $query->where('type', $type);
                           })
                           ->when($desc, function ($query) {
                               return $query->orderBy('created_at', 'desc');
                           })->get();
    }
}