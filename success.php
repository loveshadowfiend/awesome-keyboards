<?php 
    include 'header.php';
    require_once 'vendor/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>спасибо за покупку!</h1>
    <p>ваш заказ:</p>

    <section class="order">
        <table class="cart-table" cellspacing="0">
                <thead>
                    <tr>
                        <td style="width: 20%"></td>
                        <td style="width: 40%">товар</td>
                        <td style="width: 20%">цена</td>
                        <td style="width: 20%">количество</td>
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
                        <td class="quantity"> <?=$row['quantity']?> </td>
                    </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </section>
</body>
</html>