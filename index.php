<!-- HOME PHP -->

<!-- Home Page to the CodeSpace DB -->
<?php
    # Open database connection.
    require ( 'connections/connect_db.php' );

    # Get User Email from Log In
    if (isset($_GET['user_email'])) {
        
        $user_email = $_GET['user_email'];

        /* Includes - User Navigation Bar */
        include 'includes/usernav.php';

        $welcome = "WELCOME " . $user_email;

       /* $sql_item = "SELECT * FROM products WHERE item_id='$id'";
        $result_item = mysqli_query($link,$sql_item);
        $row_item = mysqli_fetch_array($result_item, MYSQLI_ASSOC);
        $id_item = $row_item['item_id'];
        $a_item = array("id" => $row_item['item_id'],
                        "name" => $row_item['item_name'],
                        "desc" => $row_item['item_desc'],
                        "img" => $row_item['item_img'],
                        "price" => $row_item['item_price']);*/
    } else {
        /* Includes - Navigation Bar */
        include 'includes/nav.php';

        $welcome= "HOME";
    }
        
    # Retrieve items from 'products' database table.
    $q = "SELECT * FROM products";
    $r = mysqli_query( $link, $q );

    if ( mysqli_num_rows( $r ) > 0 ) {

        echo '
        <div class="container">
            <h2>MKTIME - '.$welcome.'</h2>
            <div class="row">';
        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
            echo '
            <div class="col-md-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src='. $row['item_img'].' class="card-img-top" alt="T-Shirt">
                    <div class="card-body">
                        <h5 class="card-title text-center">' . $row['item_name'] .'</h5>
                        <p class="card-text">'. $row['item_desc'] . '</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><p class="text-center">&pound' . $row['item_price'] . '</p></li>
                        <li class="list-group-item btn"><a class="btn btn-success btn-lg btn-block" 
                            href="adminproducts/update.php?item_id='.$row['item_id'].'">Add to cart</a>
                        </li>
                        <li class="list-group-item btn"><a class="btn btn-primary btn-lg btn-block" 
                            href="adminproducts/delete.php?item_id='.$row['item_id'].'">Buy</a>
                        </li>
                    </ul>
                </div>
            </div>';
        }

        echo '
        </div>
        </div>';
    }
    else { 
        echo '<p>There are currently no items in the table to display.</p>';
    }
?>

<!-- Includes - Footer -->
<?php
    include 'includes/footer.php';
?>