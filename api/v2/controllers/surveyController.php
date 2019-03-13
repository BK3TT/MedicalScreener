<?php

class SurveyController extends MainController
{
    public function save() {
        $user_id = '';

        if(isset($this->user_id)) {
            $user_id = $this->data->user_id;
            unset($this->data->user_id);
        }

        $user = ($user_id > 0 ? $user_id : "guest");

        $answers = json_encode($this->data);

        $data = [
            'user' => $user,
            'answers' => $answers
        ];

        try {
            $query = "INSERT INTO survey_answers (user, answers) VALUES (:user, :answers)";
            $this->DB->PostData($query, $data);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}


?>