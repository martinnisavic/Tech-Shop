    <?php
    
    $sql = "SELECT p.id,p.name,p.description, p.price, i.src, i.alt 
            FROM products p 
            LEFT JOIN images i ON p.id = i.productId AND i.`shop-prikaz`=1
            ORDER BY p.id
            "; //Left join da bi vratila baza i proizvode bez slike

    $result = IzvrsiSelectUpit($sql, true);

    $proizvodi = [];

    foreach ($result as $row) {
        $id = $row['id'];
        if (!isset($proizvodi[$id])) {
            $proizvodi[$id] = [
                'id' => $id,
                'name' => $row['name'],
                'description' => $row['description'],
                'price'=>$row['price'],
                'images' => []
            ];
        }
        if ($row['src']) {
            $proizvodi[$id]['images'][] = [
                "src" => $row['src'],
                "alt" => $row['alt']
            ];
        }
    }



    // Prikaz
    foreach ($proizvodi as $p) {
        echo "<div class='product-card'>";
        echo "<h3>" . htmlspecialchars($p['name']) . "</h3>";

        echo "<div class='product-gallery d-flex' style='gap:10px;'>";
        foreach ($p['images'] as $img) {
            echo "<img src='" . $img['src'] . "' alt='" . $img['alt'] . "' style='width:100px; height:auto;'>";
        }
        echo "</div>";

        echo "<p>" . htmlspecialchars($p['description']) . "</p>";
        // Popravljen link (izbrisana tačka ispred zagrade i sređen href)
        echo "<p><button><a href='./funkcijePhp/addToCart.php?productToCartId=".$p['id']."'>Add to cart</a></button></p>";
        echo "</div>";
    }
    ?>