<?php
    session_start();
    include_once 'connect.php';

    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];

    $user_id = $_SESSION['user']['id'];
    $query = "SELECT * FROM users WHERE id = $user_id";
    $select = mysqli_fetch_assoc(mysqli_query($connect, $query));
    $query = "UPDATE users SET ";

    if ($email != '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] = 'неправильная почта';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die('err wrong email');
    } else if (!password_verify($password, $select['password'])) {
        $_SESSION['msg'] = 'неправильно введен пароль';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die('err wrong password');
    }

    if ($email != '') {
        $query = "UPDATE users SET email = '$email' WHERE id = $user_id";
        $_SESSION['user']['email'] = $email;
        mysqli_query($connect, $query);
    } 
    if ($new_password != '') {
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = '$new_password' WHERE id = $user_id";
        mysqli_query($connect, $query);
    } 
    if ($name != '') {
        $query = "UPDATE users SET full_name = '$name' WHERE id = $user_id";
        $_SESSION['user']['full_name'] = $name;
        mysqli_query($connect, $query);
    }

    $_SESSION['msg'] = 'данные были успешно изменены';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>