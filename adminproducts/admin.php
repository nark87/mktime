<!-- ADMIN PHP -->

<!-- ADMIN Home Page MKTIME -->
<?php

    /* Includes - Session */
    include ('../includes/sessionadm.php');

    /* Includes - Navigation Bar */
    include ('../includes/adminnav.php');

    # Open database connection.
    require ( '../connections/connect_db.php' );

    $welcome= "Welcome " . $_SESSION[ 'nickname' ];

    $h3Category = "All Categories";
        
    # Retrieve items from 'products' database table.
    $q = "SELECT * FROM view_items";
    $r = mysqli_query( $link, $q );

    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

        if (isset($_POST['search'])) {

            $sech = mysqli_real_escape_string( $link, trim( $_POST[ 'search' ] ) ) ;

            # Retrieve selected category from 'view_items' database table.
            $q = "SELECT * FROM view_items, view_category_item WHERE 
            (view_items.item_desc LIKE '%$sech%' OR view_items.item_name LIKE '%$sech%') 
            AND view_category_item.category_id = view_items.category_id";
            
            $r = mysqli_query( $link, $q );
            $h3Category = "All Categories";

        } else {

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
        <div class="container">
            <h2>'.$welcome.'</h2>
            <div>
            <form action = "admin.php" method = "post"> 
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
            <div class="row">';

        // Display body section    
        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
            echo '
            <div class="col-md-3 d-flex justify-content-center">
                <div class="card mb-3" style="width: 18rem;">
                    <img src=../'. $row['item_img'].' class="card-img-top" alt="T-Shirt">
                    <div class="card-body">
                        <h5 class="card-title text-center">' . $row['item_name'] .'</h5>
                        <h6 class="card-subtitle mb-2 text-muted text-center">' . $row['category_name'] .'</h6>
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

        // Close database connection
        mysqli_close( $link );
    }
    else { 
        echo '<p>There are currently no items in the table to display.</p>';
    }
?>

<!-- Includes - Footer -->
<?php
 include '../includes/footer.php';
?>