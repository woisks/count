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

/**
 * Class GetCountService.
 *
 * @package Woisks\Count\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/14 11:12
 */
class GetCountService
{
    /**
     * countRepo.  2019/6/14 11:12.
     *
     * @var  \Woisks\Count\Models\Repository\CountRepository
     */
    private $countRepo;

    /**
     * GetCountService constructor. 2019/6/14 11:12.
     *
     * @param \Woisks\Count\Models\Repository\CountRepository $countRepo
     *
     * @return void
     */
    public function __construct(CountRepository $countRepo)
    {
        $this->countRepo = $countRepo;
    }

    /**
     * whereGetd. 2019/6/14 11:16.
     *
     * @param $numeric
     * @param $model
     * @param $type
     *
     * @return mixed
     */
    public function whereGetd($numeric, $model, $type)
    {
        return $this->countRepo->whereGet($numeric, $model, $type);
    }


}