
<?php # PROCESS LOGIN ATTEMPT

# Check form submitted
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

  // Open database connection
  require ( 'connections/connect_db.php' );

  // Get connection, load and validate functions
  require ( 'login_tools.php' );

  // Check login
  list ( $check, $data ) = validate ( $link, $_POST[ 'email' ], $_POST[ 'pass' ] ) ;

  // On success set session data and display logged in page
  if ( $check ) {
    session_start(); // Access session
    $_SESSION[ 'user_id' ] = $data[ 'user_id' ] ;
    $_SESSION[ 'first_name' ] = $data[ 'first_name' ] ;
    $_SESSION[ 'last_name' ] = $data[ 'last_name' ] ;
    $_SESSION[ 'nickname' ] = $data[ 'nickname' ] ;
    $_SESSION[ 'email' ] = $data[ 'email' ] ;
    $_SESSION[ 'role_id' ] = $data[ 'role_id' ] ;

    if ($_SESSION[ 'role_id' ] == 1) { // Role_id equal 1 is a admin role
      load ( 'adminproducts/admin.php' ) ;
    } else {
      load ( 'home.php' ) ;
    }

  } else { // Or on failure set errors
    $errors = $data; 
  }

  // Close database connection
  mysqli_close( $link );
}

// Continue to display login page on failure
include ( 'login.php' ) ;
?>