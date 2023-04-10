<?php
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $postcode  = $_POST['postcode'];
    $user_id = $_SESSION['user']['id'];

    $query = "SELECT * FROM addresses WHERE user_id = $user_id";
    $select_addresses = mysqli_query($connect, $query);
    
    if (mysqli_num_rows($select_addresses) > 0) {
        $query = "UPDATE addresses SET country = '$country', city = '$city', address = '$address', postcode = '$post_code' WHERE user_id = $user_id";
        mysqli_query($connect, $query);
    } else {
        $query = "INSERT INTO addresses ('id', 'user_id', 'country', 'city', 'address', 'postcode') VALUES (NULL, $user_id, $country, $city, $address, $post_code)";
        mysqli_query($connect, $query);
    }
?>