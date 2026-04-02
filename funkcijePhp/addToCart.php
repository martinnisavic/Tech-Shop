<?php
session_start();
if (isset($_GET['productToCartId'])) {
    $id = $_GET['productToCartId'];
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }



if (isset($_GET['productToCartId'])) {
    $id = $_GET['productToCartId'];

    // Ako proizvod već postoji, povećaj za 1, ako ne, postavi na 1
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += 1; 
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    header("Location: ../index.php?stranica=cart.php");
    exit();
}
}

if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    header('Location: ../index.php?stranica=shop.php');
    exit();
}
