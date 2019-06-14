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


class GetUserRequest extends Requests
{

    public function rules()
    {
        return [
            'model' => 'sometimes|required|string|min:2|max:20',
            'type'  => 'sometimes|required|string|min:2|max:20',
            'desc'  => 'sometimes|required|boolean'
        ];
    }
}