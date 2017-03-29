<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 2017-03-19
 * Time: 14:22
 */
$mysqli = new mysqli("localhost", "root", "", "twitter");
if ($mysqli->connect_errno) {
    echo "Wystąpił błąd w połączeniu";
} else {
    echo "Udało się połączyć";
}