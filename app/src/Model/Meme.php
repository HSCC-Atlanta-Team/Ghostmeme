<?php
namespace App\Model;

require __DIR__ . '/../../init.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;



    class Meme {
        private $id; //A unique immutable MongoDB ID representing this meme. **Generated automatically by the server**
        private $owner; //The user_id of the user that uploaded this meme.
        private $reciever; //The user_id of a non-owner user authorized to access this meme or null
        private $createdAt; //When this meme was created in milliseconds since the unix epoch.
        private $expiredAt; //When When this meme expired (or will expire) in milliseconds since the unix epoch or -1 if it should never expire.
        private $description; //Additional data associated with this meme or null.
        private $likes; //The current number of likes this meme has received.
        private $private; //true if this meme is private or false otherwise.
        private $replyTo; //The meme_id of the meme to which this meme is responding or null if it is not a reply.
        private $imageUrl; //The HTTP url of a PNG, JPEG, or GIF image file or null if there is no image.



        public function __construct(array $properties = [])
    {
        foreach ($properties as $name => $value) {
            if (property_exists($this, $name)) {
                $this->{$name} = $value;
            }
        }
    }

        public function getId(){
            return $this->id;
        }
        public function getOwner(){
            return $this->owner;
        }
        public function getReciever(){
            return $this->reciever;
        }
        public function getCreatedAt(){
            return $this->createdAt;
        }
        public function getExpiredAt(){
            return $this->expiredAt;
        }
        public function getDescription(){
            return $this->description;
        }
        public function getLikes(){
            return $this->likes;
        }
        public function getPrivate(){
            return $this->private;
        }
        public function getReplyTo(){
            return $this->replyTo;
        }
        public function getImageUrl(){
            return $this->imageUrl;
        }
        public function getMeme(){
            $meme = [
                "id" => $this->id,
                "owner" => $this->owner,
                "reciever" => $this->reciever,
                "createdAt" => $this->createdAt,
                "expiredAt" => $this->expiredAt,
                "description" => $this->description,
                "likes" => $this->likes,
                "private" => $this->private,
                "replyTo" => $this->replyTo,
                "imageUrl" => $this->imageUrl,
            ];
            return $meme;
        }


        public function setOwner($owner){
            $this->owner = $owner;
        }
        public function setReciever($reciever){
            $this->reciever = $reciever;
        }
        public function setCreatedAt($createdAt){
            $this->createdAt = $createdAt;
        }
        public function setExpiredAt($expiredAt){
            $this->expiredAt = $expiredAt;
        }
        public function setDescription($description){
            $this->description = $description;
        }
        public function setLikes($likes){
            $this->likes = $likes;
        }
        public function setPrivate($private){
            $this->private = $private;
        }
        public function setReplyTo($replyTo){
            $this->replyTo = $replyTo;
        }
        public function setImageUrl($imageUrl){
            $this->imageUrl = $imageUrl;
        }


        public function createMeme(){
            $client = new Client(['base_uri' => $_ENV['API_BASE_URL']]);
            $body = json_encode([
                "owner" => $this->owner,
                "reciever" => $this->reciever,
                "expiredAt" => $this->expiredAt,
                "description" => $this->description,
                "private" => $this->private,
                "replyTo" => $this->replyTo,
                "imageUrl" => $this->imageUrl,
                "imageBase64" => NULL,
            ]);

            $response = $client->post('/v1/memes', ['body' => $body, 'headers' => ['key' => $_ENV['API_KEY'], 'Content-Type' => 'application/json',]]);
            
            return json_decode($response->getBody(), true);

        }

    }