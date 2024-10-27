<!-- SIGN UP PHP -->

<!-- Includes - HTML head -->
<?php

    include 'includes/head.html';

    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
        # Connect to the database.
        require ('connections/connect_db.php'); 

        # Initialize an error array.
        $errors = array();

        # Check for the first name.
        if ( empty( $_POST[ 'firstName' ] ) ){
            $errors[] = 'Enter your first name.' ;
        }
        else {
            $fn = mysqli_real_escape_string( $link, trim( $_POST[ 'firstName' ] ) ) ;
        }

        # Check for the last name.
        if ( empty( $_POST[ 'lastName' ] ) ){
            $errors[] = 'Enter your last name.' ;
        }
        else {
            $ln = mysqli_real_escape_string( $link, trim( $_POST[ 'lastName' ] ) ) ;
        }

        # Check for the nickname.
        if ( empty( $_POST[ 'nickname' ] ) ){
            $errors[] = 'Enter your nickname.' ;
        }
        else {
            $nk = mysqli_real_escape_string( $link, trim( $_POST[ 'nickname' ] ) ) ;
        }

        # Check for the email.
        if ( empty( $_POST[ 'email' ] ) ){
            $errors[] = 'Enter your email.' ;
        }
        else {
            $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) );
        }

        # Check for a password and matching input passwords.
        if ( !empty($_POST[ 'pass1' ] ) ) {
            if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] ) { 
                $errors[] = 'Passwords do not match. Please, check your password!' ;
            } else { 
                $p = mysqli_real_escape_string( $link, trim( $_POST[ 'pass1' ] ) ); 
            }
        } else { 
            $errors[] = 'Enter your password.'; 
        }

        # Check if email address already registered.
        if ( empty( $errors ) ) {
            $q = "SELECT user_id FROM view_users WHERE email='$e'" ;
            $r = @mysqli_query ( $link, $q ) ;

            if (mysqli_num_rows( $r ) != 0){
                $errors[] = 'Email address already registered!' ;
            }  
        }

        # Create a new user in the db
        if ( empty( $errors ) ) {

            $q = "INSERT INTO view_users (first_name, last_name, nickname, email, role_id, pass, payment_id, reg_date) 
	            VALUES ('$fn', '$ln', '$nk', '$e', 2, '$p', 0, NOW() )";
            
            $r = @mysqli_query ( $link, $q ) ;
            if ($r) { 

                echo '<div data-cy="sign-msg" class="alert alert-success alert-dismissible fade show" role="alert">
                        You are now registered. Please go to <a class="alert-link" href="login.php">Log In</a>
                        <button data-cy="sign-msg-btn" type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button></div>';

                # Close database connection.
                mysqli_close($link); 
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        We could not registered you. Please try again!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button></div>';
                # Close database connection.
                mysqli_close( $link );
            }
        } else {
            echo '<div data-cy="sign-alert" class="alert alert-danger alert-dismissible fade show" role="alert"><h5 data-cy="sign-alert-h5" class="alert-heading" id="err_msg">The following errors occurred:</h5>';
            foreach ( $errors as $msg )
            { echo " - $msg<br>" ; }
            echo 'Please try again or <a class="alert-link" href="login.php">Log In</a>
            <button data-cy="sign-alert-btn" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>';
            
            # Close database connection.
            mysqli_close( $link );
        }  
    }
?>

<!-- Container - Form for Sign Up -->
<div class="signup-section">
    <div class="signup-container">
        <div class="signup-image-content">
            <div class = "signup-title">
                <h2 data-cy="sign-h2">Sign Up</h2>
                <hr>
            </div>
            <img src="assets/signup.png" alt = "sign up image">
        </div>  
        <form action = "signup.php" method = "POST" class = "signup-right">
            
            <label for = "fName">First Name:</label>
            <input data-cy="sign-first" type = "text" name = "firstName" placeholder = "Enter Your First Name" class = "signup-inputs" required
                    value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>">
            <label for = "lName">Last Name:</label>
            <input data-cy="sign-last" type = "text" name = "lastName" placeholder = "Enter Your Last Name" class = "signup-inputs" required
                    value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>">
            <label for = "nick">Nickname:</label>
            <input data-cy="sign-nick" type = "text" name = "nickname" placeholder = "Enter Your Nickname" class = "signup-inputs" required
                    value="<?php if (isset($_POST['nickname'])) echo $_POST['nickname']; ?>">
            <label for = "eml">Email:</label>
            <input data-cy="sign-email" type = "email" name = "email" placeholder = "Enter Your Email" class = "signup-inputs" required
                    value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
            <label for = "pwd1">Password:</label>
            <input data-cy="sign-pass1" type = "password" name = "pass1" placeholder = "Enter Your Password" class = "signup-inputs" required
                    value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
            <label for = "pwd2">Password:</label>
            <input data-cy="sign-pass2" type = "password" name = "pass2" placeholder = "Repeat Your Password" class = "signup-inputs" required
                    value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
            <label>If you have an account, please <a href="login.php">Log In</a></label>
            <button data-cy="sign-btn" type = "submit">Sign Up</button> 
        </form>     
    </div>
</div>

<!-- Includes - Footer -->
<?php
    include 'includes/footeruser.html';
    include 'includes/footer.php';
?>
