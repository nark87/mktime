<?php # CONNECT TO MySQL DATABASE.

# Connect/Link  on 'localhost' .
$link = mysqli_connect('localhost','root','','CodeSpace'); 
    if (!$link) { 
        # Otherwise fail gracefully and explain the error. 
        die('Could not connect to MySQL'); 
    } 

//echo 'Connected to the database successfully!';  

?> 