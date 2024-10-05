<!-- LOGIN PHP -->

<!-- Includes - Navigation Bar -->
<?php
    include 'includes/nav.php';
?>

<!-- Connections - CodeSpace DB -->
<?php
    # Open database connection.
	require ( 'connections/connect_db.php' );
?>

<!-- Container -->
<div class = "login-container">
    <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST" class = "login-left">
        <div class = "login-left-title">
            <h2>Log In</h2>
            <hr>
        </div>
        <input type = "email" name = "email" placeholder = "Enter Your Email" class = "signup-inputs" required>
        <input type = "password" name = "pwd" placeholder = "Your Password" class = "login-inputs" required>
        <button type = "submit">Log In</button>
    </form>
    <div class = "login-right"> 
        <img src = "assets/contact_right_img.png" alt = "login right image">
    </div>  
</div>

<!-- Includes - Footer -->
<?php
    include 'includes/footer.php';
?>

<!-- LOG IN to the CodeSpace DB -->
<?php
    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
        # Connect to the database.
        require ('connections/connect_db.php'); 

        # Initialize an error array.
        $errors = array();

        # Check for email.
        if ( empty( $_POST[ 'email' ] ) ){
            $errors[] = 'Enter your email.' ;
        }
        else {
            $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ;
        }

        # Check for password.
        if (empty( $_POST[ 'pwd' ] ) ) {
            $errors[] = 'Enter your password.' ;
        }
        else {
            $p = mysqli_real_escape_string( $link, trim( $_POST[ 'pwd' ] ) ) ;
        }

        # Check if the user email exist in the DB
        if ( empty( $errors ) ) {
            $q = "SELECT users.email AS email, users.pass AS password, users_rol.rol_name AS rol 
                FROM users, users_rol WHERE users.email = '$e' AND users.rol_id = users_rol.rol_id;";
            $r = @mysqli_query ( $link, $q );
            
            if ($r) {

                $user = mysqli_fetch_array( $r, MYSQLI_ASSOC );

                if ($user['password'] == $p) {
                    echo "<script>window.location.href='index.php?user_email=".$user['email']."'</script>";
                    exit;
                }
                else {
                    echo "<script>alert('Email or password is not correct!')</script>";
                }
            }
    
            # Close database connection.
            mysqli_close($link); 
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