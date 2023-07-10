<?php
$title = "DoTech | My Transactions";
$css = "transactions";
require "header.php";
require "userLogChecker.php";
include "navbar.php";
require_once('connection.php');

$query = "SELECT transaction_id, date FROM tbl_transactions WHERE id_number = '".$_SESSION['id_number']."'";
$result = $conn->query($query);
if(!$result){
    die("Query Failed: ".$conn->error);
}else{
    $transactions = $result->fetch_all(MYSQLI_ASSOC);
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
                    <h5 class="mb-3"><a href="store.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <p class="mb-1">Transactions</p>
                        <p class="mb-0"><?php 
                            $itemCount = count($transactions);
                        echo "You have made ".$itemCount." transactions.";?>
                        </p>
                        <p>Click transaction number(i.e. <a style="color: #54B4D3;" onmouseover="this.style.color='#3B71CA'" onmouseout="this.style.color='#54B4D3'"><i class="fas fa-file-invoice-dollar"> 00001</i></a>) to view items bought.</p>
                    </div>
                    </div>

                    <div id="product-cart">

<?php
                            foreach(array_reverse($transactions) as $tran): 
?>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div style="text-align: center;">
                                    <form method="post" action="viewProducts.php">
                                        <input type="hidden" name="toView" value="<?php echo $tran['transaction_id'];?>">
                                        <h5><a onclick="viewProducts(this)" style="color: #54B4D3;" onmouseover="this.style.color='#3B71CA'" onmouseout="this.style.color='#54B4D3'"><i class="fas fa-file-invoice-dollar"> <?php echo $tran['transaction_id']; ?></i></a></h5>
                                    </form>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <div style="width: 115px;">
                                        <h5 class="mb-0"><?php echo $tran['date']; ?></h5>
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