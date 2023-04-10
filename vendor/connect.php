<?php
    $hostname = 'localhost';
    $user = 'root';
    $password = 'banana6346';
    $db = 'onlineshop';
    $connect = mysqli_connect($hostname, $user, $password, $db);

    if (!$connect) { die('failed to connect to database'); }
?>