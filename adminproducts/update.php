<!-- UPDATE PHP -->

<!-- ADMIN - Update Items Page MKTIME -->

<!-- Includes - Navigation Bar -->
<?php
        
    /* Includes - Session */
    include ('../includes/sessionadm.php');

    /* Includes - Navigation Bar */
    include ('../includes/adminnav.php');
    
    # Open database connection.
    require ( '../connections/connect_db.php' );

    # Retrieve item categories from 'view_category_item' database table.
    $qC = "SELECT * FROM view_category_item";
    $rC = mysqli_query( $link, $qC );
    
    if (isset($_GET['item_id'])) {
        $id = $_GET['item_id'];

        $sql_item = "SELECT * FROM view_items, view_category_item WHERE view_items.category_id = view_category_item.category_id AND item_id='$id'";
        $result_item = mysqli_query($link,$sql_item);
        $row_item = mysqli_fetch_array($result_item, MYSQLI_ASSOC);
        $id_item = $row_item['item_id'];
        $a_item = array("id" => $row_item['item_id'],
                        "name" => $row_item['item_name'],
                        "desc" => $row_item['item_desc'],
                        "cat" => $row_item['category_name'],
                        "cat_num" => $row_item['category_id'],
                        "img" => $row_item['item_img'],
                        "price" => $row_item['item_price']);
    } else {
        $a_item = array("img" => "img/no_img.jpg");
    }

    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

        # Initialize an error array.
        $errors = array();

        # Check for item id .
        if ( empty( $_POST[ 'item_id' ] ) ){
            $errors[] = 'Update item id.' ;
        }
        else {
            $id = mysqli_real_escape_string( $link, trim( $_POST[ 'item_id' ] ) ) ;
        }

        # Check for item name .
        if ( empty( $_POST[ 'item_name' ] ) ){
            $errors[] = 'Update item name.' ;
        }
        else {
            $n = mysqli_real_escape_string( $link, trim( $_POST[ 'item_name' ] ) ) ;
        }

        # Check for a item decription.
        if (empty( $_POST[ 'item_desc' ] ) ) {
            $errors[] = 'Update item description.' ;
        }
        else {
            $d = mysqli_real_escape_string( $link, trim( $_POST[ 'item_desc' ] ) ) ;
        }
    
        # Check for a item image.
        if (empty( $_POST[ 'item_img' ] ) ) {
            $errors[] = 'Update image path.' ;
        } 
        else {
            $img = mysqli_real_escape_string( $link, trim( $_POST[ 'item_img' ] ) ) ;
        }

        # Check for a item category.
        if (empty( $_POST[ 'selectcategory' ] ) ) {
            $errors[] = 'Enter the item category.' ;
        }
        else {
            $c = mysqli_real_escape_string( $link, trim( $_POST[ 'selectcategory' ] ) ) ;
        }
    
        # Check for a item price.
        if (empty( $_POST[ 'item_price' ] ) ) {
            $errors[] = 'Update item price.' ;
        }
        else {
            $p = mysqli_real_escape_string( $link, trim( $_POST[ 'item_price' ] ) ) ;
        }

        # On success data into my_table on database.
        if ( empty( $errors ) ) {
            $q = "UPDATE view_items SET item_id='$id', item_name='$n', item_desc='$d', item_img='$img', item_price='$p', category_id='$c'  WHERE item_id='$id'";
            $r = @mysqli_query ( $link, $q ) ;
 
            if ($r) {
                //header("Location: ../adminproducts/admin.php");
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><h5 class="alert-heading" id="err_msg">Item updated successfully!</h5>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>';
            } 
            else {
                //echo "Error updating record: " . $link->error;
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><h5 class="alert-heading" id="err_msg">Error updating record: '. $link->error .'</h5>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>';
            }
    
            # Close database connection.
            mysqli_close($link); 
        }
        else # Or report errors.
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><h5 class="alert-heading" id="err_msg">The following errors occurred:</h5>';
            foreach ( $errors as $msg )
            { echo " - $msg<br>" ; }
            echo 'Please try again.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>';
            
            # Close database connection.
            mysqli_close( $link );   
        }  
    }
?>

