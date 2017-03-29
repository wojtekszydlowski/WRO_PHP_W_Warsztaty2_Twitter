<?php
require_once ('connection.php');
require_once ('src/User.php');


#Zapiane nowego użytkownika
//$user = new User();
//var_dump($user);
//$user->setPassword("Ala ma kota");
//$user->setEmail("ala2@domena.pl");
//$user->setUsername("Ala102");
//var_dump($user);
//$user->saveToDB($conn);
//var_dump($user);

//var_dump(User::loadUserById($conn, 1));

//var_dump(User::loadAllUser($conn));

#Wczytanie użytkownika o zadanym numerze id
//$user = User::loadUserById($conn,1);
//var_dump($user);

#Wczytanie wszystkich użytkowników
//$users = User::loadAllUser($conn);
//var_dump($users);


#Aktualizacja danych użytkownika
//$user = User::loadUserById($conn,1);
//$user->setUsername("Ela_S");
//$user->saveToDB($conn);


#Usuwanie użytkownika
//$user = User::loadUserById($conn,1);
//echo $user->getId();
//echo "<br>";
//$user->delete($conn);
//echo $user->getId();