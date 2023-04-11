<?php
    include 'header.php';
    require_once 'vendor/connect.php';

    if (array_key_exists('user', $_SESSION)) {
        if ($_SESSION['user']['group'] != 'admin') {
            header('Location: ../index.php');
        }
    } else {
        header('Location: ../index.php');
    }

    // if (array_key_exists('delete', $_GET)) {
    //     $id = $_GET['delete'];
    //     mysqli_query($connect, "DELETE FROM products WHERE id = $id");
    //     header('Location: admin_panel.php');
    //  };
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>b1g boss adm1n</title>
    <link rel="stylesheet" href="css/admin_panel.css">
</head>
<body>
    <section class="seperator"></section>

    <form class="form">
        <input type="text" name="product_name" placeholder="название товара">
        <!-- <input type="text" name="product_category" placeholder="категория товара"> -->
        <select name="product_category" id="">
            <option value="клавиатуры">клавиатуры</option>
            <option value="аксессуары">аксессуары</option>
        </select>
        <input type="number" name="product_price" placeholder="цена товара">
        <input type="file" name="product_img" accept="image/png, image/jpeg, image/jpg">
        <button type="submit" class="add_product">добавить товар</button>
        <p class="msg none">Lorem ipsum dolor sit amet.</p>
    </form>

    <section class="seperator"></section>

    <div class="products-display">
        <table class="products-display-table">
            <thead>
                <tr>
                    <td>изображение товара</td>
                    <td>имя товара</td>
                    <td>цена товара</td>
                    <td>категория товара</td>
                    <td>действия</td>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $query = "SELECT * FROM products";
                    $select = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_assoc($select)) { 
                ?>
                <tr id="<?=$row['id']?>">
                    <td> <img src="<?=$row['img']?>" height="200"> </td>
                    <td> <?=$row['name']?> </td>
                    <td> <?=number_format($row['price'], 0, '.', ' ')?> руб</td>
                    <td> <?=$row['category']?> </td>
                    <td> <a href="edit_panel.php?id=<?=$row['id']?>">изменить</a> <br> 
                         <a class="delete-from-products" id="<?=$row['id']?>">удалить</a> 
                    </td>
                </tr>
                <?php }; ?> 
            </tbody>
        </table>
    </div>

    <section class="seperator"></section>

    <?php include 'footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>
