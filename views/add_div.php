<?php
    include_once("./konekcija/konekcija.php");
    $slika=IzvrsiSelectUpit("SELECT * FROM `images` WHERE `tip` LIKE 'ReklamnaSlikaHomePage'",false);
    echo"
        <div id='add-wrapp'>
            <div id='add-image-container'>
                <img src='".$slika['src']."' alt='".$slika['alt']."'>
            </div>
            <div id='add-text-content'>
                <h3>Reklami headline</h3>
                <p>Text</p>
                <button>Shop</button>
            </div>
        </div>
    ";
?>