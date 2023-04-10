<?php
    session_start();
    require_once 'connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == '' || $password == '') {
        $response = [
            "status" => false,
            "msg" => 'необходимо ввести почту и пароль',
        ];
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = [
            "status" => false,
            "msg" => 'нужно ввести почту',
        ];
    } else {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $check_user = mysqli_query($connect, $query);
        $user = false;
        if (mysqli_num_rows($check_user)) {
            $user = mysqli_fetch_assoc($check_user);
        }

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                "id" => $user['id'],
                "email" => $user['email'],
                "full_name" => $user['full_name'],
                "group" => $user['group'],
            ];

            $response = [
                "status" => true,
            ];    
        } else {
            $response = [
                "status" => false,
                "msg" => 'неправильная почта или пароль'
            ];
        }
    }

    echo json_encode($response);
?>