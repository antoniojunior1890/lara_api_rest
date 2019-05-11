<?php
/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 23/04/19
 * Time: 03:34
 */

namespace App\API;


class ApiError
{
    public static function errorMsg($message, $code)
    {
        return [
            'data' => [
                'msg' => $message,
                'code' => $code
            ]
        ];
    }
}