<!-- GET IN TOUCH PHP -->

<!-- Get in Touch Page MKTIME -->
<?php
    /* Includes - Session */
    include ('includes/session.php');

    /* Includes - Navigation Bar */
    include ('includes/nav.php');
        
    # Open database connection.
    require ( 'connections/connect_db.php' );
?>

<!-- Container -->
<div class="contact-container">
    <div class = "contact-left"> 
        <img src="assets/contact.jpg" alt="contact right image">
    </div>
    <form action="https://api.web3forms.com/submit" method="POST" class = "contact-right">
        <div class = "contact-right-title">
            <h2>Get in touch</h2>
            <hr>
        </div>
        
        <input type="hidden" name="access_key" value="8e1a5bbf-8435-4783-99ae-6107084e4fa3">
        <input 
            type="text" 
            name="name" 
            placeholder="Your Name" 
            class = "contact-inputs"
            value = "<?php echo $_SESSION[ 'first_name' ]." ". $_SESSION[ 'last_name' ];?>"
            required>

        <input 
            type="email" 
            name="email" 
            placeholder="Your Email" 
            class = "contact-inputs"
            value = "<?php echo $_SESSION[ 'email' ];?>"
            required>
        <textarea 
        name="message"
        id = "message" 
        placeholder="Your Message" 
        class="contact-inputs" 
        required></textarea>

        <button type="submit">Submit</button>
    </form>
            
 </div>

<!-- Includes - Footer -->
<?php
    include 'includes/footeruser.html';
    include 'includes/footer.php';
?>