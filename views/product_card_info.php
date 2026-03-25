<?php
if (isset($_GET['idProizvoda'])) {
    $id = $_GET['idProizvoda'];
    include_once('./konekcija/konekcija.php');
    if ($db) {
        $query = "SELECT p.*, i.*
                           FROM products p 
                           INNER JOIN images i ON p.id = i.productId 
                           WHERE p.id=$id
                           ";
        $productDetails = IzvrsiSelectUpit($query, true);

        echo "<div id='Product-Information' class='d-flex'>";
        $index=0;
        echo "<div class='image-buttons-container'>";
        foreach ($productDetails as $product) {
            if ($index==0) {
                # code...
            
            echo "<div class='image-container show product-inf-images'>";
            echo "<img src='" . $product['src'] . "' alt'" . $product['src'] . "'/>";
            echo "</div>";
            $index++;
            }
            else{
                echo "<div class='image-container hide product-inf-images'>";
            echo "<img src='" . $product['src'] . "' alt'" . $product['src'] . "'/>";
            echo "</div>";
            $index++;
            }
            }
            echo"<div class='nav-buttons'>
            <button class='prevBtn'>Previos</button>
            <span class='showing-index'></span>/<span class='current-index'>$index</span>
            <button class='nextBtn'>Next</button</div>";
            echo "</div></div>";
        echo "<div class='product-Information-text'>
                <h3>".$product['name']."</h3>        
            <p>".$product['description']."</p>
                <button><a href='./funkcijePhp/addToCart.php?productToCartId=".$product['productId']."'>Add to cart</a></button>
                    </div>
            ";
        // echo"<div id='image-container'";
        // echo"<img src='".$productDetails."';
        // echo"</div>";


     
        echo "</div>";
    } else {
        echo "nema konekcije";
    }
}
