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


use Woisks\Count\Models\Entity\ModelCountEntity;

/**
 * Class ModelCountRepository.
 *
 * @package Woisks\Count\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/13 10:34
 */
class ModelCountRepository
{
    /**
     * model.  2019/6/13 10:34.
     *
     * @var static \Woisks\Count\Models\Entity\ModelCountEntity
     */
    private static $model;

    /**
     * ModelCountRepository constructor. 2019/6/13 10:34.
     *
     * @param \Woisks\Count\Models\Entity\ModelCountEntity $modelCount
     *
     * @return void
     */
    public function __construct(ModelCountEntity $modelCount)
    {
        self::$model = $modelCount;
    }

    public function firstOrCreated(string $model)
    {
        $db = self::$model->firstOrCreate(['name' => $model], ['id' => create_numeric_id()]);
        $db->increment('count', 1);

        return $db;
    }

}