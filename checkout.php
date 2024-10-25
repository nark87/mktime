<!-- CHECK OUT PHP -->

<!-- Check Out Page MKTIME -->
<?php
    /* Includes - Session */
    include ('includes/session-cart.php');

    /* Includes - Navigation Bar */
    include ('includes/nav.php');

    # Check for passed total and cart
    if (isset( $_GET['total']) && ($_GET['total'] > 0) && (!empty($_SESSION['cart'])))
    {
        # Open database connection.
        require ( 'connections/connect_db.php' );

        # Store buyer and order total in 'orders' database table
        $q = "INSERT INTO view_orders ( user_id, total, order_date ) VALUE (". $_SESSION['user_id'].",". $_GET['total'].", NOW() )";
        $r = mysqli_query ($link, $q);

        # Retrieve current order number
        $order_id = mysqli_insert_id($link);

        # Retrieve cart items from 'items' database table
        $q = "SELECT * FROM view_items WHERE item_id IN (";
        foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
        $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';
        $r = mysqli_query ($link, $q);

        # Store order content in 'order_contents' database table
        while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
        {
            $query = "INSERT INTO view_order_contents ( order_id, item_id, quantity, price )
            VALUES ( $order_id, 
                    ".$row['item_id'].",
                    ".$_SESSION['cart'][$row['item_id']]['quantity'].",
                    ".$_SESSION['cart'][$row['item_id']]['price'].")" ;
            $result = mysqli_query($link,$query);
        }

        # Close database connection
        mysqli_close($link);

        # Display order number
        echo "<div class=\"container\">
            <div class=\"alert alert-primary\" role=\"alert\">
                <p>Thanks for your order. Your Order Number Is #".$order_id." <a href=\"home.php\"> Go HOME</a> </p>  
            </div>
        </div>";

        #Remove cart item
        $_SESSION['cart'] = NULL;
    } else {
        # Display
        echo '<div class=\"container\">
            <div class=\"alert alert-warning\" role=\"alert\">
                <p>There are no items in your cart!</p>  
            </div>
        </div>';
    }
?>

<!-- Includes - Footer -->
<?php
    include 'includes/footer.php';
?>