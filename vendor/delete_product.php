<?php
    session_start();
    require_once 'connect.php';

    $id = $_POST['id'];
    $query = "SELECT * FROM products WHERE id = $id";
    $img = mysqli_fetch_assoc(mysqli_query($connect, $query))['img'];
    if (!unlink('../' . $img)) {
        echo "не удалось удалить изображение";
    }
    $query = "DELETE FROM products WHERE id = $id";
    mysqli_query($connect, $query);
?>