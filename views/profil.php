<?php
$role = $_SESSION['role'];
$response = [];
$errors = [];
include_once('./konekcija/konekcija.php');
if ($db) {

    if ($role == 'admin') {
        
        $query = "SELECT p.*, i.src, i.alt
                           FROM products p 
                           INNER JOIN images i ON p.id = i.productId 
                           WHERE p.new_arrival = 1 
                           AND i.`shop-prikaz` = 1";
        $result = IzvrsiSelectUpit($query, true);






        echo "<div id='products'>
          <table class='table'>
                <thead>
                    <tr>
                        <th>Slika</th>
                        <th>Proizvod</th>
                        <th>Količina</th>
                        <th>Cena</th>
                    </tr>
                </thead>
                <tbody>
        ";
        foreach ($result as $p) {
            echo "<tr>
                    <td><img src='" . $p['src'] . "' alt='" . $p['alt'] . "' width='50'></td>
                    <td>" . $p['name'] . "</td>
                    <td>" . $p['quantity'] . "</td>
                    <td>" . number_format($p['price'], 2) . " €</td>
                </tr>";
        }
        echo"</tbody>
        </table>";




        echo "</div>";
    } 
    elseif ($role=='user') {
        
    }
    else {
        $errors["konekcija sa bazom"] = "Nema konekcije sa bazom";
    }
}
