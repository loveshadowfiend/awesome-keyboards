<?php

    session_start();
    require_once 'connect.php';

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $check_email = mysqli_query($connect, $query);
    if ($full_name == '' || $email == '' || $password == '') {
        $response = [
            "status" => false,
            "msg" => 'необходимо заполнить все поля'
        ];
    } else if (mysqli_num_rows($check_email) > 0) {
        $response = [
            "status" => false,
            "msg" => 'аккаунт с такой почтой уже существует'
        ];
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = [
            "status" => false,
            "msg" => 'нужно ввести настоящую почту'
        ];
    } else if ($password != $password_confirm) {
            $response = [
                "status" => false,
                "msg" => 'пароли не совпадают'
            ];
    } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (id, full_name, email, password) VALUES (NULL, '$full_name', '$email', '$password')";
            mysqli_query($connect, $query);

            $response = [
                "status" => true
            ];
    }
    echo json_encode($response);

?>