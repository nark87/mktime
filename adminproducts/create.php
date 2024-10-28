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

    # Retrieve item categories from 'view_category_item' database table.
    $qC = "SELECT * FROM view_category_item";
    $rC = mysqli_query( $link, $qC );

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

        # Check for a file image.
        # Uploaded img and save in img folder
        $target_dir = "/var/www/app/mktime/img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        echo $check;

        if($check !== false) {
            $uploadOk = 1;
        } else {
            $errors[] = "File is not an image.";
            $uploadOk = 0;
        }

        # Check if file already exists
        if (file_exists($target_file)) {
            $errors[] = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
            echo "Sorry, there was an error uploading your file.";
            }
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
            $errors[] = 'Enter the item price.' ;
        }
        else {
            $p = mysqli_real_escape_string( $link, trim( $_POST[ 'item_price' ] ) ) ;
        }

        # On success data into my_table on database.
        if ( empty( $errors ) ) {
            $q = "INSERT INTO view_items (item_name, item_desc, item_img, item_price, category_id) 
            VALUES ('$n','$d', '$img', '$p', '$c' )";

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
        <form action = "create.php" method = "post" class = "create-left" enctype="multipart/form-data"> 
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

            <!-- Input box for File Image -->
            <label for="formFile" class="form-label">Add Image Product:</label>
            <input 
                class="form-control create-inputs" 
                type="file" 
                name="fileToUpload" 
                id="fileToUpload"
                required>

            <!-- Input box for Category -->
            <label for = "categor">Category:</label>
            <div>
                <select name="selectcategory" class="form-control create-inputs">
                    <option >Select a category</option><?php
                        while ( $row = mysqli_fetch_array( $rC, MYSQLI_ASSOC )){
                            echo '<option name="'.$row['category_id'].'" id="categ" value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
                        } ?>
                    </select>
            </div>

            <!-- Input box for Item Price -->
            <label for = "price">Price (&pound):</label>
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



