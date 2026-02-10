<?php


        $ProductImagesQuery="SELECT * FROM `images` WHERE name NOT LIKE 'logo'";
    $ProductImages=IzvrsiSelectUpit($ProductImagesQuery,$db);

    echo"<div id='new-arrivals' class='w-100 row d-flex'>";
    for ($i=0; $i <count($ProductImages); $i++) { 
        echo "<div class='new-product-card col-3'>
            <div class='new-arr-card-img'>
                <img src='".$ProductImages[$i]['src']."' alt='".$ProductImages[$i]['alt']."'/>
            </div>
        </div>";
    }



    echo "</div>";
?>