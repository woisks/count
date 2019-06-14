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
     ->namespace('Woisks\Count\Http\Controllers')
     ->group(function () {

         Route::post('/', 'CreateCountController@create');
         Route::get('/user', 'UserCountController@get');
         Route::get('/', 'CountController@get');


     });