<?php
    namespace App\Database;

    use PDO;

        class User extends Database {

            public function login(string $email, string $password, $remember){

                $find_user_query = $this->db->prepare('SELECT * from `users` where email = :email');
                $find_user_query->execute([':email' => $email]);
                $user = $find_user_query->fetch(PDO::FETCH_ASSOC);

                if(password_verify($password, $user['password_hash'])){
                    if($remember){
                        setcookie('user',[
                            'first_name' => $user['first_name'],
                            'last_name' => $user['last_name'],
                            'phone' => $user['phone'],
                            'email' => $user['email']], time()+(10 * 365 * 24 * 60 * 60));

                        $_SESSION['user'] = [
                            'first_name' => $user['first_name'],
                            'last_name' => $user['last_name'],
                            'phone' => $user['phone'],
                            'email' => $user['email'],
                        ];
                        return true;
                    }
                    if(!$remember){
                        $_SESSION['user'] = [
                            'first_name' => $user['first_name'],
                            'last_name' => $user['last_name'],
                            'phone' => $user['phone'],
                            'email' => $user['email'],
                        ];
                        return true;
                    }  
                } else {
                    return false;
                }
            }

            public function signup($first_name, $last_name, $phone, $email, $password_hash){
                $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

                $signup_query = $this->db->prepare('INSERT INTO `users` (first_name, last_name, phone, email, password_hash) VALUES (:first_name, :last_name, :phone, :email, :password_hash)');

                $signup_query->execute([':first_name' => $first_name, ':last_name' => $last_name, ':phone' => $phone, ':email' => $email, ':password_hash' => $password_hash,]);
                
                //die(var_dump($signup_query->errorInfo()));


            }
            public function checkEmail($email){
               

                $find_user_query = $this->db->prepare('SELECT * from `users` where email = :email');
                $find_user_query->execute([':email' => $email]);

                

                $user = $find_user_query->fetch(PDO::FETCH_ASSOC);

                if(!$user){
                    return false;
                }elseif($user){
                    return true;
                }
            }
        }
?>