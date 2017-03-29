<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 19.03.17
 * Time: 14:00
 */

//tworzymy bazę danych Twitter
$sql = "CREATE DATABASE Twitter";

//dodajemy tabelę users
$sql = "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255), username VARCHAR(255 UNIQUE, hashed_password VARCHAR(60))";