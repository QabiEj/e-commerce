# eCommerce Shopping Cart Website

## Introduction
This is a fully featured eCommerce website developed in PHP. It provides an intuitive and user-friendly platform for customers to browse and purchase products online. The website features an extensive product catalog, secure user authentication, advanced product search and filtering, shopping cart functionality, user profile management, credit card payment form, and integrated PayPal payment plus transportation details and process included as part of Paypal payment (**updated version based in our promises given as part of assignment 2 - Diagrams**).

## Key Features
- User Authentication: Users can register and log in to the website to have a personalized shopping experience.
- Product Catalog: A wide array of products listed, each with detailed descriptions and prices.
- Advanced Search & Filtering: Users can easily search for products and filter results based on various criteria.
- Shopping Cart: Products can be added to a shopping cart, with the ability to adjust quantities or remove items as needed.
- User Profile Management: Users can manage their profiles, updating personal details as required.
- Checkout & Payment: The checkout process collects necessary shipping details and uses integrated PayPal for secure payment.
- Order History & Tracking: Users can view their past orders and track the status of current orders.
- ![AddProducts](https://github.com/ShabanEjupi/e-commerce/assets/101940223/21097793-8739-4dfc-a686-64456c7f1f9e)
- ![Main - 1](https://github.com/ShabanEjupi/e-commerce/assets/101940223/620cc3dc-c7df-4d19-bead-ae80209d1a6a)
- ![Main - 2](https://github.com/ShabanEjupi/e-commerce/assets/101940223/40cdbc4f-744a-4dcd-b823-e67f68d4f999)
- ![Main - 3](https://github.com/ShabanEjupi/e-commerce/assets/101940223/34b70981-fccb-4bec-b0b1-d8d1e0d78da7)
- ![Cart - 1](https://github.com/ShabanEjupi/e-commerce/assets/101940223/56334625-a110-4cbe-a702-2c12e76ce4fb)
- ![Categories](https://github.com/ShabanEjupi/e-commerce/assets/101940223/0f76c73e-b09f-45e3-9aa3-468cfff82c97)
- ![Dashboard](https://github.com/ShabanEjupi/e-commerce/assets/101940223/765e1e53-f6fd-402d-bb3a-9e88d96a9e4f)
- ![Login](https://github.com/ShabanEjupi/e-commerce/assets/101940223/6f881bbf-06d1-4430-b743-a0d772ea845a)
- ![Orders](https://github.com/ShabanEjupi/e-commerce/assets/101940223/c090c691-56ae-4765-8b80-1c283abfc831)
- ![Products - 1](https://github.com/ShabanEjupi/e-commerce/assets/101940223/e71edddb-f628-442b-8320-063ea37b0a4b)
- ![Profile](https://github.com/ShabanEjupi/e-commerce/assets/101940223/053f810e-5194-4c87-a682-4866ecdfa759)
- ![Promotions](https://github.com/ShabanEjupi/e-commerce/assets/101940223/647d805d-cbb4-4193-80e1-5ffdf5241f40)
- ![Register](https://github.com/ShabanEjupi/e-commerce/assets/101940223/96086260-95bb-44da-a565-380012befbf7)
- ![Shop - 1](https://github.com/ShabanEjupi/e-commerce/assets/101940223/4e46fbc9-131a-4a0c-b7c5-aa4d3ff35bde)
- ![Shop - 2](https://github.com/ShabanEjupi/e-commerce/assets/101940223/9f8a746d-8ad1-47b3-a448-84da1a8298c8)

## Getting Started
1. Clone the repository.
2. Set up a local development server with PHP (like XAMPP, WAMP, or MAMP).
3. Import the database to your MySQL server.
4. Update the `classes/Database.php` file with your own database connection information and the config.php file with your PayPal client ID and secret and the return and cancel URLs for PayPal, in case if you want to make it yours.
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
- `config.php`: Sets up the PayPal payment gateway and database connection.
- `includes/header.php` and `includes/footer.php`: Contain HTML used across multiple pages.
- `classes/CRUD.php`: Includes a CRUD (Create, Read, Update, Delete) class for database operations.

## Conclusion
This eCommerce website offers a comprehensive solution for online shopping. With a broad range of features and secure PayPal integration, it offers a robust and user-friendly experience for customers. The codebase is well-structured and can be further customized as needed.

P.S. If someone wants to use PayPal Sandbox payment credentials, they need to contact one of the following:

- Shaban Ejupi: shaban.ejupi@student.uni-pr.edu
- Flamur Avdylaj: flamur.avdylaj@student.uni-pr.edu
- Arianit Likaj: arianit.likaj@student.uni-pr.edu

