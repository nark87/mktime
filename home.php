<!-- HOME PHP -->

<!-- This function likely redirects the user to the login page to authenticate themselves -->

<!-- Home Page MKTIME -->
<?php

    /* Includes - Session */
    include ('includes/session.php');

    /* Includes - Navigation Bar */
    include ('includes/nav.php');

    # Open database connection.
    require ( 'connections/connect_db.php' );

    $welcome= "Welcome " . $_SESSION[ 'nickname' ];
        
    # Retrieve items from 'view_items' database table.
    $q = "SELECT * FROM items";
    $r = mysqli_query( $link, $q );

    if ( mysqli_num_rows( $r ) > 0 ) {

        echo '
        <div class="container">
            <h2>'.$welcome.'</h2>
            <div class="row">';
        
        // Display body section
        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
            echo '
            <div class="col-md-3 d-flex justify-content-center">
                <div class="card mb-3" style="width: 18rem;">
                    <img src='. $row['item_img'].' class="card-img-top" alt="T-Shirt">
                    <div class="card-body">
                        <h5 class="card-title text-center">' . $row['item_name'] .'</h5>
                        <p class="card-text">'. $row['item_desc'] . '</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><p class="text-center">&pound' . $row['item_price'] . '</p></li>
                        <li class="list-group-item btn"><a class="btn btn-success btn-lg btn-block" 
                            href="added.php?id='.$row['item_id'].'">Add to cart</a>
                        </li>
                    </ul>
                </div>
            </div>';
        }

        echo '
        </div>
        </div>';

        // Close database connection
        mysqli_close( $link );
    }
    else {  // Or display this message. No items
        echo '<p>There are currently no items in the table to display.</p>';
    }
?>

<!-- Includes - Footer -->
<?php
    include 'includes/footeruser.html';
    include 'includes/footer.php';
?>