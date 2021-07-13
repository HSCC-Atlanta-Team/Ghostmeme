<?php
    namespace App\Database;

    use PDO;

        class User extends Database {

            public function login(string $email, string $password, $remember){

                $find_user_query = $this->db->prepare('SELECT * from `users` where email = :email or username = :email');
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

            public function signup($first_name, $last_name, $phone, $email, $password_hash, $username){
                $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

                $signup_query = $this->db->prepare('INSERT INTO `users` (first_name, last_name, phone, email, password_hash, username, forgot) VALUES (:first_name, :last_name, :phone, :email, :password_hash, :username, :forgot)');
                $code = $this->generateForgotPassCode();

                $signup_query->execute([':first_name' => $first_name, ':last_name' => $last_name, ':phone' => $phone, ':email' => $email, ':password_hash' => $password_hash, ':username' => $username, ':forgot' => $code]);
                
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

            public function checkUsername(string $username){
                $find_user_query = $this->db->prepare('SELECT * from `users` where username = :username');
                $find_user_query->execute([':username' => $username]);

                
                //return false;
                $user = $find_user_query->fetch(PDO::FETCH_ASSOC);

                //die(var_dump($user));

                if(!$user){
                    return false;
                }elseif($user){
                    return true;
                }

            }

            public function checkForgotPassCode($forgot){
                $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

                $find_user_query = $this->db->prepare('SELECT * from `users` where forgot  = :forgot');
                $find_user_query->execute([':forgot' => $forgot]);
                
                $test='test';
                //die(var_dump($find_user_query->errorInfo()));

                
                //return false;
                $user = $find_user_query->fetch(PDO::FETCH_ASSOC);
                //die(var_dump($user));

                //die(var_dump($user));

                if(!$user){
                    return false;
                }elseif($user){
                    return true;
                }

            }

            public function generateForgotPassCode(){

                $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $code = substr(str_shuffle($permitted_chars), 0, 16);

                if(!$this->checkForgotPassCode($code)){
                    //die($code);
                    return $code;
                }
                else {
                    $code = $this->generateForgotPassCode();
                    //die($code);
                    return $code;
                }
            }
        
            public function checkForgot($code){

                $find_user_query = $this->db->prepare('SELECT * from `users` where forgot = :forgot');
                $find_user_query->execute([':forgot' => $code]);

                $user = $find_user_query->fetch(PDO::FETCH_ASSOC);

                //die(var_dump($user));
                
                if(!$user['forgot_pass']){
                    return false;
                }elseif($user['forgot_pass']){
                    return true;
                }

            }

            public function forgotPassword($email){

                $change_forgot_status_query = $this->db->prepare('UPDATE users SET forgot_pass = 1 WHERE email = :email');
                $change_forgot_status_query->execute([':email' => $email,]);

                $get_user_query = $this->db->prepare('SELECT * from users where email = :email');
                $get_user_query->execute([':email' => $email]);

                $user = $get_user_query->fetch(PDO::FETCH_ASSOC);

                //die(var_dump($user));
                $link = $_ENV['BASE_URL'] . '/reset_password.php?code=' . $user['forgot'];

                return $link;

            }
            public function resetPassword($code, $password){
                $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );


                $reset_password_query = $this->db->prepare('UPDATE users set password_hash = :password_hash where forgot = :forgot');
                $reset_password_query->execute([':password_hash' => $password, ':forgot' => $code]);

                //die(var_dump($reset_password_query->errorInfo()));
                $change_forgot_pass_query = $this->db->prepare('UPDATE users set forgot_pass = NULL where forgot = :forgot');
                $change_forgot_pass_query->execute([':forgot' => $code]);

                $forgot = $this->generateForgotPassCode();

                $change_forgot_query = $this->db->prepare('UPDATE users set forgot = :forgot where forgot = :forgot_code');
                $change_forgot_query->execute([':forgot' => $forgot, ':forgot_code' => $code]);
            }
        }
?>