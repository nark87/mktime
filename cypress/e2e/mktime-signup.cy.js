describe('Test 2 - Sign In MKTIME', () => {

  beforeEach(() => {
    cy.visit('http://localhost/mktime/login.php');

    // Check if exist elements on LOG IN PAGE
    cy.get('[data-cy="log-h2"]').should('exist').as('h2'); // Title
    cy.get('[data-cy="log-img"]').should('exist'); // Image
    cy.get('[data-cy="log-sign"]').should('exist').as('logSign'); // Sign In Button

    // Check if exist the footer
    cy.get('[data-cy="foot"]').should('exist');
    cy.get('[data-cy="fot-h5"]').should('exist').as('footTitle'); // Footer Title
  });


  it('Correct - Sign Up', () => {
    
    // Check if we are in Log In Page
    cy.get('@h2').should('contain', 'Log In');

    // Check Footer
    cy.get('@footTitle').should('contain', 'MKTIME');

    // Click Log In Button and go to user session
    cy.get("@logSign").click();

    // Check url if user is on Sign Up page
    cy.url().should('include', '/signup'); // => true
    cy.url().should('eq', 'http://localhost/mktime/signup.php');// => true

    // Check if we are in Sign Up Page
    cy.get('[data-cy="sign-h2"]').should('exist').as('h2Sign'); // Title
    cy.get('@h2Sign').should('contain', 'Sign Up');

    // Check if exist the footer
    cy.get('[data-cy="foot"]').should('exist');

    // Check all inputs for Sign Up
    cy.get('[data-cy="sign-first"]').should('exist').as('first'); // First Name
    cy.get('[data-cy="sign-last"]').should('exist').as('last'); // Last Name
    cy.get('[data-cy="sign-nick"]').should('exist').as('nick'); // Nickname
    cy.get('[data-cy="sign-email"]').should('exist').as('email'); // Email
    cy.get('[data-cy="sign-pass1"]').should('exist').as('pass1'); // Password 1
    cy.get('[data-cy="sign-pass2"]').should('exist').as('pass2'); // Password 2
    cy.get('[data-cy="sign-btn"]').should('exist').as('signBtn'); // Sign Up Button

    // Type all inputs and check value
    const firstName = "Marlene";
    cy.get('@first').type(firstName);
    cy.get('@first').should('have.value', firstName);
    const lastName = "Sight";
    cy.get('@last').type(lastName);
    cy.get('@last').should('have.value', lastName);
    const nickname = "Marle";
    cy.get('@nick').type(nickname);
    cy.get('@nick').should('have.value', nickname);
    const emailAddress = "marlene@gmail.com";
    cy.get('@email').type(emailAddress);
    cy.get('@email').should('have.value', emailAddress);
    const password1 = "vodka";
    cy.get('@pass1').type(password1);
    cy.get('@pass1').should('have.value', password1);
    const password2 = "vodka";
    cy.get('@pass2').type(password2);
    cy.get('@pass2').should('have.value', password2);

    // Click Sign In Button to register user
    cy.get("@signBtn").click();

    // Check alert message with successful registration
    cy.get('[data-cy="sign-msg"]').should('exist').as('msgDiv'); // Div with the errors
    cy.get('[data-cy="sign-msg-btn"]').should('exist').as('msgBtn'); // Button Close inside alert
    cy.get('@msgDiv').should('contain', 'You are now registered');
    cy.get("@msgBtn").click();

  });

  it('Passwords do not match - Sign Up', () => {
    
    // Check if we are in Log In Page
    cy.get('@h2').should('contain', 'Log In');

    // Check Footer
    cy.get('@footTitle').should('contain', 'MKTIME');
    
    // Click Log In Button and go to user session
    cy.get("@logSign").click();
    
    // Check url if user is on home page
    cy.url().should('include', '/signup'); // => true
    cy.url().should('eq', 'http://localhost/mktime/signup.php');// => true
    
    // Check if we are in Sign Up Page
    cy.get('[data-cy="sign-h2"]').should('exist').as('h2Sign'); // Title
    cy.get('@h2Sign').should('contain', 'Sign Up');

    // Check if exist the footer
    cy.get('[data-cy="foot"]').should('exist');

    // Check all inputs for Sign Up
    cy.get('[data-cy="sign-first"]').should('exist').as('first'); // First Name
    cy.get('[data-cy="sign-last"]').should('exist').as('last'); // Last Name
    cy.get('[data-cy="sign-nick"]').should('exist').as('nick'); // Nickname
    cy.get('[data-cy="sign-email"]').should('exist').as('email'); // Email
    cy.get('[data-cy="sign-pass1"]').should('exist').as('pass1'); // Password 1
    cy.get('[data-cy="sign-pass2"]').should('exist').as('pass2'); // Password 2
    cy.get('[data-cy="sign-btn"]').should('exist').as('signBtn'); // Sign Up Button

    // Type all inputs and check value
    const firstName = "Liz";
    cy.get('@first').type(firstName);
    cy.get('@first').should('have.value', firstName);
    const lastName = "Bridge";
    cy.get('@last').type(lastName);
    cy.get('@last').should('have.value', lastName);
    const nickname = "Lizzy";
    cy.get('@nick').type(nickname);
    cy.get('@nick').should('have.value', nickname);
    const emailAddress = "lizzy@gmail.com";
    cy.get('@email').type(emailAddress);
    cy.get('@email').should('have.value', emailAddress);
    const password1 = "apple";
    cy.get('@pass1').type(password1);
    cy.get('@pass1').should('have.value', password1);
    const password2 = "apples";
    cy.get('@pass2').type(password2);
    cy.get('@pass2').should('have.value', password2);

    // Click Sign In Button to register user
    cy.get("@signBtn").click();

    // Check alert message with errors in registration
    cy.get('[data-cy="sign-alert"]').should('exist').as('errorDiv'); // Div with the errors
    cy.get('[data-cy="sign-alert-btn"]').should('exist').as('alertBtn'); // Button Close inside alert
    cy.get('@errorDiv').should('contain', 'Passwords do not match');
    cy.get("@alertBtn").click();

  });

  it('Email already exists - Sign Up', () => {
    
    // Check if we are in Log In Page
    cy.get('@h2').should('contain', 'Log In');

    // Check Footer
    cy.get('@footTitle').should('contain', 'MKTIME');

    // Click Log In Button and go to user session
    cy.get("@logSign").click();

    // Check url if user is on home page
    cy.url().should('include', '/signup'); // => true
    cy.url().should('eq', 'http://localhost/mktime/signup.php');// => true

    // Check if we are in Sign Up Page
    cy.get('[data-cy="sign-h2"]').should('exist').as('h2Sign'); // Title
    cy.get('@h2Sign').should('contain', 'Sign Up');

    // Check if exist the footer
    cy.get('[data-cy="foot"]').should('exist');

    // Check all inputs for Sign Up
    cy.get('[data-cy="sign-first"]').should('exist').as('first'); // First Name
    cy.get('[data-cy="sign-last"]').should('exist').as('last'); // Last Name
    cy.get('[data-cy="sign-nick"]').should('exist').as('nick'); // Nickname
    cy.get('[data-cy="sign-email"]').should('exist').as('email'); // Email
    cy.get('[data-cy="sign-pass1"]').should('exist').as('pass1'); // Password 1
    cy.get('[data-cy="sign-pass2"]').should('exist').as('pass2'); // Password 2
    cy.get('[data-cy="sign-btn"]').should('exist').as('signBtn'); // Sign Up Button

    // Type all inputs and check value
    const firstName = "George";
    cy.get('@first').type(firstName);
    cy.get('@first').should('have.value', firstName);
    const lastName = "Conor";
    cy.get('@last').type(lastName);
    cy.get('@last').should('have.value', lastName);
    const nickname = "Georgie";
    cy.get('@nick').type(nickname);
    cy.get('@nick').should('have.value', nickname);
    const emailAddress = "george@gmail.com";
    cy.get('@email').type(emailAddress);
    cy.get('@email').should('have.value', emailAddress);
    const password1 = "tequila";
    cy.get('@pass1').type(password1);
    cy.get('@pass1').should('have.value', password1);
    const password2 = "tequila";
    cy.get('@pass2').type(password2);
    cy.get('@pass2').should('have.value', password2);

    

    // Click Sign In Button to register user
    cy.get("@signBtn").click();

    // Check alert message with errors in registration
    cy.get('[data-cy="sign-alert"]').should('exist').as('errorDiv'); // Div with the errors
    cy.get('[data-cy="sign-alert-btn"]').should('exist').as('alertBtn'); // Button Close inside alert
    cy.get('@errorDiv').should('contain', 'Email address already registered!');
    cy.get("@alertBtn").click();

});
})