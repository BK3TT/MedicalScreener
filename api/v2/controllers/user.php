<?php

class User
{
    public function profile($user_id) {
        global $DB;

        if ($user_id) {
            $data = [
                'id' => $user_id
            ];

            $query = "SELECT forename, surname, age, weight, height, address, city, postcode FROM users WHERE id = :id LIMIT 1";
            $stmt= $DB->prepare($query);
            $stmt->execute($data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

            echo json_encode($result);
        }
    }

    public function updates($user_id) {
        global $DB;

        if ($user_id) {
            if (isset($_POST) && !empty($_POST)) {
                $data = [
                    'id' => $user_id,
                    'age' => $_POST['age'],
                    'weight' => $_POST['weight'],
                    'height' => $_POST['height'],
                    'address' => $_POST['address'],
                    'city' => $_POST['city'],
                    'postcode' => $_POST['postcode'],
                ];      
    
                try {
                    $query = "UPDATE `users` SET `age` = :age, `weight` = :weight, `height` = :height, `address` = :address, `city` = :city, `postcode` = :postcode
                                WHERE `id` = :id";
                    $stmt= $DB->prepare($query);
                    $stmt->execute($data);
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
    }

    public function login() {
        global $DB;

        if (isset($_POST) && !empty($_POST)) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $data = [
                'email' => $email
            ];

            $query = "SELECT id, forename, surname, email, hash, salt FROM users WHERE email = :email LIMIT 1";
            $stmt= $DB->prepare($query);
            $stmt->execute($data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

            if(is_array($result) && !empty($result)) {
                $decryped = $this->decrypt($password, $result['hash'], $result['salt']);

                if($decryped) {
                    echo json_encode(
                        array('id' => $result['id'], 'forename' => $result['forename'], 'surname' => $result['surname'], 'email' => $result['email'])
                    );
                } else {
                    return false;
                }
            }
        }
    }

    public function register() {
        global $DB;

        if (isset($_POST) && !empty($_POST)) {
            $encrypted = $this->encrypt($_POST['password']);
            $forename = $_POST['forename'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];

            $data = [
                'forename' => $forename,
                'surname' => $surname,
                'email' => $email,
                'hash' => $encrypted['hash'],
                'salt' => $encrypted['salt'],
            ];      

            try {
                $query = "INSERT INTO users (forename, surname, email, hash, salt) VALUES (:forename, :surname, :email, :hash, :salt)";
                $stmt= $DB->prepare($query);
                $stmt->execute($data);
                
                header("Location: " . $_POST["redirect"]);
                die;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    public function encrypt($password) {
        $options = [
            'cost' => 12,
        ];

        $salt = rand(10, 99999999999999);
        $first_letter = substr($password, 0, 1);
        $last_letter = substr($password, -1);

        $password = $salt . $first_letter . $password . $last_letter . $salt;
        
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);

        return array('hash' => $hash, 'salt' => $salt);
    }

    public function decrypt($password, $hash, $salt) {
        $first_letter = substr($password, 0, 1);
        $last_letter = substr($password, -1);

        $password = $salt . $first_letter . $password . $last_letter . $salt;

        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }
}


?>