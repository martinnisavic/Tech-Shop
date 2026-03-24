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
    <?php if ($proizvodInfo):?>
            <?php 
                require_once("views/nav.php"); 
                require_once("views/first_div.php");
                require_once("views/product_card_info.php");
                require_once("views/footer.php");
                ?>
    <?php  ?>
    <?php elseif (!$ulogovan): ?>
        <?php
        switch ($stranica) {
            case 'login.php':
                require_once("views/nav.php"); 
                require_once("views/first_div.php");
                require_once("views/login.php");
                require_once("views/footer.php");
                break;
            case 'about.php':
                require_once("views/nav.php"); 
                require_once("views/first_div.php");
                require_once("views/footer.php");
                break;
            case 'register.php':
                require_once("views/nav.php"); 
                require_once("views/first_div.php");
                require_once("views/register.php");
                require_once("views/footer.php");
                break;
            case 'shop.php':
                require_once("views/nav.php");
                require_once("views/first_div.php");
                require_once("views/shop.php");                
                require_once("views/footer.php");
                break;
            default:
                require_once("views/nav.php"); 
                require_once("views/first_div.php");
                require_once("views/new_arrivals.php");
                require_once("views/add_div.php");
                require_once("views/footer.php");
                break;
        }
        // require_once ("views/register.php");
        ?>
    <?php endif ?>
    <script type="module" src="assets/main.js"></script>
</body>

</html>