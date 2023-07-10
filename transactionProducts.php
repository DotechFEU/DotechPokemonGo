<?php
$title = "DoTech | Products";
$css = "transactions";
require "header.php";
require "userLogChecker.php";
include "navbar.php";
require_once('connection.php');
$transaction_id = $_SESSION['transaction_id'];
$query =   "SELECT tp.transaction_id, tp.product_id, tp.quantity, p.image, p.name, p.price, p.currency
            FROM tbl_transaction_products tp
            JOIN tbl_products p ON tp.product_id = p.id
            WHERE tp.transaction_id = $transaction_id";
$result = $conn->query($query);
if(!$result){
    die("Query Failed: ".$conn->error);
}else{
    $products = $result->fetch_all(MYSQLI_ASSOC);
    function getDetails($id, $qty,$products){
        $details = array();
        foreach($products as $item){
            if($item['product_id'] == $id){
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

?>

<div class="container py-5 h-100" style="height: 100vh; max-width: 1000px;">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col">
      <div id="card" class="card">
        <div id="card-content">
            <div class="card-body">

                <div class="row">

                <div class="col-lg-12">
                    <h5 class="mb-3"><a href="transactions.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>View Transactions</a></h5>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <p class="mb-1">Transaction Products</p>
                        <p class="mb-0"><?php 
                            $itemCount = count($products);
                        echo "You bought ".$itemCount." items in this transaction.";?>
                        </p>
                    </div>
                    </div>

                    <div id="product-cart">

<?php
                            foreach($products as $item): 
                            $details = getDetails($item['product_id'], $item['quantity'], $products);
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
                                        <h5 class="fw-normal mb-0"><?php echo $item['quantity']; ?></h5>
                                    </div>
                                    <div style="width: 200px;">
                                        <h5 class="mb-0"><?php echo getPrice($details['price'], $details['currency']);?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<?php 
                            endforeach;
?>


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
    function viewProducts(element){
        var form = element.closest('form');
        form.submit();
    }
</script>

<?php
$conn->close();
require "footer.php";
?>