<?php 
    include('includes/header.php');

    $products = $crud->read('products');

    if(isset($_GET['filter'])) {
        $filter = $_GET['filter'];
        $filter_fields = explode("_", $filter);
        $products = $crud->read('products', [], null, ['column' => $filter_fields[0], 'order' => $filter_fields[1]]);
    }

    if(isset($_GET['search'])) {
        if(strlen($_GET['search']) >= 3) {
            $products = $crud->search('products', 'name', $_GET['search']);
        }
    }
?>


<!-- Products -->
<div class="products py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h2>Explore products</h2>
                <p><?= count($products) ?> products available</p>
            </div>
            <div>
                <!-- localhost/shop.php?filter=price_asc -->
                <form action="<?= $_SERVER['PHP_SELF'] ?>" id="filter-form">
                    <select name="filter" id="filter" class="form-control">
                        <option value="">Filter products &darr;</option>
                        <option value="name_asc" <?= (isset($_GET['filter']) && ($_GET['filter']==='name_asc')) ? 'selected' : '' ?>>Name ASC</option>
                        <option value="name_desc" <?= (isset($_GET['filter']) && ($_GET['filter']==='name_desc')) ? 'selected' : '' ?>>Name DESC</option>
                        <option value="price_asc" <?= (isset($_GET['filter']) && ($_GET['filter']==='price_asc')) ? 'selected' : '' ?>>Price ASC</option>
                        <option value="price_desc" <?= (isset($_GET['filter']) && ($_GET['filter']==='price_desc')) ? 'selected' : '' ?>>Price DESC</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="row mt-5">
        <?php if($products && count($products)): ?>
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
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Shop is empty! 0 products
            </div>
        <?php endif; ?>
        </div> <!-- ./row -->
    </div>
</div>

<script>
    document.getElementById('filter').addEventListener('change', () => {
        document.getElementById('filter-form').submit()
    })
</script>
<?php include('includes/footer.php'); ?>