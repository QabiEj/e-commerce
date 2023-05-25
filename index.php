<?php 
    include('includes/header.php');
    
    $promotions = $crud->read('promotions', [], 4, ['column' => 'id', 'order' => 'DESC']);
    $products = $crud->read('products', [], 4, ['column' => 'id', 'order' => 'DESC']);
?>

<?php if(isset($_GET['action']) && ($_GET['action'] == 'checkout')): ?>
    <?php if(isset($_GET['status']) && ($_GET['status'] == 1)): ?>
    <div class="container my4">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> Your order was created successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>
<?php endif; ?>

<!-- Promotions -->
<?php if($promotions && count($promotions)): ?>
<div class="promotions">
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <?php foreach($promotions as $index => $promotion): ?>
            <div class="carousel-item <?= ($index === 0) ? 'active' : '' ?>">
                <img src="dashboard/promotions/images/<?= $promotion['image'] ?>" class="d-block w-100" alt="<?= $promotion['title'] ?>" />
                <div class="carousel-caption d-none d-md-block">
                    <h5><?= $promotion['title'] ?></h5>
                    <p><?= $promotion['subtitle'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<?php endif; ?>

<!-- Latest products -->
<?php if($products && count($products)): ?>
<div class="latest-products bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Latest products</h2>
            <p><?= count($products) ?> products available</p>
        </div>
        <div class="row">
            <?php foreach($products as $product): ?>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="dashboard/products/images/<?= $product['image'] ?>" class="product-image" alt="<?= $product['name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text card-text-product">
                            <?= $product['price'] ?> &euro;
                            <br />
                            <?php if($product['discount'] > 0): ?>
                                <span class="badge bg-danger"><?= $product['discount'] ?>%</span>
                                <?php
                                    $new_price = $product['price'] - ($product['price'] * ($product['discount'] / 100));
                                    echo number_format($new_price, 2, ".", "");
                                ?> &euro;
                            <?php endif; ?>
                        </p>
                        <a href="view-product.php?id=<?= $product['id'] ?>" class="btn btn-outline-secondary">
                            View product
                        </a>
                    </div>
                </div> <!-- ./card -->
            </div> <!-- ./col -->
            <?php endforeach; ?>
        </div> <!-- ./row -->
        <div class="text-center mt-5">
            <a href="shop.php" class="btn btn-sm btn-outline-primary">Shop page &rarr;</a>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- About eStore -->
<div class="about-us py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <img src="./assets/img/aboutus.webp" class="img-fluid" alt="eStore" />
            </div>
            <div class="col-lg-6 offset-lg-1 col-md-6 offset-md-1 col-sm-12 offset-sm-0">
                <h2>eStore</h2>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat veritatis perferendis a accusantium nemo eum voluptatibus maxime optio, non blanditiis? Ipsa ab error aliquid dolorum, quasi dolor illo quam corrupti!
                </p>
                <p class="mt-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat earum error molestiae exercitationem velit at corporis porro cumque minus ducimus, quia ex quo consectetur veniam tenetur reiciendis ratione quisquam qui.
                </p>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>