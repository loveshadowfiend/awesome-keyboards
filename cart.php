<?php
    require_once 'vendor/connect.php';
    include 'header.php'; 

    if (!array_key_exists('user', $_SESSION)) {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <section class="cart">
        <!-- <p style="font-size: 20px;">корзина</p> -->

        <div class="products">
        <?php 
            $user_id = $_SESSION['user']['id'];
            $query = "SELECT * FROM cart WHERE user_id = $user_id";
            $is_cart_empty = mysqli_num_rows(mysqli_query($connect, $query)) < 1;

            if (!$is_cart_empty) { 
        ?>
        <table class="cart-table" cellspacing="0">
            <thead>
                <tr>
                    <td style="width: 20%"></td>
                    <td style="width: 30%">товар</td>
                    <td style="width: 20%">цена</td>
                    <td style="width: 20%">количество</td>
                    <td style="width: 10%"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $select_cart = mysqli_query($connect, $query);
                    $sum = 0;

                    while ($row = mysqli_fetch_assoc($select_cart)) { 
                        $product_id = $row['product_id'];
                        $query = "SELECT * FROM products WHERE id = $product_id";
                        $select_product = mysqli_query($connect, $query);
                        if (mysqli_num_rows($select_product) < 1) {
                            break;
                        }
                        $product = mysqli_fetch_assoc($select_product);
                        $sum += $product['price']*$row['quantity'];
                ?>
                <tr id="<?=$row['id']?>">
                    <td style="text-align: center"> <img src="<?=$product['img']?>" height="100"> </td>
                    <td> <?=$product['name']?> </td>
                    <td class="price" id="<?=$row['id']?>"> <?=number_format($product['price'], 0, '.', ' ')?> руб </td>
                    <td class="quantity"> <input type="number" name="quantity" id="<?=$row['id']?>" value="<?=$row['quantity']?>"> </td>
                    <td style="text-align: center"> <a class="delete-from-cart" id="<?=$row['id']?>">удалить</a></td>
                </tr>
                <?php }; ?>
            </tbody>
        </table>
        <?php } else { ?>
        <p style="text-align: center">ваша корзина пуста</p>
        <?php } ?>
        </div>

        <?php if (!$is_cart_empty) { ?>
        <section class="seperator" style="height: 5vh"></section>
        <div class="checkout">
            <p class="sum">сумма: <?=number_format($sum, 0, '.', ' ')?> руб</p>
            <button class="buy-cart" id="<?=$user_id?>">оплатить</button>
        </div>
        <?php } else { ?>
        <form action="javascript:history.back()">
        <button>вернуться назад</button>
        </form>
        <?php } ?>
    </section>

    <?php include 'footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>
</html>