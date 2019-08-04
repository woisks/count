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

namespace Woisks\Count\Http\Requests;


/**
 * Class ChangeRequest.
 *
 * @package Woisks\Count\Http\Requests
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/13 10:38
 */
class ChangeRequest extends Requests
{
    /**
     * rules. 2019/6/13 10:38.
     *
     *
     * @return array
     */
    public function rules()
    {
        return [
            'numeric' => 'required|numeric|digits_between:18,19',
            'model'   => 'required|string|min:2|max:20',
            'type'    => 'required|string|min:2|max:20'
        ];
    }

}
