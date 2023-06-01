# e-commerce
# eCommerce Shopping Cart Website

## Introduction
This is a fully featured eCommerce website developed in PHP. It provides an intuitive and user-friendly platform for customers to browse and purchase products online. The website features an extensive product catalog, secure user authentication, advanced product search and filtering, shopping cart functionality, user profile management, and integrated PayPal payment.

## Key Features
- User Authentication: Users can register and log in to the website to have a personalized shopping experience.
- Product Catalog: A wide array of products listed, each with detailed descriptions and prices.
- Advanced Search & Filtering: Users can easily search for products and filter results based on various criteria.
- Shopping Cart: Products can be added to a shopping cart, with the ability to adjust quantities or remove items as needed.
- User Profile Management: Users can manage their profiles, updating personal details as required.
- Checkout & Payment: The checkout process collects necessary shipping details and uses integrated PayPal for secure payment.
- Order History & Tracking: Users can view their past orders and track the status of current orders.

## Getting Started
1. Clone the repository.
2. Set up a local development server with PHP (like XAMPP, WAMP, or MAMP).
3. Import the database to your MySQL server.
4. Update the `classes/Database.php` file with your own database connection information.
5. Run the `composer require league/omnipay omnipay/paypal` command to set up the PayPal integration.
6. Run the website on your local development server.

## Usage
Users can browse through the extensive product listings, search for specific items, and filter the results based on various parameters. Users can add products to their shopping cart and adjust quantities or remove items as needed. They can also manage their user profiles and view their order history.

When ready, users can proceed to checkout where they need to provide shipping details. The payment is then made securely through PayPal.

## Code Overview
The project uses an MVC (Model-View-Controller) architecture. PHP is used for server-side scripting, with HTML and CSS for the frontend.

Key scripts include:
- `index.php`: Displays the product catalog.
- `login.php`: Manages user login functionality.
- `cart.php`: Provides shopping cart functionality.
- `checkout.php`: Handles the checkout process and PayPal payment.
- `includes/header.php` and `includes/footer.php`: Contain HTML used across multiple pages.
- `classes/CRUD.php`: Includes a CRUD (Create, Read, Update, Delete) class for database operations.

## Conclusion
This eCommerce website offers a comprehensive solution for online shopping. With a broad range of features and secure PayPal integration, it offers a robust and user-friendly experience for customers. The codebase is well-structured and can be further customized as needed.

P.S. If someone wants to use PayPal Sandbox payment credentials, they need to contact one of the following:

- Shaban Ejupi: shaban.ejupi@student.uni-pr.edu
- Flamur Avdylaj: flamur.avdylaj@student.uni-pr.edu
- Arianit Likaj: arianit.likaj@student.uni-pr.edu

