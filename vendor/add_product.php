<?php
    session_start();
    require_once 'connect.php';

    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];

    if ($product_name == '' || $product_category == '' || $product_price == '' || !array_key_exists('product_img', $_FILES)) {
        $response = [
            "status" => false,
            "msg" => "нужно заполнить все поля и загрузить изображение"
        ];
    } else {
        $path = 'uploads/' . time() . uniqid();
        if (!move_uploaded_file($_FILES['product_img']['tmp_name'], '../' . $path)) {
            $response = [
                "status" => false,
                "msg" => "ошибка при загрузке изображения",
            ];
        } else { 
            $query = "INSERT INTO products (id, name, price, category, img) VALUES (NULL, '$product_name', '$product_price', '$product_category', '$path')"; 
            mysqli_query($connect, $query);
            $response = [
                "status" => true,
                "msg" => "товар успешно добавлен",
                "id" => mysqli_insert_id($connect),
                "path" => $path,
                "name" => $product_name,
                "price" => $product_price,
                "category" => $product_category
            ];
        }
    }
    echo json_encode($response);
?>