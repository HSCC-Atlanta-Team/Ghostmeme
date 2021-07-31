<?php

namespace App\Api;

class Meme extends GhostmemeApi 
{
    public function getMemes($after = null)
    {
        $endpoint = sprintf(
            '%s/v1/memes/',
            $_ENV['API_BASE_URL']
        );

        if ($after) {
            $this->setOption('query', [
                'after' => $after,
            ]);
        }

        return $this->sendRequest('GET', $endpoint);
    }

    public function getMeme($meme_id)
    {
        $endpoint = sprintf(
            '%s/v1/memes/%s',
            $_ENV['API_BASE_URL'],
            $meme_id
        );

        return $this->sendRequest('GET', $endpoint);
    }

    public function createMeme($owner, $receiver, $expiredAt, $description, $private, $replyTo, $imageUrl, $imageBase64)
    {
        
        $endpoint = sprintf(
            '%s/v1/memes/%s',
            $_ENV['API_BASE_URL'],
            $memeObj
        );
        $info = {
            'owner' => $owner,
            'receiver' => $receiver,
            'expiredAt' => $expiredAt,
            'description' => $description,
            'private' => $private,
            'replyTo' => $replyTo,
            'imageUrl' => $imageUrl,
            'imageBase64' => $imageBase64, 
        }

        $this->setOption('json', $info);

        return $this->sendRequest('POST', $endpoint);
    }

    public function getMemes($memeIdArray)
    {
        $url = "";

        for ($memeIdArray as $memeId)
        {
            $url += $memeId + "/";
        }

        $endpoint = sprintf(
            '%s/v1/memes/' + $url,
            $_ENV['API_BASE_URL']
        );

        return $this->sendRequest('GET', $endpoint);
    }

    
}