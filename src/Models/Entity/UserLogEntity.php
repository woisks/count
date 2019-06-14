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
 * Class UserLogEntity.
 *
 * @package Woisks\Count\Models\Entity
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/13 10:32
 */
class UserLogEntity extends Models
{
    /**
     * table.  2019/6/13 10:32.
     *
     * @var  string
     */
    protected $table = 'count_user_log';
    /**
     * fillable.  2019/6/13 10:32.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'count_numeric',
        'model_name',
        'type',
        'created_at',
        'updated_at',
        'status'
    ];
}