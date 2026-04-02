<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Koristimo kraće ime radi lakšeg snalaženja
     
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        
        // Proveravamo da li taj proizvod uopšte postoji u korpi
        if (isset($_SESSION['cart'][$id])) {
            
            $kolicina = $_SESSION['cart'][$id];

            if ($kolicina > 1) {
                // Ako ima više od 1, samo smanji broj
                $_SESSION['cart'][$id] -= 1; 
            } else {
                // Ako je ostao samo 1, potpuno obriši taj proizvod iz korpe
                unset($_SESSION['cart'][$id]);
            }
        }
    }
}

// Vraćanje na stranicu korpe
header("Location: ../index.php?stranica=cart.php");
exit();
?>