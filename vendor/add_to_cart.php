<?php
    require_once 'connect.php';
    session_start();

    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user']['id'];
    $query = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $select = mysqli_query($connect, $query);
    if (mysqli_num_rows($select) > 0) {
        $query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
    } else {
        $query = "INSERT INTO cart (id, user_id, product_id, quantity) VALUES (NULL, $user_id, $product_id, 1)";
    }
    mysqli_query($connect, $query);
?>