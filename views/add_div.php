<?php
    include_once("./konekcija/konekcija.php");
    $slika=IzvrsiSelectUpit("SELECT * FROM `images` WHERE `name` = 'laptop-cofee'",false);
    echo"
        <div id='add-wrapp'>
            <div id='add-image-container'>
                <img src='".$slika['src']."' alt='".$slika['alt']."'>
            </div>
            <div id='add-text-content' class=''>
                <h3 class='text-center'>Reklami headline</h3>
                <p class='text-center'>Text</p>
                <button class='bg-transparent border-0'>Shop</button>
            </div>
        </div>
    ";
?>