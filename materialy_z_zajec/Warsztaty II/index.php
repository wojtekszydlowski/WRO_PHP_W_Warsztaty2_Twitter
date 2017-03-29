<?php
require_once 'connection.php';
require_once 'src/User.php';



/**  Zapisanie danch użytkownika do BD
    $user = new User();
    $user->setEmail('coderslab@o2.pl');
    $user->setUsername('coderslab');
    $user->setHashedPassword('superbezpiecznehaslo');
    $user->saveToDB($mysqli);
    echo $user->getId();
 */

/** Wczytanie użytkownika o danym id
    $user = User::loadUserById($mysqli,2);
    var_dump($user);
    $user = User::loadUserById($mysqli,1);
    var_dump($user);
 */

/**  Wczytanie wszystkich użytkowników
    $usersArray = User::loadAllUsers($mysqli);
    var_dump($usersArray);
 */

/** Modyfikacja użytkownika
    $user = User::loadUserById($mysqli,2);
    $user->setEmail('ala@gmail.com');
    $user->setUsername('ala');
    $user->saveToDB2($mysqli);
 */

/** Usunięcie użytkownika
    $user = User::loadUserById($mysqli,2);
    $user->delete($mysqli);
 */


