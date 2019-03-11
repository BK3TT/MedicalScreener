<?php

$hostname= 'localhost';
$dbname = 'medical-screener';
$username= 'root';
$password= 'password';

try {
    $DB = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
}

?> 