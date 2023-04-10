<?php
    require_once 'connect.php';
    session_start();

    if ($_SESSION['user']) {
        // $user_id = $_SESSION['user']['id'];
        // foreach ($_SESSION['user']['cart'] as $product_id => $quantity) {
        //     $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)";
        //     mysqli_query($connect, $query);
        // }
        unset($_SESSION['user']);
        header('Location: ../login.php');
    } else {
        die('invalid session');
    }

?>