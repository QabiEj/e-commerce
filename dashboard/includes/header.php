<?php 
session_start();

$customer_pages = [
    '/e-commerce/dashboard/index.php',
    '/e-commerce/dashboard/orders/index.php'
];

$current_page = $_SERVER['SCRIPT_NAME'];

if(isset($_SESSION['is_loggedin']) && $_SESSION['is_loggedin'] == 1) {
    if(isset($_SESSION['role']) && $_SESSION['role'] === 'customer') {
        if(!in_array($current_page, $customer_pages)) {
            die("You don't have permissions to view this page!");
        }
    }
} else {
    die("You don't have permissions to view this page!");
}


if(isset($_GET['action']) && ($_GET['action'] === 'logout')) {
    unset($_SESSION['id']);
    unset($_SESSION['fullname']);
    unset($_SESSION['email']);
    unset($_SESSION['is_loggedin']);
    unset($_SESSION['role']);

    header('Location: http://localhost/e-commerce/');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">eStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/e-commerce/dashboard/index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/e-commerce/dashboard/promotions/">Promotions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/e-commerce/dashboard/categories/">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/e-commerce/dashboard/products/">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/e-commerce/dashboard/orders/">Orders</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            more
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="http://localhost/e-commerce/shop.php">Shop</a></li>
                            <li><a class="dropdown-item" href="http://localhost/e-commerce/dashboard/profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="?action=logout">Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>