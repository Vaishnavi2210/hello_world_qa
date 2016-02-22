<?php
/**
 * Created by PhpStorm.
 * User: Netex_QA
 * Date: 19.02.2016
 * Time: 17:14
 */

namespace Netex\HelloWorldQA\HTTP;


class Request
{

    const STATUS_OK = 200;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_NOT_FOUND = 404;
    const STATUS_NOT_ALLOWED = 405;
    const STATUS_PRECONDITION_FAILED = 412;
    const STATUS_SERVER_ERROR = 500;

    protected static function giveResponse($code){
        http_response_code ($code);
        switch($code){
            case self::STATUS_OK:
                break;
            case self::STATUS_BAD_REQUEST:
                echo "Bad request!";
                break;
            case self::STATUS_NOT_FOUND:
                echo "Not found!";
                break;
            case self::STATUS_NOT_ALLOWED:
                echo "Method not allowed!";
                break;
            case self::STATUS_PRECONDITION_FAILED:
                echo "Word too short!";
                break;
            case self::STATUS_SERVER_ERROR:
                echo "Unexpected server error!";
                break;
        }

        exit;
    }

    public static function parse(){}

    private function __construct()
    {
    }

}