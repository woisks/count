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


         Route::get('/user', 'UserController@get');
         Route::get('/', 'CountController@get');

         Route::middleware('token')->group(function () {
             Route::post('/', 'CreateController@create');
         });
     });