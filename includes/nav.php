<!DOCTYPE html>
<html lang="en">
  <head>
     <!-- Title -->
     <title>MKTIME - Dynamic eCommerce Website</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Narcis Girones Sancho" />
    <meta name="description" content="MKTIME - Dynamic eCommerce Website" />
    <meta name="keywords" content="mktime, dynamic, ecommerce" />

    <!-- Bootstrap CSS, Icons -->
    <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
        crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" 
        integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" 
        crossorigin="anonymous">

    <!-- Font Awesome CSS, Icons -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/read.css" />
    <link rel="stylesheet" type="text/css" href="../css/create.css" />
    <link rel="stylesheet" type="text/css" href="../css/update.css" />
    <link rel="stylesheet" type="text/css" href="../css/delete.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css" />
    <link rel="stylesheet" type="text/css" href="css/signup.css" />
    <link rel="stylesheet" type="text/css" href="css/contact.css" />
    <link rel="stylesheet" type="text/css" href="css/aboutus.css" />

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand">
            <img src="assets/user_icon.png" width="30" height="30" class="d-inline-block align-top" alt=""><?php echo ' '. $_SESSION[ 'nickname' ]?></a>
        <button class="navbar-toggler" type="button" 
            data-toggle="collapse" 
            data-target="#navbarNav" 
            aria-controls="navbarNav" 
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item"> <!-- class="nav-item active" -->
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="checkout.php">Check Out</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutus.php">About us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="getintouch.php">Get in touch</a>
            </li>
            </ul>
        </div>
        <div>
            <button class="btn btn-outline-primary" type="submit" onclick="location.href = 'logout.php';">Log Out</button>
        </div>  
    </nav> 