<?php
    include 'header.php';
    require_once 'vendor/connect.php';

    if (array_key_exists('product_id', $_GET)) {
        $product_id = $_GET['product_id'];
    } else if (array_key_exists('user', $_SESSION)) {
        $user_id = $_SESSION['user']['id'];
        $query = "SELECT * FROM cart WHERE user_id = $user_id";
        $select = mysqli_query($connect, $query);

        if (mysqli_num_rows($select) < 1) {
            header("Location: ../index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="order.css">
</head>
<body>
    <section class="order">
        <form action="">
            <input type="text" name="name" placeholder="фио" value="<?= $_SESSION['user']['full_name'] ?>">
            <input type="text" name="country" placeholder="страна">
            <input type="text" name="city" placeholder="город">
            <input type="text" name="address" placeholder="адрес">
            <input type="text" name="postcode" placeholder="почтовый индекс">
            <button type="submit" class="pay">перейти к оплате</button>
        </form>
    </section>
</body>
</html>

<?php
    include 'footer.php';
?>