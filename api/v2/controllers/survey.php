<?php

class Survey
{
    public function save() {
        global $DB;

        if (isset($_POST) && !empty($_POST)) {
            $user_id = '';

            if(isset($_POST["user_id"])) {
                $user_id = $_POST["user_id"];
                unset($_POST["user_id"]);
            }

            $user = ($user_id > 0 ? $user_id : "guest");

            $answers = json_encode($_POST);

            $data = [
                'user' => $user,
                'answers' => $answers
            ];      

            try {
                $query = "INSERT INTO survey_answers (user, answers) VALUES (:user, :answers)";
                $stmt= $DB->prepare($query);
                $stmt->execute($data);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}


?>