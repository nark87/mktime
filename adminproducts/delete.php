<!-- DELETE PHP -->

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
    # Close database connection.
    mysqli_close($link); 
?>

<!-- Container -->
<div class = "admin-form-container">
    <form action = "delete.php" method = "post" class = "admin-form">
        
        <div class = "admin-form-title">
            <h2>Delete Item to the DDBB</h2>
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
            placeholder = "Enter the item name" 
            required
            readonly
            value = "<?php echo $a_item['name'];?>">
        
        <!-- Input box for Item Description -->  
        <label for = "description">Description:</label>
        <textarea 
            class = "admin-form-inputs" 
            name = "item_desc"
            placeholder = "Enter the item description"
            required
            readonly
            value = "<?php echo $a_item['desc'];?>">
        </textarea>
        
        <!-- Input box for Image Path -->
        <label for = "image">Image Path:</label>
        <input type = "text" 
            class = "admin-form-inputs" 
            name = "item_img"
            placeholder = "Enter the image path"
            required
            readonly
            value = "<?php echo $a_item['img'];?>">
        
        <!-- Input box for Item Price -->
        <label for = "price">Price:</label>
        <input 
            type = "number" 
            class = "admin-form-inputs" 
            name = "item_price" 
            min = "0" step = "0.01"
            placeholder = "Enter the item price"
            required
            readonly
            value = "<?php echo $a_item['price'];?>"><br>
        
        <!-- submit button -->
        <button type = "submit" class="btn btn-dark">Delete Item</button>
    </form>
</div> 

<!-- Includes - Footer -->
<?php
 include '../includes/footer.php';
?>

<!-- Delete an Item to the CodeSpace DB -->
<?php
    //echo "hola";
    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
        $i = $_POST['item_id'];

        # Connect to the database.
        require ('../connections/connect_db.php'); 

        $sql = "DELETE FROM products WHERE item_id='$i'";

        $r = @mysqli_query ( $link, $sql ) ;
            if ($r) {
                header("Location: ../adminproducts/admin.php");
            } 
            else {
                echo "Error deleting record: " . $link->error;
            }

        # Close database connection.
        mysqli_close($link); 

        exit();
    }
?>