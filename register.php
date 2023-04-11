<?php 
    include_once 'header.php';

    if (array_key_exists('user', $_SESSION)) {
        header('Location: ../profile.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section id="auth">
        <form class="form">
            <h1>регистрация</h1>
            <h3>уже есть аккаунт? <a href="login.php" style="text-decoration: underline">авторизуйтесь здесь!</a></h3>
            <input type="text" name="full_name" placeholder="фио">
            <input type="text" name="email" placeholder="почта">
            <input type="password" name="password" placeholder="пароль">
            <input type="password" name="password_confirm" placeholder="подтвердите пароль">
            <button type="submit" class="register">зарегистрироваться</button>
            <p class="msg none"></p>
        </form>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="main.js"></script>
</html>