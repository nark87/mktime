<!-- LOGIN PHP -->

<!-- Includes - HTML head -->
<?php
    include 'includes/head.html';

    # Display any error messages if present.
    if ( isset( $errors ) && !empty( $errors ) )
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><h5 class="alert-heading" id="err_msg">Oops! There was a problem:</h5>';
        foreach ( $errors as $msg ){ echo " - $msg<br>" ; }
        echo 'Please try again or <a class="alert-link" href="signup.php">Sign Up</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button></div>';
    }
?>

<!-- Container for Log In-->
<div class = "login-container">
    <form action = "login_action.php" method = "POST" class = "login-left">
        <div class = "login-left-title">
            <h2>Log In</h2>
            <hr>
        </div>
        <input type = "email" name = "email" placeholder = "Enter Your Email" class = "login-inputs" required>
        <input type = "password" name = "pass" placeholder = "Your Password" class = "login-inputs" required>
        <label>If you don't have an account, please <a href="signup.php">Sign Up</a></label>
        <button type = "submit">Log In</button>
    </form>
    <div class = "login-right"> 
        <img src = "assets/login.jpg" alt = "login right image">
    </div>  
</div>

<!-- Includes - Footer -->
<?php
    include 'includes/footeruser.html';
    include 'includes/footer.php';
?>