<!-- SIGN UP PHP -->

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
<div class = "signup-container">
    <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST" class = "signup">
        <div class = "signup-title">
            <h2>Sign Up</h2>
            <hr>
        </div>
        <input type = "text" name = "username" placeholder = "Enter Your Username" class = "signup-inputs" required>
        <input type = "email" name = "email" placeholder = "Enter Your Email" class = "signup-inputs" required>
        <input type = "password" name = "pwd" placeholder = "Enter Your Password" class = "signup-inputs" required>
        <input type = "password" name = "pwd1" placeholder = "Repeat Your Password" class = "signup-inputs" required>
        <button type = "submit">Sign Up</button>
    </form>
</div>

<!-- Includes - Footer -->
<?php
    include 'includes/footer.php';
?>