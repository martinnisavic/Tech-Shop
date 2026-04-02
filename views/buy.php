 <?php
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart']) && isset($_SESSION['userID']) && isset($_SESSION['totalPrice'])) {

         $cart = array_keys($_SESSION['cart']);
        $productIDs = implode(',', $cart);
        $userId=$_SESSION['userID'];
        $totalPrice=$_SESSION['totalPrice'];

        include_once("konekcija/konekcija.php");
        if ($db) {
            // Ubacivanje porudžbine u bazu
            $sql = "INSERT INTO `orders`(`user_id`, `total_price`) 
                        VALUES (:user_id, :total_price)";
            $stmt = $db->prepare($sql);
             $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':total_price', $totalPrice);
            $stmt->execute();
            $orderId = $db->lastInsertId(); 
            //Povezivanje porudzbine i proizvoda
        foreach ($cart as $productId) {
            $quantity = $_SESSION['cart'][$productId];
            $sql = "INSERT INTO `order_items`(`order_id`, `product_id`, `quantity`) 
                    VALUES (:order_id, :product_id, :quantity)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':order_id', $orderId);
            $stmt->bindParam(':product_id', $productId);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->execute();
        }


            echo "<div class='container mt-5'>
            <h2>Hvala na kupovini!</h2>
            <p>Vaša porudžbina je uspešno primljena. Bićete obavešteni kada vaša porudžbina bude spremna za isporuku.</p>
            <a href='index.php' class='btn btn-primary'>Nazad na početnu</a>
          </div>";

            unset($_SESSION['cart']);
        } else {
            echo "<div class='container mt-5'>
            <h2>Došlo je do greške!</h2>
            <p>Nažalost, došlo je do problema sa obradom vaše porudžbine. Molimo vas da pokušate ponovo kasnije.</p>
            <a href='index.php' class='btn btn-primary'>Nazad na početnu</a>
          </div>";
        }
    }


    ?>