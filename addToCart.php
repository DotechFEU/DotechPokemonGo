<?php
session_start(); // Start the session

if (isset($_POST['id'])) {
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
        $same = false;
        /*Checks if item already exists in the cart.*/
        foreach($cart as &$prod){
            /*If item exists.*/
            if($prod['prod_id'] == $_POST['id']){
                $same = true;
                /*Increment quantity.*/
                $prod['qty']++;
                break;
            }
        }
        /*If doesn't exist in the cart.*/
        if(!$same){
            /*Add item to cart.*/
            $cart[] = array('prod_id'=> $_POST['id'],'qty'=> 1);
        }
    }else{
        $cart = array(array('prod_id'=> $_POST['id'],'qty'=> 1));
    }
    $_SESSION['cart'] = $cart;
}

header("Location: store.php");

?>
