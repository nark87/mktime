<!-- ADMIN PHP -->

<!-- Includes - Navigation Bar -->
<?php
 include '../includes/adminnav.php';
?>

<!-- Administration Items to the CodeSpace DB -->
<?php
    # Open database connection.
    require ( '../connections/connect_db.php' );
        
    # Retrieve items from 'products' database table.
    $q = "SELECT * FROM products";
    $r = mysqli_query( $link, $q );

    if ( mysqli_num_rows( $r ) > 0 ) {

        echo '
        <div class="container">
            <h2>MKTIME - CMS</h2>
            <div class="row">';
        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
            echo '
            <div class="col-md-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src=../'. $row['item_img'].' class="card-img-top" alt="T-Shirt">
                    <div class="card-body">
                        <h5 class="card-title text-center">' . $row['item_name'] .'</h5>
                        <p class="card-text">'. $row['item_desc'] . '</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><p class="text-center">&pound' . $row['item_price'] . '</p></li>
                        <li class="list-group-item btn"><a class="btn btn-warning btn-lg btn-block" 
                            href="../adminproducts/update.php?item_id='.$row['item_id'].'">Update</a>
                        </li>
                        <li class="list-group-item btn"><a class="btn btn-danger btn-lg btn-block" 
                            href="../adminproducts/delete.php?item_id='.$row['item_id'].'">Delete</a>
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
 include '../includes/footer.php';
?>