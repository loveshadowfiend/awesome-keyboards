<?php
    require_once 'connect.php';

    $row_id = $_POST['row_id'];
    $query = "SELECT * FROM cart WHERE id = $row_id";
    $select_assoc = mysqli_fetch_assoc(mysqli_query($connect, $query));
    $query = "DELETE FROM cart WHERE id = $row_id";
    mysqli_query($connect, $query);
    $user_id = $select_assoc['user_id'];
    $select = mysqli_query($connect, "SELECT * FROM cart WHERE user_id = $user_id");
    $sum = 0;
    if (mysqli_num_rows($select) > 0) {
        while ($row = mysqli_fetch_assoc($select)) {
            $product_id = $row['product_id'];
            $query = "SELECT * FROM products WHERE id = $product_id";
            $select_product = mysqli_query($connect, $query);
            $product = mysqli_fetch_assoc($select_product);
            $sum += $product['price']*$row['quantity'];
        }

        $response = [
            "status" => true,
            "sum" => number_format($sum, 0, '.', ' ')
        ];
    } else {
        $response = [
            "status" => false
        ];
    }

    echo json_encode($response);
?>