<?php 

class users {
    function getUser($db) {
        $sql = "SELECT * FROM users";
        foreach ($db->query($sql) as $row) {
            echo "users";
        }

        echo "No users";
    }
}

?>