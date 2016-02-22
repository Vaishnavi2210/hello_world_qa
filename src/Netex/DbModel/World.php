<?php
/**
 * Created by PhpStorm.
 * User: Cristi C
 * Date: 7/31/14
 * Time: 5:19 PM
 */

namespace Netex\HelloWorldQA\DbModel;

use Netex\HelloWorldQA\Exception\MysqlDatafeedException;

class World extends AbstractTable
{

    public function create($word)
    {
        $insertId = null;
        try {
            $currentDate = date("Y-m-d H:i:s");
            $query = "INSERT INTO " . $this->table . "(`word`,`timestamp`) VALUES (?,'$currentDate')";
            if ($stmt = self::$dbLink->prepare($query)) {
                $stmt->bind_param("s", $word);
                if ($stmt->execute()) {
                    $insertId = self::$dbLink->insert_id;
                }
            }
        } catch (\mysqli_sql_exception $e) {
            throw new MysqlDatafeedException($e->getMessage());
        }

        return $insertId;
    }

    public function getLatestRecord()
    {
        $word = null;
        try {
            $query = "SELECT `word` FROM " . $this->table . " ORDER BY `timestamp` DESC LIMIT 1";

            if ($stmt = self::$dbLink->prepare($query)) {
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    if ($result->num_rows) {
                        $resultArray = $result->fetch_array(MYSQLI_ASSOC);
                        $word = $resultArray['word'];
                    }
                }
            }
        } catch (\mysqli_sql_exception $e) {
            throw new MysqlDatafeedException($e->getMessage());
        }

        return $word;
    }

} 