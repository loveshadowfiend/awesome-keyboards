<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/keyboards.css"></link>
</head>
<body>
    <?php include 'header.php'; require_once 'vendor/connect.php'; ?>

    <section class="seperator"></section>

    <section class="products">
        <?php 
            $query = "SELECT * FROM products WHERE category = 'клавиатуры'";
            $select = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_assoc($select)) { 
        ?>
        <div class="card" id="<?=$row['id']?>" data-name="<?=$row['id']?>">
            <section class="card-image" style="background-image: url(<?=$row['img']?>)">
            </section>
            <section class="card-description">
                <h1><?=$row['name']?></h1>
                <p><?=number_format($row['price'], 0, '.', ' ');?> руб</p>
            </section>
        </div>
        <?php }; ?>
    </section>

    <section class="products-preview">
        <?php 
            $select = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_assoc($select)) { 
        ?>
            <div class="card-preview" id="<?=$row['id']?>" data-target="<?=$row['id']?>">
                <img src="<?=$row['img']?>" alt="product image">
                <i class="fas fa-times"></i>
                <h1><?=$row['name']?></h1>
                <p><?=number_format($row['price'], 0, '.', ' ');?> руб</p>
                <?php if (array_key_exists('user', $_SESSION)) { ?>
                <form>
                <!-- <button type="submit" class="buy-now" id="<?=$row['id']?>">купить сейчас</button>
                <br> -->
                <button type="submit" class="add-to-cart" id="<?=$row['id']?>">добавить в корзину</button>
                </form>
                <?php } else { ?>
                <br>
                <p style="font-size: 14px;">чтобы купить товар, нужно авторизоваться</p>
                <?php }; ?>
            </div>
        <?php }; ?>
    </section>

    <section class="seperator"></section>

    <script type="text/javascript">
        let previewContainer = document.querySelector('.products-preview');
        let previewBox = previewContainer.querySelectorAll('.card-preview');

        document.querySelectorAll('.card').forEach (product => {
        product.onclick = () => {
            previewContainer.style.display = 'flex';
            let name = product.getAttribute('data-name');
            previewBox.forEach (preview => {
                let target = preview.getAttribute('data-target');
                if (name == target) {
                    preview.classList.add('active');
                }
            });
        };
        });

        previewBox.forEach (close => {
            close.querySelector('.fa-times').onclick = () => {
                close.classList.remove('active');
                previewContainer.style.display = 'none';
            };
        });
    </script>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>