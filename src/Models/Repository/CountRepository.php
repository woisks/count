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
 * Class TypeRepository.
 *
 * @package Woisks\Count\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/12 18:06
 */
class CountRepository
{

    /**
     * model.  2019/7/28 12:54.
     *
     * @var static CountEntity
     */
    private static $model;

    /**
     * CountRepository constructor. 2019/7/28 12:54.
     *
     * @param CountEntity $count
     *
     * @return void
     */
    public function __construct(CountEntity $count)
    {
        self::$model = $count;
    }

    /**
     * firstOrCreated. 2019/7/28 13:21.
     *
     * @param $model
     * @param $type
     * @param $numeric
     *
     * @return mixed
     */
    public function firstOrCreated($model, $type, $numeric)
    {
        $db = self::$model->firstOrCreate(['numeric' => $numeric, 'model' => $model, 'type' => $type], ['id' => create_numeric_id()]);
        $db->increment('count', 1);

        return $db;
    }

    /**
     * decrement. 2019/7/28 13:33.
     *
     * @param $model
     * @param $type
     * @param $numeric
     *
     * @return mixed
     */
    public function decrement($model, $type, $numeric)
    {
        return self::$model->where('numeric', $numeric)->where('model', $model)->where('type', $type)->decrement('count');
    }

    /**
     * all. 2019/7/28 12:54.
     *
     * @param $model
     * @param $numeric
     *
     * @return mixed
     */
    public function all($model, $numeric)
    {
        return self::$model->where('numeric', $numeric)->where('model', $model)->get();
    }
}
