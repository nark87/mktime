describe('Test 2 - Shopping MKTIME', () => {

    beforeEach(() => {
        cy.visit('http://localhost/mktime/login.php');
  
        // Check if exist elements on LOG IN PAGE
        cy.get('[data-cy="log-h2"]').should('exist').as('h2'); // Title
        cy.get('[data-cy="log-img"]').should('exist'); // Image
        cy.get('[data-cy="log-email"]').should('exist').as('email'); // Email Input
        cy.get('[data-cy="log-pass"]').should('exist').as('pass'); // Password Input
        cy.get('[data-cy="log-btn"]').should('exist').as('logBtn'); // Log In Button
    
        // Check if exist the footer
        cy.get('[data-cy="foot"]').should('exist');
        cy.get('[data-cy="fot-h5"]').should('exist').as('footTitle'); // Footer Title
    });
  
  
    it('Shopping an item and modify its quantity', () => {
      
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

        // Check one item from the shop
        const itemName = "Timex Weekender";
        const idItemName = '[data-cy="' + itemName + '"]';
        const titleItem = '[data-cy="n-' + itemName + '"]';
        cy.get(idItemName).should('exist').as('itemName'); // Item div Card
        cy.get('@itemName').should('contain', itemName);
        cy.get(titleItem).should('exist').as('titItem'); // Title Card - Name's Item
        cy.get('@titItem').should('contain', itemName);

        // Click button's item to add to our shopping card
        const btnItem = '[data-cy="btn-' + itemName + '"]';
        cy.get(btnItem).should('exist').as('btItem'); // Button's Item
        cy.get("@btItem").click();

        // Check url after adding item to the cart
        cy.url().should('include', '/added'); // => true

        // Check alert after add an item
        cy.get('[data-cy="alert-add-shop"]').should('exist').as('alertAdd');
        cy.get('@alertAdd').should('contain', 'A Timex Weekender has been added to your cart');

        // Click button View Shopping cart
        cy.get('[data-cy="btn-view-cart"]').should('exist').as('btnView');
        cy.get("@btnView").click();

        // Check url on the shopping cart
        cy.url().should('include', '/cart'); // => true
        cy.url().should('eq', 'http://localhost/mktime/cart.php');// => true

        // Check interface Shopping cart
        cy.get('[data-cy="title-shopping"]').should('exist').as('titlShop');
        cy.get('@titlShop').should('contain', 'Shopping Cart');

        // Check item in our cart
        const itemShop = '[data-cy="i-' + itemName + '"]';
        const qItemShop = '[data-cy="q-' + itemName + '"]';
        const pItemShop = '[data-cy="p-' + itemName + '"]';
        cy.get(itemShop).should('exist').as('itemShop');
        cy.get('@itemShop').should('contain', itemName);
        cy.get(qItemShop).should('exist').as('qItem');
        cy.get('@qItem').should('have.value', '1');
        cy.get(pItemShop).should('exist').as('pItem');
        cy.get('@pItem').should('contain', '59.99');

        // Change quantity 1 to 3 for the item
        cy.get('@qItem').clear().type('3');
        cy.get('@qItem').should('have.value', '3');

        // Check Update Button and click on it
        cy.get('[data-cy="update"]').should('exist').as('btnUpdate');
        cy.get("@btnUpdate").click();
        cy.get(pItemShop).should('exist').as('pItem');
        cy.get('@pItem').should('contain', '179.97'); // 59.99 x 3 = 179.97

        // Check total price of the cart
        cy.get('[data-cy="total-price"]').should('exist').as('total');
        cy.get('@total').should('contain', '179.97');

        
        // Check Checkout Button and click on it
        cy.get('[data-cy="checkout"]').should('exist').as('btnCheckout');
        cy.get("@btnCheckout").click();

        // Check url on the Check Out
        cy.url().should('include', '/checkout'); // => true

        // Check alert after Check Out
        cy.get('[data-cy="msg-checkout"]').should('exist').as('msg-check');
        cy.get('@msg-check').should('contain', 'Thanks for your order. Your Order Number Is');

        // Click button Home to go home page
        cy.get('[data-cy="btn-home-checkout"]').should('exist').as('btnHome');
        cy.get("@btnHome").click();

        // Check url if user is on home page
        cy.url().should('include', '/home'); // => true
        cy.url().should('eq', 'http://localhost/mktime/home.php');// => true
    
        // Check nickname in navbar on home page
        cy.get('[data-cy="home-nick"]').should('exist').as('homeNick');
        cy.get('@homeNick').should('contain', nickname);

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
        cy.get('[data-cy="fot-h5"]').should('exist').as('footTitle'); // Footer Title
        cy.get('@footTitle').should('contain', 'MKTIME');
        
    });

    it('Shopping 2 items', () => {
      
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

        // Check first item from the shop
        const itemWeekender = "Timex Weekender";
        const idWeekender = '[data-cy="' + itemWeekender + '"]';
        const titleWeekender = '[data-cy="n-' + itemWeekender + '"]';
        cy.get(idWeekender).should('exist').as('itemWeekender'); // Item div Card
        cy.get('@itemWeekender').should('contain', itemWeekender);
        cy.get(titleWeekender).should('exist').as('titWeekender'); // Title Card - Name's Item
        cy.get('@titWeekender').should('contain', itemWeekender);

        // Click button's item to add to our shopping card
        const btnWeekender = '[data-cy="btn-' + itemWeekender + '"]';
        cy.get(btnWeekender).should('exist').as('btWeekender'); // Button's Item
        cy.get("@btWeekender").click();

        // Check url after adding item to the cart
        cy.url().should('include', '/added'); // => true

        // Check alert after add an item
        cy.get('[data-cy="alert-add-shop"]').should('exist').as('alertAdd');
        cy.get('@alertAdd').should('contain', 'A Timex Weekender has been added to your cart');

        // Click button View Shopping cart
        cy.get('[data-cy="btn-continue"]').should('exist').as('btnContinue');
        cy.get("@btnContinue").click();

        // Check url if user is on home page
        cy.url().should('include', '/home'); // => true
        cy.url().should('eq', 'http://localhost/mktime/home.php');// => true

        // Check second item from the shop
        const itemGarmin = "Garmin Fenix 7";
        const idGarmin = '[data-cy="' + itemGarmin + '"]';
        const titleGarmin = '[data-cy="n-' + itemGarmin + '"]';
        cy.get(idGarmin).should('exist').as('itemGarmin'); // Item div Card
        cy.get('@itemGarmin').should('contain', itemGarmin);
        cy.get(titleGarmin).should('exist').as('titGarmin'); // Title Card - Name's Item
        cy.get('@titGarmin').should('contain', itemGarmin);

        // Click button's item to add to our shopping card
        const btnGarmin = '[data-cy="btn-' + itemGarmin + '"]';
        cy.get(btnGarmin).should('exist').as('btGarmin'); // Button's Item
        cy.get("@btGarmin").click();

        // Check url after adding item to the cart
        cy.url().should('include', '/added'); // => true

        // Check alert after add an item
        cy.get('[data-cy="alert-add-shop"]').should('exist').as('alertAdd');
        cy.get('@alertAdd').should('contain', 'A Garmin Fenix 7 has been added to your cart');

        // Click button View Shopping cart
        cy.get('[data-cy="btn-view-cart"]').should('exist').as('btnView');
        cy.get("@btnView").click();

        // Check url on the shopping cart
        cy.url().should('include', '/cart'); // => true
        cy.url().should('eq', 'http://localhost/mktime/cart.php');// => true

        // Check interface Shopping cart
        cy.get('[data-cy="title-shopping"]').should('exist').as('titlShop');
        cy.get('@titlShop').should('contain', 'Shopping Cart');

        // Check first item in our cart
        const iWeekShop = '[data-cy="i-' + itemWeekender + '"]';
        const qWeekShop = '[data-cy="q-' + itemWeekender + '"]';
        const pWeekShop = '[data-cy="p-' + itemWeekender + '"]';
        cy.get(iWeekShop).should('exist').as('weekShop');
        cy.get('@weekShop').should('contain', itemWeekender);
        cy.get(qWeekShop).should('exist').as('qWeek');
        cy.get('@qWeek').should('have.value', '1');
        cy.get(pWeekShop).should('exist').as('pWeek');
        cy.get('@pWeek').should('contain', '59.99');

        // Check second item in our cart
        const iGarminShop = '[data-cy="i-' + itemGarmin + '"]';
        const qGarminShop = '[data-cy="q-' + itemGarmin + '"]';
        const pGarminShop = '[data-cy="p-' + itemGarmin + '"]';
        cy.get(iGarminShop).should('exist').as('garminShop');
        cy.get('@garminShop').should('contain', itemGarmin);
        cy.get(qGarminShop).should('exist').as('qGarmin');
        cy.get('@qGarmin').should('have.value', '1');
        cy.get(pGarminShop).should('exist').as('pGarmin');
        cy.get('@pGarmin').should('contain', '699.99');

        // Check total price of the cart
        cy.get('[data-cy="total-price"]').should('exist').as('total');
        cy.get('@total').should('contain', '759.98');

        
        // Check Checkout Button and click on it
        cy.get('[data-cy="checkout"]').should('exist').as('btnCheckout');
        cy.get("@btnCheckout").click();

        // Check url on the Check Out
        cy.url().should('include', '/checkout'); // => true

        // Check alert after Check Out
        cy.get('[data-cy="msg-checkout"]').should('exist').as('msg-check');
        cy.get('@msg-check').should('contain', 'Thanks for your order. Your Order Number Is');

        // Click button Home to go home page
        cy.get('[data-cy="btn-home-checkout"]').should('exist').as('btnHome');
        cy.get("@btnHome").click();

        // Check url if user is on home page
        cy.url().should('include', '/home'); // => true
        cy.url().should('eq', 'http://localhost/mktime/home.php');// => true
    
        // Check nickname in navbar on home page
        cy.get('[data-cy="home-nick"]').should('exist').as('homeNick');
        cy.get('@homeNick').should('contain', nickname);

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
        cy.get('[data-cy="fot-h5"]').should('exist').as('footTitle'); // Footer Title
        cy.get('@footTitle').should('contain', 'MKTIME');
        
    });

  })