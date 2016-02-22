<?php

/**
 * Created by PhpStorm.
 * User: Netex_QA
 * Date: 19.02.2016
 * Time: 15:48
 */

namespace Netex\HelloWorldQA\HTTP;

use Netex\HelloWorldQA\Actors\Word;

class GET extends Request
{

    public static function parse()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != "GET") {
            self::giveResponse(self::STATUS_NOT_ALLOWED);
        } elseif (!is_array($_GET)) {
            self::giveResponse(self::STATUS_BAD_REQUEST);
        } elseif (!array_key_exists("word", $_GET)) {
            self::giveResponse(self::STATUS_BAD_REQUEST);
        } else {
            $word = $_GET['word'];
            if (strlen($word) > 1) {
                $actor = new Word();
                $actJobOk = $actor->act($word);
                if ($actJobOk) {
                    self::giveResponse(self::STATUS_OK);
                } else {
                    self::giveResponse(self::STATUS_SERVER_ERROR);
                }
            } else {
                self::giveResponse(self::STATUS_PRECONDITION_FAILED);
            }
        }
    }
}