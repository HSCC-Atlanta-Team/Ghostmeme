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

    public function addFriend($user_id, $friend_id)
    {
        $endpoint = sprintf(
            '%s/v1/users/%s/friends/%s',
            $_ENV['API_BASE_URL'],
            $user_id, 
            $friend_id
        );   

        return $this->sendRequest('PUT', $endpoint);
    }

    public function createUser($name, $email, $username, $phone_number = null, $image_data = null )
    {
        $endpoint = sprintf(
            '%s/v1/users/',
            $_ENV['API_BASE_URL']
        );

        $data = [
            'name' => $name, 
            'email' => $email, 
            'username' => $username,
            'phone' => $phone_number,
            'imageBase64' => $image_data,
        ];

        $this->setOption('json', $data);

        return $this->sendRequest('POST', $endpoint);
    }

    public function updateUser($user_id, $name, $email, $phone_number = null, $image_data = null )
    {
        $endpoint = sprintf(
            '%s/v1/users/%s',
            $_ENV['API_BASE_URL'],
            $user_id
        );

        $data = [
            'name' => $name, 
            'email' => $email, 
            'phone' => $phone_number,
            'imageBase64' => $image_data,
        ];

        $this->setOption('json', $data);

        return $this->sendRequest('PUT', $endpoint);
    }

}