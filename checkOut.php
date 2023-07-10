<?php
session_start();
require_once('connection.php');
$gcash = $_POST['gcash'];
$id = $_SESSION['id_number'];
$myCoins = $_POST['myCoins'];
$dueCoins = $_POST['dueCoins'];
$coinsBought = $_POST['coinsBought'];

if (isset($_POST['gcash'])) {
    if ($_POST['gcash'] != NULL) {
        if (!preg_match("/^09\d{9}$/", $_POST['gcash'])) {
            echo "wrong format";
        } else {
            if ($myCoins < $dueCoins) {
                ?>
                <script>
                    alert("Not Enough PokeCoins!");
                    window.location.href = "cart.php";
                </script>
                <?php
            } else {
                $pokewallet = $myCoins - $dueCoins;
                $pokewallet += $coinsBought;

                // Update user's pokecoins in tbl_user_acc
                $updateUserQuery = "UPDATE tbl_user_acc SET pokecoins = $pokewallet WHERE id_number = '$id'";
                if (!$conn->query($updateUserQuery)) {
                    die("Query Failed: " . $conn->error);
                }

                // Insert the transaction details into tbl_transactions
                $insertTransactionQuery = "INSERT INTO tbl_transactions (id_number) VALUES ('$id')";

                if ($conn->query($insertTransactionQuery) === TRUE) {
                    // Transaction created successfully

                    $transactionId = $conn->insert_id; // Get the auto-generated transaction ID

                    // Iterate over the products in the session cart
                    foreach ($_SESSION['cart'] as $item) {
                        $prod_id = $item['prod_id'];
                        $qty = $item['qty'];

                        // Insert the product details into tbl_transaction_products using the generated transaction ID
                        $insertProductQuery = "INSERT INTO tbl_transaction_products (transaction_id, product_id, quantity) VALUES ('$transactionId', '$prod_id', '$qty')";

                        if (!$conn->query($insertProductQuery)) {
                            echo "Error storing product in transaction: " . $conn->error;
                        }
                    }

                    unset($_SESSION['cart']);
                    ?>
                    <script>
                        alert("Transaction Successful!");
                        window.location.href = "cart.php";
                    </script>
                    <?php
                } else {
                    // Handle the case where the transaction creation fails
                    echo "Error creating transaction: " . $conn->error;
                }
            }
        }
    } else {
        ?>
        <script>
            alert("Please enter your GCash Number!");
            window.location.href = "cart.php";
        </script>
        <?php
    }
}
$conn->close();
?>
