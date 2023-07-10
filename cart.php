<?php
$title = "DoTech | My Cart";
$css = "cart";
require "header.php";
require "userLogChecker.php";
include "navbar.php";
require_once('connection.php');

$queryCoins = "SELECT pokecoins FROM tbl_user_acc WHERE id_number = '".$_SESSION['id_number']."'";
$resultCoins = $conn->query($queryCoins);
if(!$resultCoins){
    die("Query Failed: ".$conn->error);
}else{
    $pkc = $resultCoins->fetch_all(MYSQLI_ASSOC);
    $myCoins = $pkc[0]['pokecoins'];
}

$query = "SELECT * FROM tbl_products";
$result = $conn->query($query);
if(!$result){
    die("Query Failed: ".$conn->error);
}else{
    $products = $result->fetch_all(MYSQLI_ASSOC);
    function getDetails($id, $qty,$products){
        $details = array();
        foreach($products as $item){
            if($item['id'] == $id){
                $details['img'] = $item['image'];
                $details['name'] = $item['name'];
                $details['price'] = $item['price']*$qty;
                $details['currency'] = $item['currency'];
                global $totalPeso;
                global $totalPKC;
                if($details['currency'] == "PHP"):
                    $totalPeso += $details['price'];
                else:
                    $totalPKC += $details['price'];
                endif;
                break;
            }
        }
        return $details;
    }
}

function getPrice($p, $c){
    if($c == "PHP"){
        return "₱ ".number_format($p, 2);
    }else{
        return "$p PokeCoins";
    }
}

$totalPeso = 0;
$totalPKC = 0;
$toBuyPKC = 0;
?>

<div class="container py-5 h-100" style="height: 100vh;">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col">
      <div id="card" class="card">
        <div id="card-content">
            <div class="card-body p-4">

                <div class="row">

                <div class="col-lg-7">
                    <h5 class="mb-3"><a href="store.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <p class="mb-1">Shopping cart</p>
                        <p class="mb-0"><?php 
                            $itemCount = (isset($_SESSION['cart']))? count($_SESSION['cart']) : 0;
                        echo "You have ".$itemCount." items in your Cart.";?>
                        </p>
                    </div>
                    </div>

                    <div id="product-cart">

<?php
                        if(isset($_SESSION['cart'])):
                            global $toBuyPKC;
                            foreach(array_reverse($_SESSION['cart']) as $item): 
                            $details = getDetails($item['prod_id'], $item['qty'], $products);
                            if($details['currency'] == "PHP"):
                                $toBuyPKC += (intval(preg_replace("/[^0-9]/", "", $details['name'])))*$item['qty'];
                            endif;
?>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div>
                                        <img src="<?php echo $details['img']; ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                    </div>
                                    <div class="ms-3">
                                        <h5><?php echo $details['name']; ?></h5>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <div style="width: 50px;">
                                        <h5 class="fw-normal mb-0"><?php echo $item['qty']; ?></h5>
                                    </div>
                                    <div style="width: 200px;">
                                        <h5 class="mb-0"><?php echo getPrice($details['price'], $details['currency']);?></h5>
                                    </div>
                                    <form method="post" action="removeItem.php">
                                        <input type="hidden" name="toRemove" value="<?php echo $item['prod_id'];?>">
                                        <a onclick="removeItem(this)" style="color: #cecece;" onmouseover="this.style.color='red'" onmouseout="this.style.color='#cecece'"><i class="fas fa-trash-alt"></i></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

<?php 
                            endforeach;
                        endif;
?>


                    </div>

                </div>
                <div class="col-lg-5" style="margin-top: 1px;">
                <div class="card bg-primary text-white rounded-3">
                        <div class="card-body" style="height: 80vh;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">GCash Details</h5>
                        </div>
                        <div style="display: flex; justify-content:center; align-items: center;">
                            <img src="images/gcash.png" alt="Gcash" style="width: 300px;">
                        </div>
                        <form class="mt-4" name="checkOut" method="post" action="checkOut.php">

                            <div class="form-outline form-white mb-4">
                                <input type="hidden" name="myCoins" value="<?php echo $myCoins;?>">
                                <input type="hidden" name="coinsBought" value="<?php echo $toBuyPKC;?>">
                                <input type="hidden" name="dueCoins" value="<?php echo $totalPKC;?>">
                                <input name="gcash" type="text" id="typeText" class="form-control form-control-lg" siez="17"
                                    placeholder="09123456789" minlength="11" maxlength="11" />
                                <label class="form-label" for="typeText">GCash Number</label>
                            </div>

                        

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <p class="mb-2">My PokeCoins</p>
                                <p class="mb-2"><?php echo $myCoins;?></p>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Total(Philippine Peso)</p>
                                <p class="mb-2"><?php echo "₱ ".number_format($totalPeso, 2);?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Total(PokeCoins)</p>
                                <p class="mb-2"><?php echo $totalPKC;?></p>
                            </div>
                            <button type="button" class="btn btn-info btn-block btn-lg btn-rounded" onclick="confirmTransact(this)" onmouseover="this.style.color='black'" onmouseout="this.style.color='white'">
                                <div class="d-flex justify-content-between">
                                    <span><?php echo "₱ ".number_format($totalPeso, 2)." + ".$totalPKC." PokeCoins";?></span>
                                    <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                </div>
                            </button>
                        </form>
                        </div>
                    </div>
                </div>

                </div>

            </div>
        </div>
        
      </div>
    </div>
  </div>
</div>

<script>
    function removeItem(element) {
        if (confirm("Are you sure you want to completely remove this item from the cart?")) {
            alert("Product Removed From Cart!");
            var form = element.closest('form');
            form.submit();
        } else {
            alert("Product Removal Canceled!");
        }
    }
    function confirmTransact(element) {
        if (confirm("Confirm Transaction?")) {
            var form = element.closest('form');
            form.submit();
        } else {
            alert("Transaction Canceled!");
        }
    }
</script>



<?php
$conn->close();
require "footer.php";
?>