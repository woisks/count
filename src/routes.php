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


        Route::get('/logs/{model}/{type}/{numeric}', 'GetController@logs')->where(['model' => '[a-z_a-z]+', 'type' => '[a-z_a-z]+', 'numeric' => '[0-9]+']);
        Route::get('/{model}/{numeric}', 'GetController@count')->where(['type' => '[a-z_a-z]+', 'numeric' => '[0-9]+']);
        Route::get('/{model}/{type}/{uid}', 'GetController@user')->where(['model' => '[a-z_a-z]+', 'type' => '[a-z_a-z]+', 'uid' => '[0-9]+',]);

        Route::middleware('token')->group(function () {
            Route::post('/', 'CreateController@create');
            Route::post('/del', 'DelController@del');

        });
    });
