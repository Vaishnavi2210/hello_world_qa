<?php

namespace Netex\HelloWorldQA\Exception;

use mysqli_sql_exception;

class MysqlDatafeedException extends mysqli_sql_exception
{
    public final function getJSONMessage()
    {
        return json_encode($this->message);
    }
} 