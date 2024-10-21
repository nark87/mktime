<!-- CREATE PHP -->

<!-- ADMIN - Create Items Page MKTIME -->

<!-- Includes - Navigation Bar -->
<?php
    /* Includes - Session */
    include ('../includes/sessionadm.php');

    /* Includes - Navigation Bar */
    include ('../includes/adminnav.php');

    # Open database connection.
    require ( '../connections/connect_db.php' );

    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

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
            $q = "INSERT INTO view_items (item_name, item_desc, item_img, item_price) 
            VALUES ('$n','$d', '$img', '$p' )";
            $r = @mysqli_query ( $link, $q ) ;
            
            if ($r) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading" id="err_msg">New record created successfully</h5>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>';
            }
    
            # Close database connection.
            mysqli_close($link); 
        }
        else # Or report errors.
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5 class="alert-heading" id="err_msg">The following errors occurred:</h5>';
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
<div class="create-section">
    <div class="create-container">
        <form action = "create.php" method = "post" class = "create-left"> 
            <div class = "create-left-title">
                <h2>Create Item</h2>
                <hr>
            </div>
            <!-- Input box for Item name  -->
            <label for = "name">Name:</label>
            <input type = "text" 
                class = "create-inputs" 
                name = "item_name"
                placeholder = "Enter the item name" 
                required 
                value = "">
            
            <!-- Input box for Item Description -->  
            <label for = "description">Description:</label>
            <textarea 
                class = "create-inputs" 
                name = "item_desc"
                placeholder = "Enter the item description"
                resize = "none"
                required 
                value =""></textarea>
            
            <!-- Input box for Image Path -->
            <label for = "image">Image Path:</label>
            <input type = "text" 
                class = "create-inputs" 
                name = "item_img"
                placeholder = "Enter the image path"
                required 
                value = "">
            
            <!-- Input box for Item Price -->
            <label for = "price">Price:</label>
            <input 
                type = "number" 
                class = "create-inputs" 
                name = "item_price" 
                min = "0" step = "0.01"
                placeholder = "Enter the item price"
                required 
                value = ""><br>

            <div class="button-create-container">
                <!-- submit button -->
                <button type = "submit" class="btn btn-dark button-create" style="background-color: #074d0f">Create Item</button>
                <!-- Calcel button -->
                <a href="admin.php"><button class="btn btn-dark" type="button">Cancel</button></a>
            </div>
        </form>      
    </div>
</div>

<!-- Includes - Footer -->
<?php
 include '../includes/footer.php';
?>



