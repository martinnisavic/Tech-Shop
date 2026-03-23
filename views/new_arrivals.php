<?php


    $ProductImagesQuery="SELECT p.name, i.src, i.alt, p.id
                           FROM products p 
                           INNER JOIN images i ON p.id = i.productId 
                           WHERE p.new_arrival = 1 
                           AND i.`shop-prikaz` = 1";
    $products=IzvrsiSelectUpit($ProductImagesQuery,$db);
    echo"<div id='new-arrivals' class='w-100 row d-flex flex-wrap'>";
    foreach ($products as $product) {
        echo "<div class='new-product-card col-3'>
            <div class='new-arr-card-img'>
                <img  src='".$product['src']."' alt='".$product['alt']."'/>
            </div>
            <button><a href='index.php?idProizvoda=".$product['id']."'>Pogledaj</a></button>
        </div>";
    }



    echo "</div>";
?>