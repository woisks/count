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


use Woisks\Count\Models\Repository\CountRepository;
use Woisks\Count\Models\Repository\ModelCountRepository;
use Woisks\Count\Models\Repository\UserLogRepository;


/**
 * Class CreateService.
 *
 * @package Woisks\Count\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/14 9:40
 */
class CreateService
{

    /**
     * countRepo.  2019/6/14 9:40.
     *
     * @var  \Woisks\Count\Models\Repository\CountRepository
     */
    private $countRepo;

    /**
     * modelCountRepo.  2019/6/14 9:40.
     *
     * @var  \Woisks\Count\Models\Repository\ModelCountRepository
     */
    private $modelCountRepo;

    /**
     * userLogRepo.  2019/6/14 9:40.
     *
     * @var  \Woisks\Count\Models\Repository\UserLogRepository
     */
    private $userLogRepo;


    /**
     * CreateService constructor. 2019/6/14 9:40.
     *
     * @param \Woisks\Count\Models\Repository\CountRepository      $count
     * @param \Woisks\Count\Models\Repository\ModelCountRepository $modelCount
     * @param \Woisks\Count\Models\Repository\UserLogRepository    $userLog
     *
     * @return void
     */
    public function __construct(CountRepository $count, ModelCountRepository $modelCount, UserLogRepository $userLog)
    {
        $this->countRepo = $count;
        $this->modelCountRepo = $modelCount;
        $this->userLogRepo = $userLog;
    }

    /**
     * count. 2019/6/14 9:40.
     *
     * @param int    $numeric
     * @param string $model
     * @param string $type
     *
     * @return mixed
     */
    public function count(int $numeric, string $model, string $type)
    {
        return $this->countRepo->firstOrCreated($numeric, $model, $type);
    }

    /**
     * model. 2019/6/14 9:40.
     *
     * @param string $model
     *
     * @return mixed
     */
    public function model(string $model)
    {
        return $this->modelCountRepo->firstOrCreated($model);
    }

    /**
     * userLog. 2019/6/14 9:40.
     *
     * @param int    $numeric
     * @param string $model
     * @param string $type
     * @param int    $account_uid
     *
     * @return mixed
     */
    public function userLog(int $numeric, string $model, string $type, int $account_uid)
    {
        return $this->userLogRepo->created($numeric, $model, $type, $account_uid);
    }
}