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

namespace Woisks\Count\Models\Entity;


/**
 * Class CountEntity.
 *
 * @package Woisks\Count\Models\Entity
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/12 17:47
 */
class CountEntity extends Models
{
    /**
     * table.  2019/6/12 17:47.
     *
     * @var  string
     */
    protected $table = 'count';
    /**
     * fillable.  2019/6/12 17:47.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'count_numeric',
        'model_name',
        'type',
        'count'
    ];
    protected $hidden   = [
        'id'
    ];
    /**
     * timestamps.  2019/6/12 17:47.
     *
     * @var  bool
     */
    public $timestamps = false;
}