<!-- This function likely redirects the admin to the login page to authenticate themselves -->
<?php
# Access session.
session_start() ;
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( '../login_tools.php' ) ; loadadm() ; }
?>