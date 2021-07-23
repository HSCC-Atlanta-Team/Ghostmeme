<?php

namespace App\Api;

class Users extends GhostmemeApi 
{
    public function getUsers($after = null)
    {
        $endpoint = sprintf(
            '%s/v1/users/',
            $_ENV['API_BASE_URL']
        );

        if ($after) {
            $this->setOption('query', [
                'after' => $after,
            ]);
        }

        return $this->sendRequest('GET', $endpoint);
    }

    public function getUser($user_id)
    {
        $endpoint = sprintf(
            '%s/v1/users/%s',
            $_ENV['API_BASE_URL'],
            $user_id
        );

        return $this->sendRequest('GET', $endpoint);
    }
}