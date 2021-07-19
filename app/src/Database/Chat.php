<?php
    namespace App\Database;

    require __DIR__ . '/../../init.php';

    use PDO;

        class Chat extends Database {
            

            public function createChat($owner_id, $reciever_id, $reciever_username){
                //$this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                $check_query = $this->db->prepare('SELECT * from chat where reciever_id = :reciever_id');

                $check_query->execute([':reciever_id' => $reciever_id]);

                $chat = $check_query->fetch(PDO::FETCH_ASSOC);

                if(!$chat){

                    $query = $this->db->prepare('INSERT INTO chat (owner_id, reciever_id, reciever_username) values (:owner_id, :reciever_id, :reciever_username)');

                    $query->execute([':owner_id' => $owner_id, ':reciever_id' => $reciever_id, ':reciever_username' => $reciever_username]);
                }
                //die(var_dump($query->errorInfo()));
            }
            public function getChat($owner_id){

                $query = $this->db->prepare('SELECT * from chat where owner_id = :owner_id');

                $query->execute([':owner_id' => $owner_id]);

                $chat = $query->fetchall();

                return $chat;
            }
        }
