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





        echo "<p><button id='products-profile-show'>Products</button></p>";
        echo "<div id='products' class='hide'>
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
        echo "</tbody>
        </table>
        </div>";

        $query = "SELECT *
                 FROM user";
        $result = IzvrsiSelectUpit($query, true);


        echo "<p><button id='users-profile-show'>Users</button></p>";
        echo "<div id='users' class='hide'>
          <table class='table'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>username</th>
                        <th>email</th>
                        <th>phone</th>
                    </tr>
                </thead>
                <tbody>
        ";
        foreach ($result as $u) {
            echo "<tr>
                    <td>".$u['ime']."</td>
                    <td>" . $u['prezime'] . "</td>
                    <td>" . $u['username'] . "</td>
                    <td>" . $u['email'] . "</td>
                    <td>" . $u['telefon'] . " </td>
                </tr>";
        }
        echo "</tbody>
        </table>";




        echo "</div>";
    } elseif ($role == 'user') {
    } else {
        $errors["konekcija sa bazom"] = "Nema konekcije sa bazom";
    }
}
