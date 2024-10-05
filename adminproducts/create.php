<!-- CREATE PHP -->

<!-- Includes - Navigation Bar -->
<?php
 include '../includes/adminnav.php';
?>

<!-- Container -->
<div class = "admin-form-container">
    <form id = "create-form" action = "create.php" method = "post" class = "admin-form">
        
        <div class = "admin-form-title">
            <h2>Add Item to the DDBB</h2>
            <hr>
        </div>    
    
        <!-- Input box for Item name  -->
        <label for = "name">Name:</label>
        <input type = "text" 
            class = "admin-form-inputs" 
            name = "item_name"
            placeholder = "Enter the item name" 
            required 
            value = "">
        
        <!-- Input box for Item Description -->  
        <label for = "description">Description:</label>
        <textarea 
            class = "admin-form-inputs" 
            name = "item_desc"
            placeholder = "Enter the item description"
            required 
            value ="">
        </textarea>
        
        <!-- Input box for Image Path -->
        <label for = "image">Image Path:</label>
        <input type = "text" 
            class = "admin-form-inputs" 
            name = "item_img"
            placeholder = "Enter the image path"
            required 
            value = "">
        
        <!-- Input box for Item Price -->
        <label for = "price">Price:</label>
        <input 
            type = "number" 
            class = "admin-form-inputs" 
            name = "item_price" 
            min = "0" step = "0.01"
            placeholder = "Enter the item price"
            required 
            value = ""><br>
        
        <!-- submit button -->
        <button type = "submit" class="btn btn-dark">Create Item</button>
    </form>
</div> 

<!-- Includes - Footer -->
<?php
 include '../includes/footer.php';
?>

<!-- Create an Item to the CodeSpace DB -->
<?php
    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
        # Connect to the database.
        require ('../connections/connect_db.php'); 

        # Initialize an error array.
        $errors = array();

        # Check for item name .
        if ( empty( $_POST[ 'item_name' ] ) ){
            $errors[] = 'Enter the item name.' ;
        }
        else {
            $n = mysqli_real_escape_string( $link, trim( $_POST[ 'item_name' ] ) ) ;
        }

        # Check for a item decription.
        if (empty( $_POST[ 'item_desc' ] ) ) {
            $errors[] = 'Enter the item decription.' ;
        }
        else {
            $d = mysqli_real_escape_string( $link, trim( $_POST[ 'item_desc' ] ) ) ;
        }
    
        # Check for a item image.
        if (empty( $_POST[ 'item_img' ] ) ) {
            $errors[] = 'Enter the item image path.' ;
        } 
        else {
            $img = mysqli_real_escape_string( $link, trim( $_POST[ 'item_img' ] ) ) ;
        }
    
        # Check for a item price.
        if (empty( $_POST[ 'item_price' ] ) ) {
            $errors[] = 'Enter the item price.' ;
        }
        else {
            $p = mysqli_real_escape_string( $link, trim( $_POST[ 'item_price' ] ) ) ;
        }

        # On success data into my_table on database.
        if ( empty( $errors ) ) {
            $q = "INSERT INTO products (item_name, item_desc, item_img, item_price) 
            VALUES ('$n','$d', '$img', '$p' )";
            $r = @mysqli_query ( $link, $q ) ;
            
            if ($r) {
                echo '<p>New record created successfully</p>';
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

