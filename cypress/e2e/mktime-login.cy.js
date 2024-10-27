describe('Test 1 - Log In MKTIME', () => {

  beforeEach(() => {
    cy.visit('http://localhost/mktime/login.php');

    // Check if exist elements on LOG IN PAGE
    cy.get('[data-cy="log-h2"]').should('exist').as('h2'); // Title
    cy.get('[data-cy="log-img"]').should('exist'); // Image
    cy.get('[data-cy="log-email"]').should('exist').as('email'); // Email Input
    cy.get('[data-cy="log-pass"]').should('exist').as('pass'); // Password Input
    cy.get('[data-cy="log-btn"]').should('exist').as('logBtn'); // Log In Button
    cy.get('[data-cy="log-sign"]').should('exist').as('logSign'); // Sign In Button

    // Check if exist the footer
    cy.get('[data-cy="foot"]').should('exist');
    cy.get('[data-cy="fot-h5"]').should('exist').as('footTitle'); // Footer Title
  });


  it('Correct Password - Log In', () => {
    
    // Check if we are in Log In Page
    cy.get('@h2').should('contain', 'Log In');

    // Check Footer
    cy.get('@footTitle').should('contain', 'MKTIME');

    // Type email and check it
    const emailAddress = "narcis87@gmail.com";
    cy.get('@email').type(emailAddress);
    cy.get('@email').should('have.value', emailAddress);

    // Type email and check it
    const password = "Peras";
    cy.get('@pass').type(password);
    cy.get('@pass').should('have.value', password);

    // Click Log In Button and go to user session
    cy.get("@logBtn").click();

    // Check url if user is on home page
    cy.url().should('include', '/home'); // => true
    cy.url().should('eq', 'http://localhost/mktime/home.php');// => true

    // Check nickname in navbar on home page
    const nickname = "Narko";
    cy.get('[data-cy="home-nick"]').should('exist').as('homeNick');
    cy.get('@homeNick').should('contain', nickname);

    // Check if exist the footer
    cy.get('[data-cy="foot"]').should('exist');
    cy.get('[data-cy="fot-h5"]').should('exist').as('footTitle'); // Footer Title
    cy.get('@footTitle').should('contain', 'MKTIME');

    // Check Log Out button and click it
    cy.get('[data-cy="home-logout"]').should('exist').as('logOut');
    cy.get('@logOut').should('contain', 'Log Out');
    cy.get("@logOut").click();
    
    // Check url if user is on Log In page
    cy.url().should('include', '/login'); // => true
    cy.url().should('eq', 'http://localhost/mktime/login.php');// => true

    cy.get('[data-cy="log-h2"]').should('exist').as('h2Login'); 
    cy.get('@h2Login').should('contain', 'Log In');

    // Check if exist the footer
    cy.get('[data-cy="foot"]').should('exist');
    cy.get('[data-cy="fot-h5"]').should('exist').as('footTitle'); // Footer Title
    cy.get('@footTitle').should('contain', 'MKTIME');
    
  });

  it('Incorrect Password - Log In', () => {
    
    // Check if we are in Log In Page
    cy.get('@h2').should('contain', 'Log In');

    // Check Footer
    cy.get('@footTitle').should('contain', 'MKTIME');

    // Type email and check it
    const emailAddress = "narcis87@gmail.com";
    cy.get('@email').type(emailAddress);
    cy.get('@email').should('have.value', emailAddress);

    // Type email and check it
    const password = "Pera";
    cy.get('@pass').type(password);
    cy.get('@pass').should('have.value', password);

    // Click Log In Button and go to user session
    cy.get("@logBtn").click();

    // Check alert message with errors
    cy.get('[data-cy="log-alert"]').should('exist').as('errorDiv'); // Div with the errors
    cy.get('[data-cy="log-alert-h5"]').should('exist').as('errors'); // Errors
    cy.get('@errors').should('contain', 'There was a problem');
  
  });
})