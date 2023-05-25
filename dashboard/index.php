<?php 
include('includes/header.php'); 

include('../classes/CRUD.php');
$crud = new CRUD;

$promotions = count($crud->read('promotions'));
$categories = count($crud->read('categories'));
$products = count($crud->read('products'));
$orders = 0;

if(isset($_SESSION['role'])) {
    if($_SESSION['role'] == 'admin') {
        $orders = count($crud->read('orders'));
    } else if($_SESSION['role'] == 'customer') {
        $orders = count($crud->read('orders', ['column' => 'user_id', 'value' => $_SESSION['id']]));
    }
}
?>

    <div class="container my-5">
        <div class="d-flex justify-content-between mb-5">
            <div>
                <h3><?= $_SESSION['fullname'] ?></h3>
                <p><?= $_SESSION['email'] ?></p>
            </div>
            <div>
                <a href="?action=logout" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Are you sure?')">
                    Log out
                </a>
            </div>
        </div>
        <div class="row">
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h2><?= $promotions ?></h2>
                        <p>Promotions</p>
                        <a href="promotions/" class="btn btn-sm btn-outline-secondary">Manage</a>
                    </div>
                </div>
            </div> 
            <?php endif; ?>

            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h2><?= $categories ?></h2>
                        <p>Categories</p>
                        <a href="categories/" class="btn btn-sm btn-outline-secondary">Manage</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h2><?= $products ?></h2>
                        <p>Products</p>
                        <a href="products/" class="btn btn-sm btn-outline-secondary">Manage</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h2><?= $orders ?></h2>
                        <p>Orders</p>
                        <a href="orders/" class="btn btn-sm btn-outline-secondary">Manage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include('includes/footer.php'); ?>