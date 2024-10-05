<!-- PROFILE PHP -->

<?php
    # Open database connection.
    require ( 'connections/connect_db.php' );

    # Get User Email from Log In
    if (isset($_GET['user_email'])) {
        
        $user_email = $_GET['user_email'];

        /* Includes - User Navigation Bar */
        include 'includes/usernav.php';

        $welcome = "PROFILE " . $user_email;

       /* $sql_item = "SELECT * FROM products WHERE item_id='$id'";
        $result_item = mysqli_query($link,$sql_item);
        $row_item = mysqli_fetch_array($result_item, MYSQLI_ASSOC);
        $id_item = $row_item['item_id'];
        $a_item = array("id" => $row_item['item_id'],
                        "name" => $row_item['item_name'],
                        "desc" => $row_item['item_desc'],
                        "img" => $row_item['item_img'],
                        "price" => $row_item['item_price']);*/
    } else {
        /* Includes - Navigation Bar */
        include 'includes/nav.php';

        $welcome= "PROFILE";
    }

    echo '<h2>MKTIME - '.$welcome.'</h2>'
?>

<!-- Includes - Footer -->
<?php
    include 'includes/footer.php';
?>