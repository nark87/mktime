<!-- UPDATE PHP -->

<!-- ADMIN - Update Items Page MKTIME -->

<!-- Includes - Navigation Bar -->
<?php
        
    /* Includes - Session */
    include ('../includes/session.php');

    /* Includes - Navigation Bar */
    include ('../includes/adminnav.php');
    
    # Open database connection.
    require ( '../connections/connect_db.php' );
    
    if (isset($_GET['item_id'])) {
        $id = $_GET['item_id'];

        $sql_item = "SELECT * FROM view_items WHERE item_id='$id'";
        $result_item = mysqli_query($link,$sql_item);
        $row_item = mysqli_fetch_array($result_item, MYSQLI_ASSOC);
        $id_item = $row_item['item_id'];
        $a_item = array("id" => $row_item['item_id'],
                        "name" => $row_item['item_name'],
                        "desc" => $row_item['item_desc'],
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
    
        # Check for a item price.
        if (empty( $_POST[ 'item_price' ] ) ) {
            $errors[] = 'Update item price.' ;
        }
        else {
            $p = mysqli_real_escape_string( $link, trim( $_POST[ 'item_price' ] ) ) ;
        }

        # On success data into my_table on database.
        if ( empty( $errors ) ) {
            $q = "UPDATE view_items SET item_id='$id', item_name='$n', item_desc='$d', item_img='$img', item_price='$p'  WHERE item_id='$id'";
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
<div class = "update-form-container">
    <form action = "update.php" method = "post" class = "update-form">
        
        <div class = "update-form-title">
            <h2>Update Item</h2>
            <hr>
        </div>
        
        <!-- Item ID  -->
        <label for = "id">Item ID:</label>
        <input type = "text" 
            class = "update-form-inputs" 
            name = "item_id"
            id="item_id"
            placeholder = "Enter the item id" 
            required
            readonly
            value = "<?php if (isset($_POST['item_id']))
            {  echo $_POST['item_id']; } else { echo $a_item['id'];}?>">
    
        <!-- Input box for Item name  -->
        <label for = "name">Name:</label>
        <input type = "text" 
            class = "update-form-inputs" 
            name = "item_name"
            id="item_name"
            placeholder = "Enter the item name" 
            required 
            value = "<?php if (isset($_POST['item_name']))
            {  echo $_POST['item_name']; } else { echo $a_item['name'];}?>">
        
        <!-- Input box for Item Description -->  
        <label for = "description">Description:</label>
        <textarea 
            class = "update-form-inputs" 
            name = "item_desc"
            id="item_desc"
            text-align = "center"
            placeholder = "Enter the item description"
            required><?php if (isset($_POST['item_desc']))
            {  echo $_POST['item_desc']; } else { echo $a_item['desc'];}?></textarea>
        
        <!-- Input box for Image Path -->
        <label for = "image">Image Path:</label>
        <input type = "text" 
            class = "update-form-inputs" 
            name = "item_img"
            id="item_img"
            placeholder = "Enter the image path"
            required 
            value = "<?php if (isset($_POST['item_img']))
            {  echo $_POST['item_img']; } else { echo $a_item['img'];}?>">
        
        <!-- Input box for Item Price -->
        <label for = "price">Price:</label>
        <input 
            type = "number" 
            class = "update-form-inputs" 
            name = "item_price"
            id="item_price"
            min = "0" step = "0.01"
            placeholder = "Enter the item price"
            required 
            value = "<?php if (isset($_POST['item_price']))
            {  echo $_POST['item_price']; } else { echo $a_item['price'];}?>"><br>
        
        <div class="button-update-container">
            <!-- submit button -->
            <button type = "submit" class="btn btn-dark button-update" style="background-color: #f69610">Update Item</button>
            <!-- Calcel button -->
            <a href="admin.php"><button class="btn btn-dark" type="button">Cancel</button></a>
        </div>
    </form>
    <div class=" update-right bg-image">
        <img src="../<?php if (isset($_POST['item_img']))
            {  echo $_POST['item_img']; } else { echo $a_item['img'];}?>" style="width:300px" alt = "update item image"/>
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.5)">
            <div class="text">
            <p>Update Item</p>
        </div>
    </div>
</div> 

<!-- Includes - Footer -->
<?php
    include '../includes/footer.php';
?>