<?php
//Stwórz poniżej odpowiednie zmienne z danymi do bazy
$server = '127.0.0.1'; //== localhost  localhost == 127.0.0.1
$username = 'root';
$password = 'coderslab';
$dbname = 'Twitter';

//Poniżej napisz kod łączący się z bazą danych
$conn = new mysqli($server,$username,$password,$dbname);

if ($conn->connect_error) {
    die ('Coś się popsuło...' . $conn->connect_error);
    //Tutaj nigdy nie dojdzie.
    //Nic dalej się nie wykona, nigdy.
} else {
    echo 'Udało się połączyć...<br>';
}