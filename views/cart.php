<?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {


    $cart = array_keys($_SESSION['cart']);
    $productIDs = implode(',', $cart);
    $TotalPrice = 0;

    $sql = "SELECT p.*, i.src, i.alt 
        FROM products p 
        LEFT JOIN images i ON p.id = i.productId AND i.`shop-prikaz` = 1
        WHERE p.id IN ($productIDs)
        GROUP BY p.id"; 
    $proizvodiUKorpi = IzvrsiSelectUpit($sql, true);
    echo "<div class='cart-container'>
          <h2>Vaša korpa</h2>";

    if (!empty($proizvodiUKorpi)) {
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>Slika</th>
                        <th>Proizvod</th>
                        <th>Količina</th>
                        <th>Cena</th>
                        <th>Količina</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($proizvodiUKorpi as $p) {
            $id = $p['id'];
            $kolicina = $_SESSION['cart'][$id];
            // Količinu izvlačimo direktno iz sesije pomoću ID-ja koji imamo iz baze
            $kolicina = $_SESSION['cart'][$id];
            $ime = htmlspecialchars($p['name']);
            $TotalPrice += $p['price'];
            echo "<tr>
                    <td><img src='" . $p['src'] . "' alt='" . $p['alt'] . "' width='50'></td>
                    <td>" . $ime . "</td>
                    <td>" . $kolicina . "</td>
                    <td>" . number_format($p['price'], 2) . " €</td>
                    <td>" . $kolicina . " </td>
                    <td>
                        <a href='funkcijePhp/removeFromCart.php?id=" . $id . "' class='text-danger'>Ukloni</a>
                    </td>
                </tr>";
        }

        echo "</tbody></table>";
        echo "<h3>Ukupna cena: " . number_format($TotalPrice, 2) . " €</h3>";
        echo "<a href='index.php?stranica=buy.php' class='btn btn-primary'>Poruči</a>";;
    } else {
        echo "<p>Vaša korpa je trenutno prazna.</p>";
    }

    echo "</div>";
} else {
    echo "<p>Vaša korpa je trenutno prazna. <a href='index.php?stranica=shop.php'>Nazad na shop.</a></p>";
}
