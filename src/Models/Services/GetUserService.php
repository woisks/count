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

namespace Woisks\Count\Models\Services;


use Woisks\Count\Models\Repository\UserLogRepository;

/**
 * Class GetUserService.
 *
 * @package Woisks\Count\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/14 10:52
 */
class GetUserService
{
    /**
     * userLog.  2019/6/14 10:52.
     *
     * @var  \Woisks\Count\Models\Repository\UserLogRepository
     */
    private $userLog;

    /**
     * GetUserService constructor. 2019/6/14 10:52.
     *
     * @param \Woisks\Count\Models\Repository\UserLogRepository $userLog
     *
     * @return void
     */
    public function __construct(UserLogRepository $userLog)
    {
        $this->userLog = $userLog;
    }

    /**
     * whereGetd. 2019/6/14 10:52.
     *
     * @param $model
     * @param $type
     * @param $desc
     *
     * @return mixed
     */
    public function whereGetd($model, $type, $desc)
    {
        return $this->userLog->whereGet($model, $type, $desc);
    }


}