<?php
namespace App\Model;

class ApiModelFactory
{
    public static function createFromApiResponse($response, $class, $resultKey)
    {
        $data = $response->getBody()->getContents();
        $props = json_decode($data, true);
        $model = new $class($props[$resultKey]);

        return $model;
    }
}