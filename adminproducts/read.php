<!-- READ PHP -->

<!-- Includes - Navigation Bar -->
<?php
     
    /* Includes - Session */
    include ('../includes/sessionadm.php');

    /* Includes - Navigation Bar */
    include ('../includes/adminnav.php');
    
    # Open database connection.
    require ( '../connections/connect_db.php' );
        
    //# Retrieve items from 'products' database table.
    //$q = "SELECT * FROM view_items";
    //$r = mysqli_query( $link, $q );

    $h3Category = "All Categories";

    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

        $ca = mysqli_real_escape_string( $link, trim( $_POST[ 'selectcategory' ] ) ) ;

        if ($ca == 'all') {
            # Retrieve selected category from 'view_items' database table.
            $q = "SELECT * FROM view_items, view_category_item WHERE view_category_item.category_id = view_items.category_id";
            $r = mysqli_query( $link, $q );
            $h3Category = "All Categories";
        } else {
            # Retrieve selected category from 'view_items' database table.
            $q = "SELECT * FROM view_items, view_category_item WHERE view_category_item.category_id = view_items.category_id
                AND view_category_item.category_name = '$ca'";
            $r = mysqli_query( $link, $q );
            $h3Category = $ca;
        }


    } else {

        # Retrieve all items from 'view_items' database table.
        $q = "SELECT * FROM view_items, view_category_item WHERE view_category_item.category_id = view_items.category_id";
        $r = mysqli_query( $link, $q );
        $h3Category = "All Categories";
    }

    if ( mysqli_num_rows( $r ) > 0 ) {

        # Retrieve item categories from 'view_category_item' database table.
        $qC = "SELECT category_name FROM view_category_item";
        $rC = mysqli_query( $link, $qC );

        // Select Form
        echo '
        <div class="container cont-read">
            <div>
            <form action = "read.php" method = "post"> 
                <div class="form-group selec">
                    <select name="selectcategory" class="form-control" onchange="this.form.submit()">
                        <option >Select a category</option>';
                        while ( $row = mysqli_fetch_array( $rC, MYSQLI_ASSOC ))
                        {
                            echo '<option name="'.$row['category_name'].'" id="categ" value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
                        }
                    echo '<option name="all" id="categ" value="all">All Categories</option>
                    </select>
                </div>
            </form>
            </div>
            <h3>'.$h3Category.'</h3>
            <div class="read-container">';
        
        // Display body section
        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
            echo '
                <ul>
                    <li>
                        <span class="read-img"><img src=../'. $row['item_img'].' alt="T-Shirt"></span>
                        <span class="read-name">'.$row['category_name'].' - '.$row['item_name'].'</span>
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