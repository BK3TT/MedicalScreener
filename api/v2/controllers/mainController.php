<?php 

class MainController {
    public function _populate($data) {
        foreach($data as $key => $val) {
            $this->data = new stdClass();
            $this->data->$key = $val;
        }
    }
}

?>