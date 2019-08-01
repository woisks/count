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


use DB;
use Throwable;
use Woisks\Count\Models\Repository\CountRepository;
use Woisks\Count\Models\Repository\LogRepository;
use Woisks\Count\Models\Repository\TypeRepository;

/**
 * Class CountServices.
 *
 * @package Woisks\Count\Models\Services
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/8/1 17:37
 */
class CountServices
{

    /**
     * countRepo.  2019/8/1 17:37.
     *
     * @var static CountRepository
     */
    private static $countRepo;

    /**
     * typeRepo.  2019/8/1 17:37.
     *
     * @var static TypeRepository
     */
    private static $typeRepo;

    /**
     * logRepo.  2019/8/1 18:10.
     *
     * @var static LogRepository
     */
    private static $logRepo;


    /**
     * CountServices constructor. 2019/8/1 18:09.
     *
     * @param CountRepository $countRepo
     * @param TypeRepository $typeRepo
     * @param LogRepository $logRepo
     *
     * @return void
     */
    public function __construct(CountRepository $countRepo, TypeRepository $typeRepo, LogRepository $logRepo)
    {
        self::$countRepo = $countRepo;
        self::$typeRepo  = $typeRepo;
        self::$logRepo   = $logRepo;

    }


    /**
     * increment. 2019/8/1 18:13.
     *
     * @param $model
     * @param $type
     * @param $numeric
     * @param $account_uid
     *
     * @return bool
     * @throws \Exception
     */
    public static function increment($model, $type, $numeric, $account_uid)
    {
        if (!$type_db = self::$typeRepo->first($model, $type)) {
            return false;
        }

        if (self::$logRepo->exists($model, $type, $numeric, $account_uid)) {
            return true;
        }
        try {
            DB::beginTransaction();

            $type_db->increment('count');
            self::$countRepo->firstOrCreated($model, $type, $numeric);
            self::$logRepo->created($model, $type, $numeric, $account_uid);
        } catch (Throwable $e) {

            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }


    /**
     * decrement. 2019/8/1 18:13.
     *
     * @param $model
     * @param $type
     * @param $numeric
     * @param $account_uid
     *
     * @return bool
     * @throws \Exception
     */
    public static function decrement($model, $type, $numeric, $account_uid)
    {
        if (!$type_db = self::$typeRepo->first($model, $type)) {
            return false;
        }

        if (!self::$logRepo->exists($model, $type, $numeric, $account_uid)) {
            return false;
        }

        try {
            \DB::beginTransaction();

            $type_db->decrement('count');
            self::$countRepo->decrement($model, $type, $numeric);
            self::$logRepo->delete($model, $type, $numeric, $account_uid);
        } catch (\Throwable $e) {

            \DB::rollBack();
            return false;
        }
        \DB::commit();
        return true;
    }
}
