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


use Woisks\Count\Models\Entity\TypeEntity;

/**
 * Class TypeRepository.
 *
 * @package Woisks\Count\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/13 10:34
 */
class TypeRepository
{

    /**
     * model.  2019/7/28 12:14.
     *
     * @var static TypeEntity
     */
    private static $model;

    /**
     * TypeRepository constructor. 2019/7/28 12:14.
     *
     * @param TypeEntity $modelCount
     *
     * @return void
     */
    public function __construct(TypeEntity $modelCount)
    {
        self::$model = $modelCount;
    }

    /**
     * first. 2019/7/19 21:20.
     *
     * @param $model
     * @param $type
     *
     * @return mixed
     */
    public function first($model, $type)
    {
        return self::$model->where('model', $model)->where('type', $type)->first();
    }

    /**
     * decrement. 2019/7/28 12:15.
     *
     * @param $model
     * @param $type
     *
     * @return mixed
     */
    public function decrement($model, $type)
    {
        return self::$model->where('model', $model)->where('type', $type)->decrement('count');
    }

}
