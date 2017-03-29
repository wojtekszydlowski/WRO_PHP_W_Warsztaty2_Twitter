<?php
$mysqli = new mysqli("localhost", "root", "", "twitter");
if ($mysqli->connect_errno) {
    echo "Wystąpił błąd w połączeniu";
} else {
    echo "Udało się połączyć";
}