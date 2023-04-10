<?php 
    session_start();
    require_once 'vendor/connect.php';

    $is_user = array_key_exists('user', $_SESSION);
    if ($is_user) { 
        $redirect_user = 'profile.php';
        $redirect_cart = 'cart.php';

        $full_name = explode(' ', $_SESSION['user']['full_name']);
        if (count($full_name) > 1) {
            $username = $full_name[1];
        } else if((!$_SESSION['user']['full_name'])) {
            $username = 'незнакомец'; 
        } else if (count($full_name) > 0) {
            $username = $full_name[0];
        }
    } else { 
        $username = 'гость';
        $redirect_user = $redirect_cart = 'login.php';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css"></style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <section id="header">
        <a class="title" href="index.php">awesome keyboards</a>
        <ul>
            <li>
                <div class="wrapper">
                    <a href="<?=$redirect_cart?>"><i class="fa-solid fa-cart-shopping"></i></a> 
                    <?php 
                        if ($is_user) { 
                            $user_id = $_SESSION['user']['id'];
                            $query = "SELECT * FROM cart WHERE user_id = $user_id";
                            $cart_count = mysqli_num_rows(mysqli_query($connect, $query));
                            if ($cart_count) {
                    ?>
                    <span class='badge badge-warning' id='lblCartCount'><?=$cart_count?></span>
                    <?php 
                            }
                        }   
                    ?>
                </div>
            </li>
            <li><a href="index.php" class="title-mobile">awesome keyboards</a></li>
            <li><a href="<?=$redirect_user?>" class="profile"><i class="fa-solid fa-user"></i> <?=$username?></a></li>
        </ul>
    </section>
    <section id="header-nav">
        <ul>
            <li><a href="keyboards.php">клавиатуры</a></li>
            <li><a href="accessories.php">аксессуары</a></li>
        </ul>
    </section>
</body>
</html>