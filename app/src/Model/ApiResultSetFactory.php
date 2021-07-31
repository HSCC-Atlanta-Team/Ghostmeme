<?php
namespace App\Model;

class ApiResultSetFactory
{
    public static function createFromApiResponse($response, $class, $resultKey)
    {
        $data = $response->getBody()->getContents();
        $set = json_decode($data, true);

        $resultSet = [];
        foreach ($set[$resultKey] as $props) {
            $resultSet[] = new $class($props);
        }

        return $resultSet;
    }
}