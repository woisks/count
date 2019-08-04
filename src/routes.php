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


Route::prefix('count')
    ->middleware('throttle:60,1')
    ->namespace('Woisks\Count\Http\Controllers')
    ->group(function () {

        //获取模块类型ID- 用户记录
        Route::get('/logs/{model}/{type}/{numeric}', 'GetController@logs')->where(['model' => '[a-z_a-z]+', 'type' => '[a-z_a-z]+', 'numeric' => '[0-9]+']);

        //获取模块 ID的全部类型
        Route::get('/{model}/{numeric}', 'GetController@count')->where(['type' => '[a-z_a-z]+', 'numeric' => '[0-9]+']);

        //获取模块类型-记录
        Route::get('/{model}/{type}/{uid}', 'GetController@user')->where(['model' => '[a-z_a-z]+', 'type' => '[a-z_a-z]+', 'uid' => '[0-9]+',]);

        Route::middleware('token')->group(function () {

            Route::post('/', 'ChangeController@change');

        });
    });
