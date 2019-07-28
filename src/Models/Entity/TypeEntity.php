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
 * Class TypeEntity.
 *
 * @package Woisks\Count\Models\Entity
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/12 17:45
 */
class TypeEntity extends Models
{
    /**
     * table.  2019/6/12 17:45.
     *
     * @var  string
     */
    protected $table = 'count_type_count';
    /**
     * fillable.  2019/6/12 17:45.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'model',
        'type',
        'name',
        'readme',
        'count'

    ];

    /**
     * timestamps.  2019/6/14 9:46.
     *
     * @var  bool
     */
    public $timestamps = false;
}
