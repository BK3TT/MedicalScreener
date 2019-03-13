<?php

class UsersController extends MainController
{
    public function profile($user_id) {
        if ($user_id) {
            $data = [
                'id' => $user_id
            ];

            $query = "SELECT forename, surname, age, weight, height, address, city, postcode FROM users WHERE id = :id LIMIT 1";
            $data = $this->DB->GetData($query, $data);
            $result = $data[0];
            echo json_encode($result);
        }
    }

    public function updates($user_id) {
        if ($user_id) {
            $data = [
                'id' => $user_id,
                'age' => $this->data->age,
                'weight' => $this->data->weight,
                'height' => $this->data->height,
                'address' => $this->data->address,
                'city' => $this->data->city,
                'postcode' => $this->data->postcode,
            ];      

            try {
                $query = "UPDATE `users` SET `age` = :age, `weight` = :weight, `height` = :height, `address` = :address, `city` = :city, `postcode` = :postcode
                            WHERE `id` = :id";
                $this->DB->PostData($query, $data);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    public function login() {
        $email = $this->data->email;

        $data = [
            'email' => $email
        ];

        $query = "SELECT id, forename, surname, email, hash, salt FROM users WHERE email = :email LIMIT 1";
        $data = $this->DB->GetData($query, $data);
        $result = $data[0];

        if(is_array($result) && !empty($result)) {
            $this->hash = $result['hash'];
            $this->salt = $result['salt'];

            $decryped = $this->decrypt();

            if($decryped) {
                echo json_encode(
                    array('id' => $result['id'], 'forename' => $result['forename'], 'surname' => $result['surname'], 'email' => $result['email'])
                );
            } else {
                return false;
            }
        }
    }

    public function register() {
        $forename = $this->data->forename;
        $surname = $this->data->surname;
        $email = $this->data->email;
        $encrypted = $this->encrypt();

        $data = [
            'forename' => $forename,
            'surname' => $surname,
            'email' => $email,
            'hash' => $encrypted['hash'],
            'salt' => $encrypted['salt'],
        ];      

        $query = "INSERT INTO users (forename, surname, email, hash, salt) VALUES (:forename, :surname, :email, :hash, :salt)";
        $this->DB->PostData($query, $data);    

        header("Location: " . $this->data->redirect);
        die;
    }

    public function encrypt() {
        $options = [
            'cost' => 12,
        ];

        $salt = rand(10, 99999999999999);
        $first_letter = substr($this->data->password, 0, 1);
        $last_letter = substr($this->data->password, -1);

        $this->data->password = $salt . $first_letter . $password . $last_letter . $salt;
        
        $hash = password_hash($this->data->password, PASSWORD_BCRYPT, $options);

        return array('hash' => $hash, 'salt' => $salt);
    }

    public function decrypt() {
        $first_letter = substr($this->data->password, 0, 1);
        $last_letter = substr($this->data->password, -1);

        $password = $this->data->salt . $first_letter . $this->data->password . $last_letter . $this->data->salt;

        if (password_verify($password, $this->data->hash)) {
            return true;
        } else {
            return false;
        }
    }
}


?>