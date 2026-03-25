<?php

session_start();

if (isset($_GET['id'])) {
    $idZaBrisanje = $_GET['id'];

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {

        if (array_key_exists($idZaBrisanje, $_SESSION['cart'])) {
            unset($_SESSION['cart'][$idZaBrisanje]);
        }
    }
}

header("Location: ../index.php?stranica=cart.php");
exit();
