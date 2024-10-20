<!-- ABOUT US PHP -->

<!-- About us Page MKTIME -->
<?php
    /* Includes - Session */
    include ('includes/session.php');

    /* Includes - Navigation Bar */
    include ('includes/nav.php');
    
    # Open database connection.
    require ( 'connections/connect_db.php' );
?>

<!-- Container -->
<div class="about-section">
    <div class="about-container">
        <div class="about-right">
            <div class="about-right-title">
                <h2> About Us</h2>
                <hr>
            </div>
            <div class="content">
                <h3>MKTIME, Where Every Second Counts in Style!</h3>
                <p>We are passionate about timepieces and the stories they tell. 
                    As a premier online destination for luxury and designer watches, we curate 
                    a diverse collection that caters to every taste, from timeless classics to 
                    modern innovations. Our mission is to bring you authentic, high-quality 
                    watches from renowned global brands, ensuring that each piece reflects 
                    precision, craftsmanship, and style. Whether you're a seasoned collector 
                    or discovering the art of horology for the first time, mktime is dedicated 
                    to providing a seamless shopping experience with expert support, secure 
                    transactions, and a commitment to customer satisfaction. Let us help you 
                    find the perfect watch to mark your moments.</p>
                <a href=""><button class="btn btn-dark" type="button">Read More</button></a>
            </div>  
        </div>  
        <div class="image-content">
            <img src="assets/aboutus.png">
        </div>         
    </div>
</div>


<!-- Includes - Footer -->
<?php
    include 'includes/footeruser.html';
    include 'includes/footer.php';
?>