<?php 
    include 'header.php';

    if (!$_SESSION['user']) {
        header('Location: ../login.php');
    } else if (!$_SESSION['user']['full_name']){
        $username = 'незнакомец';
    } else {
        $email = $_SESSION['user']['email'];
        $full_name = explode(' ', $_SESSION['user']['full_name']);
        if (count($full_name) > 1) {
            $first_name = $full_name[1];
        } else {
            $first_name = $full_name[0];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <section id="profile">
        <p>привет, <?=$first_name?>!</p>

        <form class="data" action="vendor/update_credentials.php" method="post">
            <!-- <div class="credentials-wrapper"> -->
            <input type="text" name="email" placeholder="<?=$_SESSION['user']['email']?>">
            <input type="text" name="name" placeholder="<?=$_SESSION['user']['full_name']?>">
            <input type="password" name="password" placeholder="пароль">
            <input type="password" name="new_password" placeholder="новый пароль">
            <!-- </div> -->
            <button type="submit" class="change-credentials">поменять даннные</button>
            <?php 
                if(array_key_exists('msg', $_SESSION)) { 
            ?>
                    <p class="msg"><?=$_SESSION['msg']?></p>
            <?php
                    unset($_SESSION['msg']); 
                }; 
            ?>
        </form>

        <!-- <form class="data">
            <input type="text" name="country" id="country" placeholder="страна">
            <input type="text" name="city" placeholder="город">
            <input type="text" name="address" placeholder="адрес">
            <input type="text" name="postcode" placeholder="почтовый индекс">
            <button type="submit" class="change-address">поменять адрес</button>
        </form> -->

        <form action="vendor/logout.php" method="post">
            <button>выйти</button>
        </form>

        <form action="admin_panel.php">
            <?php if ($_SESSION['user']['group'] == 'admin') { ?>
            <button>админ-панель</button>
            <?php }; ?>
        </form>
    </section>
</body>
</html>

<?php include 'footer.php'?>