<?php
    session_start();
    if(isset($_POST['toRemove'])):
        $remove = $_POST['toRemove'];
        if(isset($_SESSION['cart'])):
            $cart = $_SESSION['cart'];
            foreach($cart as $key => $item):
                if($item['prod_id'] == $remove):
                    unset($cart[$key]);
                    break;
                endif;
            endforeach;
            $_SESSION['cart'] = $cart;
    endif;
    endif;
    header("Location: cart.php");
?>