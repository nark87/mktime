<!-- READ PHP -->

<!-- Includes - Navigation Bar -->
<?php
     
    /* Includes - Session */
    include ('../includes/sessionadm.php');

    /* Includes - Navigation Bar */
    include ('../includes/adminnav.php');
    
    # Open database connection.
    require ( '../connections/connect_db.php' );
        
    # Retrieve items from 'products' database table.
    $q = "SELECT * FROM view_items";
    $r = mysqli_query( $link, $q );

    if ( mysqli_num_rows( $r ) > 0 ) {

        echo '
        <div class="container">
            <h2>List of Items</h2>
            <div class="read-container">';
        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
            echo '
                <ul>
                    <li>
                        <span class="read-img"><img src=../'. $row['item_img'].' alt="T-Shirt"></span>
                        <span class="read-name">'.$row['item_name'].'</span>
                        <span class="read-desc">'.$row['item_desc'].'</span>
                        <span class="read-price">&pound'.$row['item_price'].'</span>
                        <a href="../adminproducts/update.php?item_id='.$row['item_id'].'">
                            <span class="read-modify"><i style = "color:orange;" class="bi bi-pencil-fill"></i></span>
                        </a>
                        <a href="../adminproducts/delete.php?item_id='.$row['item_id'].'">
                            <span class="read-modify"><i style = "color:red;" class="bi bi-trash3-fill"></i></span>
                        </a>
                    </li>
                </ul>';
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