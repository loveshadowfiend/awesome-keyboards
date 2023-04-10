<?php
    include 'header.php';
    require_once 'vendor/connect.php';

    if (array_key_exists('id', $_GET)) {
        $id = $_GET['id'];
        $query = "SELECT * FROM products WHERE id = $id";
        $product = mysqli_fetch_assoc(mysqli_query($connect, $query));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_panel.css">
</head>
<body>
    <section class="seperator"></section>

    <form class="form">
        <input type="text" name="product_name" placeholder="название товара" value="<?=$product['name']?>">
        <!-- <input type="text" name="product_category" placeholder="категория товара"> -->
        <select name="product_category" id="">
            <option value="клавиатуры">клавиатуры</option>
            <option value="аксессуары" <?php if ($product['category'] == 'аксессуары') echo 'selected'?>>аксессуары</option>
        </select>
        <input type="number" name="product_price" placeholder="цена товара" value="<?=$product['price']?>">
        <input type="file" name="product_img" accept="image/png, image/jpeg, image/jpg">
        <button type="submit" class="edit_product" id="<?=$id?>">изменить товар</button>
        <p class="msg none">Lorem ipsum dolor sit amet.</p>
    </form>

    <section class="seperator"></section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>
</html>