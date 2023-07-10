<?php
$title = "DoTech | Store";
$css = "store";
require "header.php";
require "userLogChecker.php";
include "navbar.php";
function getPrice($p, $c){
    if($c == "PHP"){
        return "₱ ".number_format($p, 2);
    }else{
        return "$p PokeCoins";
    }
}

require_once('connection.php');
$buy_pc = "SELECT * FROM tbl_products WHERE currency = 'PHP'";
$buy_items = "SELECT * FROM tbl_products WHERE currency = 'PKC'";
$result_1 = $conn->query($buy_pc);
$result_2 = $conn->query($buy_items);
if(!$result_1){
    die("Query Failed: ".$conn->error);
}else{
    $pokecoins = $result_1->fetch_all(MYSQLI_ASSOC);
}
if(!$result_2){
    die("Query Failed: ".$conn->error);
}else{
    $pokeitems = $result_2->fetch_all(MYSQLI_ASSOC);
}

?>

<div class="container" id="container">
    <div class="row">

<?php
    forEach($pokecoins as $item):
?>
        
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="<?php echo $item['image']; ?>" class="img-fluid" />
                    <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                    </a>
                </div>
                <div class="card-header">
                    <p><?php echo $item['name'];?></p>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo getPrice($item['price'], $item['currency']);?></p>
                    <form method="post" action="addToCart.php">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <button type="button" id="cartButton" class="btn btn-info btn-rounded" onclick="addToCart(this)" style="width: 100%;" onmouseover="this.style.backgroundColor='#3B71CA'" onmouseout="this.style.backgroundColor='#54B4D3'"><i class="fas fa-cart-shopping"></i> Add To Cart</button>
                    </form>
                </div>
            </div>
        </div>

<?php
    endforEach;
?>

    </div>
</div>

<div class="container" id="container">
    <div class="row">

<?php
    forEach($pokeitems as $item):
?>
        
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="<?php echo $item['image']; ?>" class="img-fluid" />
                    <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                    </a>
                </div>
                <div class="card-header">
                    <p><?php echo $item['name'];?></p>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo getPrice($item['price'], $item['currency']);?></p>
                    <form method="post" action="addToCart.php">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <button type="button" class="btn btn-info btn-rounded" onclick="addToCart(this)" style="width: 100%;" onmouseover="this.style.backgroundColor='#3B71CA'" onmouseout="this.style.backgroundColor='#54B4D3'"><i class="fas fa-cart-shopping"></i> Add To Cart</button>
                    </form>
                </div>
            </div>
        </div>

<?php
    endforEach;
?>

    </div>
</div>

<script>
    function addToCart(btn){
        if (confirm("Are you sure you want to add this item to the cart?")) {
                var form = btn.closest('form');
                alert("Product Added To Cart!");
                form.submit();
            }else{
                alert("Product Not Added To Cart!");
            }
    }
</script>


<?php
$conn->close();
require "footer.php";
?>