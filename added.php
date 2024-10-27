<?php

#set page title and display header section
include ('includes/session-cart.php');

include ('includes/nav.php');

#Get passed product id and assign it to a variable
if ( isset( $_GET['id'] ) ) $id = $_GET['id'];

# Open database connection
require ( 'connections/connect_db.php' );

# Retrieve selective item data from 'view_items' database table
$q = "SELECT * FROM view_items WHERE item_id = $id";
$r = mysqli_query( $link, $q);
if (mysqli_num_rows($r) == 1)
{
    $row = mysqli_fetch_array( $r, MYSQLI_ASSOC);
    
    # Check if cart already contains one of this items id
    if ( isset( $_SESSION['cart'][$id]))
    {
        # Add one more of this item
        $_SESSION['cart'][$id]['quantity']++;
        echo '
        <div class="container">
            <div class="alert alert-success" role="alert">
                <p>Another '.$row["item_name"].' has been added to your cart</p>
                <a data-cy="btn-continue" href="home.php"> Continue Shopping</a> | <a data-cy="btn-view-cart" href="cart.php">View Cart</a>
            </div>
        </div>';
    } else
    {
        # Or add one of this item to the cart
        $_SESSION['cart'][$id] = array ('quantity' => 1, 'price' => $row['item_price']);

        echo '
        <div class="container">
            <div data-cy="alert-add-shop" class="alert alert-success" role="alert">
                <p>A '.$row["item_name"].' has been added to your cart</p>
                <a data-cy="btn-continue" href="home.php"> Continue Shopping</a> | <a data-cy="btn-view-cart" href="cart.php">View Cart</a>
            </div>
        </div>';
    }
}

# Close database connection
mysqli_close($link);

include ('includes/footer.php');


?>