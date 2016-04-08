<?php
/**
 * Created by PhpStorm.
 * User: black caviar
 * Date: 19/03/16
 * Time: 15:38
 */


$product_id = array(
    'p_id' => htmlentities($_POST['product_id'])
);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart']) ){
    $_SESSION['cart'] = array();
    $_SESSION['cart'][] = $product_id;
}else{
    $_SESSION['cart'][] = $product_id;
}


?>