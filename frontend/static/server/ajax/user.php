<?php

include '../config.php';
include '../classes/UserClass.php';

$User = new User;
$User->getUser($DB);

?>