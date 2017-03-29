<?php
require_once 'connection.php';
require_once 'src/User.php';


$user = User::loadUserById($mysqli,4);
//$user = new User();
$user->setUsername('Super_Grupa2');
$user->setEmail('lubiepaczkizbudyniemi@gmail.com');
//$user->setPassword('coderslab');
$user->saveToDB($mysqli);
var_dump($user);
