<?php
// Uzimamo sve proizvode
$products = IzvrsiSelectUpit('SELECT * FROM products', true);

foreach($products as $p) {
    // Za SVAKI proizvod idemo u bazu i tražimo NJEGOVE slike
    $product_id = $p['id'];
    $images = IzvrsiSelectUpit("SELECT * FROM images WHERE productId = $product_id", true);
    
    echo "<div class='product-card'>";
    echo "<h3>" . $p['name'] . "</h3>";
    
    // Prolazimo kroz sve slike tog proizvoda
    echo "<div class='product-gallery d-flex'>";
    foreach($images as $img) {
        // Prikazujemo sve slike (npr. kao male sličice)
        echo "<img src='" . $img['src'] . "' alt='" . $img['alt'] . "' style='width:100px;'>";
    }
    echo "</div>";
    
    echo "<p>" . $p['description'] . "</p>";
    echo "</div>";
}
?>