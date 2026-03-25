<?php
session_start();
$stranica = "";
$ulogovan = false;
$proizvodInfo=false;
if (isset($_SESSION['ulogovan'])) {
    $ulogovan = true;
}
if (isset($_GET['stranica'])) {
    $stranica = $_GET['stranica'];
}
if (isset($_GET['idProizvoda'])){
    $proizvodInfoId=$_GET['idProizvoda'];
    $proizvodInfo=true;
}
?>
<!DOCTYPE html>
<html>
<?php
require_once("views/head.php");
?>

<body>
    <?php 
    require_once("views/nav.php"); 
    require_once("views/first_div.php");

    // GLAVNI KONTROLER
    if ($proizvodInfo) {
        require_once("views/product_card_info.php");
    } else {
        switch ($stranica) {
            case 'login.php':
                require_once("views/login.php");
                break;
            case 'register.php':
                require_once("views/register.php");
                break;
            case 'shop.php':
                require_once("views/shop.php");
                break;
            case 'about.php':
                require_once('views/about.php');
                break;
            case 'cart.php': 
                require_once("views/cart.php");
                break;
            default:
                
                require_once("views/new_arrivals.php");
                require_once("views/add_div.php");
                break;
        }
    }

    require_once("views/footer.php");
    ?>
    <script type="module" src="assets/main.js"></script>
</body>

</html>