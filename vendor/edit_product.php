<?php
    session_start();
    require_once 'connect.php';

    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_id = $_POST['product_id'];

    if ($product_name == '' || $product_category == '' || $product_price == '') {
        $response = [
            "status" => false,
            "msg" => "нужно заполнить все поля и загрузить изображение"
        ];
    } else if (!array_key_exists('product_img', $_FILES)) {
        $query = "UPDATE products SET name = '$product_name', price = '$product_price', category = '$product_category' WHERE id = '$product_id'";
        mysqli_query($connect, $query);

        $response = [
            "status" => true
        ];
    } else {
        $path = 'uploads/' . time() . uniqid();
        if (!move_uploaded_file($_FILES['product_img']['tmp_name'], '../' . $path)) {
            $response = [
                "status" => false,
                "msg" => "ошибка при загрузке изображения",
            ];
        } else { 
            $query = "SELECT * FROM products WHERE id = $product_id"; 
            $img = mysqli_fetch_assoc(mysqli_query($connect, $query))['img'];
            if (!unlink('../' . $img)) {
                echo "не удалось удалить изображение";
            }
            $query = "UPDATE products SET name = '$product_name', price = '$product_price', category = '$product_category', img = '$path' WHERE id = '$product_id'";
            mysqli_query($connect, $query);
            $response = [
                "status" => true,
            ];
        }
    }
    echo json_encode($response);
?> 