<?php 
    session_start();

    function calculateTotalPrice($cart)
{
    $totalPrice = 0;
    foreach ($cart as $item) {
        $totalPrice += $item['price'] * $item['qty'];
    }
    // Set the total price in the session
    $_SESSION['totalPrice'] = $totalPrice;
    return $totalPrice;
}

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    include('classes/CRUD.php');
    $crud = new CRUD;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .product-image {
            height: 120px;
            display: block;
            margin: 20px auto;
        }

        .card-text-product {
            height: 60px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">eStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="cart.php">
                    Cart
                    <?php if(isset($_SESSION['cart'])): ?>
                        (<?= count($_SESSION['cart']) ?>)
                    <?php endif; ?>
                </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= (isset($_SESSION['fullname'])) ? $_SESSION['fullname'] : 'Guest' ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if(!isset($_SESSION['is_loggedin']) || $_SESSION['is_loggedin'] != 1): ?>
                        <li><a class="dropdown-item" href="login.php">Login</a></li>
                        <li><a class="dropdown-item" href="register.php">Register</a></li>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['is_loggedin']) && ($_SESSION['is_loggedin'] == 1)): ?>
                        <li><a class="dropdown-item" href="dashboard/index.php">Dashboard</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" id="search-form" role="search" onsubmit="event.preventDefault();">
                <input class="form-control me-2" name="search" id="search" placeholder="Search" value="<?= (isset($_GET['search']) && (strlen($_GET['search']) >= 3)) ? $_GET['search'] : '' ?>" />
            </form>
            </div>
        </div>
    </nav>