<!-- Container -->
<div class="update-section">
    <form action = "update.php" method = "post" class="update-container">
        <div class = "update-left"> 
            <div class = "update-left-title">
                <h2>Update Item</h2>
                <hr>
            </div>
            
            <!-- Item ID  -->
            <label for = "id">Item ID:</label>
            <input type = "text" 
                class = "update-inputs" 
                name = "item_id"
                id="item_id"
                placeholder = "Enter the item id" 
                required
                readonly
                value = "<?php if (isset($_POST['item_id']))  // If it comes from POST
                    {  echo $_POST['item_id']; } else { echo $a_item['id'];} // It comes from GET?>">
        
            <!-- Input box for Item name  -->
            <label for = "name">Name:</label>
            <input type = "text" 
                class = "update-inputs" 
                name = "item_name"
                id="item_name"
                placeholder = "Enter the item name" 
                required 
                value = "<?php if (isset($_POST['item_name']))  // If it comes from POST
                    {  echo $_POST['item_name']; } else { echo $a_item['name'];} // It comes from GET?>">
            
            <!-- Input box for Item Description -->  
            <label for = "description">Description:</label>
            <textarea 
                class = "update-inputs" 
                name = "item_desc"
                id="item_desc"
                text-align = "center"
                placeholder = "Enter the item description"
                required><?php if (isset($_POST['item_desc']))  // If it comes from POST
                    {  echo $_POST['item_desc']; } else { echo $a_item['desc'];} // It comes from GET?></textarea>
            
            <!-- Input box for Image Path -->
            <label for = "image">Image Path:</label>
            <input type = "text" 
                class = "update-inputs" 
                name = "item_img"
                id="item_img"
                placeholder = "Enter the image path"
                required 
                value = "<?php if (isset($_POST['item_img']))  // If it comes from POST
                    {  echo $_POST['item_img']; } else { echo $a_item['img'];} // It comes from GET?>">
            
            <!-- Input box for Category -->
            <label for = "categor">Category:</label>
            <div>
                <select name="selectcategory" class="form-control update-inputs">
                    <?php
                        if (isset($_POST['selectcategory'])) { // If it comes from POST
                            while ( $row = mysqli_fetch_array( $rC, MYSQLI_ASSOC )){
                                if ($row['category_id'] == $_POST['selectcategory']){
                                    echo '<option name="'.$row['category_id'].'" id="categ" value="'.$row['category_id'].'" selected>'.$row['category_name'].'</option>';
                                } else {
                                    echo '<option name="'.$row['category_id'].'" id="categ" value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
                                }
                            }
                        } else { // It comes from GET
                            while ( $row = mysqli_fetch_array( $rC, MYSQLI_ASSOC )){
                                if ($row['category_id'] == $a_item['cat_num']){
                                    echo '<option name="'.$row['category_id'].'" id="categ" value="'.$row['category_id'].'" selected>'.$row['category_name'].'</option>';
                                } else {
                                    echo '<option name="'.$row['category_id'].'" id="categ" value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
                                }
                            }
                        } ?>
                    </select>
            </div>

            <!-- Input box for Item Price -->
            <label for = "price">Price (&pound):</label>
            <input 
                type = "number" 
                class = "update-inputs" 
                name = "item_price"
                id="item_price"
                min = "0" step = "0.01"
                placeholder = "Enter the item price"
                required 
                value = "<?php if (isset($_POST['item_price']))  // If it comes from POST
                    {  echo $_POST['item_price']; } else { echo $a_item['price'];} // It comes from GET?>"><br>
        </div>
        <div class="update-image-content">
            <div class="update-image-content bg-image">
                <img src="../<?php if (isset($_POST['item_img']))  // If it comes from POST
                    {  echo $_POST['item_img']; } else { echo $a_item['img'];} // It comes from GET?>"/>
                <div class="mask" style="background-color: rgba(0, 0, 0, 0.5)">
                    <div class="text">
                        <p>Update Item</p>
                    </div>
                </div> 
            </div>
            <div class="button-update-container">
                <!-- submit button -->
                <button type = "submit" class="btn btn-dark button-update" style="background-color: #f69610">Update Item</button>
                <!-- Calcel button -->
                <a href="admin.php"><button class="btn btn-dark" type="button">Cancel</button></a>
            </div>
        </div>
    </form>
</div>

<!-- Includes - Footer -->
<?php
    include '../includes/footer.php';
?>