<!-- UPDATE PHP -->

<!-- Includes - Navigation Bar -->
<?php
    ob_start();
    include '../includes/adminnav.php';
?>

<!-- Get Item Information from th CodeSpace DB -->
<?php
    # Connect to the database.
    require ('../connections/connect_db.php');
    
    if (isset($_GET['item_id'])) {
        $id = $_GET['item_id'];

        $sql_item = "SELECT * FROM products WHERE item_id='$id'";
        $result_item = mysqli_query($link,$sql_item);
        $row_item = mysqli_fetch_array($result_item, MYSQLI_ASSOC);
        $id_item = $row_item['item_id'];
        $a_item = array("id" => $row_item['item_id'],
                        "name" => $row_item['item_name'],
                        "desc" => $row_item['item_desc'],
                        "img" => $row_item['item_img'],
                        "price" => $row_item['item_price']);
    }
?>

<!-- Container -->
<div class = "admin-form-container">
    <form action = "update.php" method = "post" class = "admin-form">
        
        <div class = "admin-form-title">
            <h2>Update Item to the DDBB</h2>
            <hr>
        </div>
        
        <!-- Item ID  -->
        <label for = "id">Item ID:</label>
        <input type = "text" 
            class = "admin-form-inputs" 
            name = "item_id"
            id="item_id"
            placeholder = "Enter the item id" 
            required
            readonly
            value = "<?php echo $a_item['id'];?>">
    
        <!-- Input box for Item name  -->
        <label for = "name">Name:</label>
        <input type = "text" 
            class = "admin-form-inputs" 
            name = "item_name"
            id="item_name"
            placeholder = "Enter the item name" 
            required 
            value = "<?php echo $a_item['name'];?>">
        
        <!-- Input box for Item Description -->  
        <label for = "description">Description:</label>
        <textarea 
            class = "admin-form-inputs" 
            name = "item_desc"
            id="item_desc"
            placeholder = "Enter the item description"
            required
            value = "<?php echo $a_item['desc'];?>">
        </textarea>
        
        <!-- Input box for Image Path -->
        <label for = "image">Image Path:</label>
        <input type = "text" 
            class = "admin-form-inputs" 
            name = "item_img"
            id="item_img"
            placeholder = "Enter the image path"
            required 
            value = "<?php echo $a_item['img'];?>">
        
        <!-- Input box for Item Price -->
        <label for = "price">Price:</label>
        <input 
            type = "number" 
            class = "admin-form-inputs" 
            name = "item_price"
            id="item_price"
            min = "0" step = "0.01"
            placeholder = "Enter the item price"
            required 
            value = "<?php echo $a_item['price'];?>"><br>
        
        <!-- submit button -->
        <button type = "submit" class="btn btn-dark">Update Item</button>
    </form>
</div> 

<!-- Includes - Footer -->
<?php
    include '../includes/footer.php';
?>

<!-- Update an Item to the CodeSpace DB -->
<?php
    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
        # Connect to the database.
        require ('../connections/connect_db.php'); 

        # Initialize an error array.
        $errors = array();

        echo $_POST['item_id'];
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
            echo $q;
            $q = "UPDATE products SET item_id='$id', item_name='$n', item_desc='$d', item_img='$img', item_price='$p'  WHERE item_id='$id'";
            $r = @mysqli_query ( $link, $q ) ;
 
            if ($r) {
                header("Location: ../adminproducts/admin.php");
            } 
            else {
                echo "Error updating record: " . $link->error;
            }
    
            # Close database connection.
            mysqli_close($link); 
            exit();
        }
        else # Or report errors.
        {
            echo '<p>The following error(s) occurred:</p>' ;
            foreach ( $errors as $msg )
            { echo "$msg<br>" ; }
            echo '<p>Please try again.</p></div>';
            
            # Close database connection.
            mysqli_close( $link );   
        }  
    }
?>