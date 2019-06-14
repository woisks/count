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


use Woisks\Count\Models\Entity\CountEntity;

/**
 * Class CountRepository.
 *
 * @package Woisks\Count\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/12 18:06
 */
class CountRepository
{
    /**
     * model.  2019/6/12 18:06.
     *
     * @var static \Woisks\Count\Models\Entity\CountEntity
     */
    private static $model;

    /**
     * CountRepository constructor. 2019/6/12 18:06.
     *
     * @param \Woisks\Count\Models\Entity\CountEntity $count
     *
     * @return void
     */
    public function __construct(CountEntity $count)
    {
        self::$model = $count;
    }

    /**
     * firstOrCreated. 2019/6/14 11:12.
     *
     * @param int    $numeric
     * @param string $model
     * @param string $type
     *
     * @return mixed
     */
    public function firstOrCreated(int $numeric, string $model, string $type)
    {
        $db = self::$model->firstOrCreate(['count_numeric' => $numeric, 'model_name' => $model, 'type' => $type], ['id' => create_numeric_id()]);
        $db->increment('count', 1);

        return $db;
    }

    /**
     * whereGet. 2019/6/14 11:15.
     *
     * @param $numeric
     * @param $model
     * @param $type
     *
     * @return mixed
     */
    public function whereGet($numeric, $model, $type)
    {
        return self::$model->where('count_numeric', $numeric)
                           ->when($model, function ($q) use ($model) {
                               return $q->where('model_name', $model);
                           })
                           ->when($type, function ($q) use ($type) {
                               return $q->where('type', $type);
                           })
                           ->get();
    }
}