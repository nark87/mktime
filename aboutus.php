<!-- ABOUT US PHP -->

<!-- About us Page MKTIME -->
<?php
    /* Includes - Session */
    include ('includes/session.php');

    /* Includes - Navigation Bar */
    include ('includes/nav.php');
    
    # Open database connection.
    require ( 'connections/connect_db.php' );

    $welcome= $_SESSION[ 'nickname' ] . " ABOUT US";

    echo '<h2>MKTIME - '.$welcome.'</h2>'
?>

<!-- Includes - Footer -->
<?php
    include 'includes/footer.php';
?>