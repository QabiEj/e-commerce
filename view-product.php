<?php 
    include('includes/header.php');

    if(isset($_GET['id'])) {
        $product = $crud->read('products', ['column' => 'id', 'value' => $_GET['id']]);
        if(count($product)) $product = $product[0];
    } 

    if(isset($_GET['add_to_cart_btn'])) {
        $qty = $_GET['qty'];
        $id = $_GET['id'];

        if($qty > 0 && $qty <= $product['qty']) {
            if(array_key_exists($id, $_SESSION['cart'])) {
                $cart_product = $_SESSION['cart'][$id];
                $cart_product['qty'] = $cart_product['qty'] + $qty;
                $_SESSION['cart'][$id] = $cart_product;
            } else {
                $cart_product = $product;
                $cart_product['qty'] = $qty;
                $_SESSION['cart'][$id] = $cart_product;
            }
            
            header('Location: cart.php');
        } else {
            header('Location: view-product.php?id='.$id);
        }
    }

?>


<!-- Product -->
<div class="product py-5">
    <div class="container">
        <div class="row mt-5">
        <?php if($product): ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <img src="dashboard/products/images/<?= $product['image'] ?>" class="img-fluid" alt="<?= $product['name'] ?>">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $product['name'] ?></h2>
                <p><?= $product['price'] ?> &euro;</p>
                <p>
                    <?php if($product['discount'] > 0): ?>
                    <span class="badge bg-danger"><?= $product['discount'] ?>%</span>
                    <?php
                        $new_price = $product['price'] - ($product['price'] * ($product['discount'] / 100));
                        echo number_format($new_price, 2, ".", "");
                    ?> &euro;
                    <?php endif; ?>
                </p>
                <p class="my-5 p-2" style="border: 1px solid #e3e3e3;"><?= $product['description'] ?></p>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" class="d-flex align-items-center">
                    <input type="number" name="qty" id="qty" value="1" min="1" class="form-control me-4 w-25" max="<?= $product['qty'] ?>" />
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <button type="submit" name="add_to_cart_btn" class="btn bnt-sm btn-outline-primary">Add to cart</button>
                </form>
            </div> <!-- ./col -->
        <?php endif; ?>
        </div> <!-- ./row -->
    </div>
</div>

<?php include('includes/footer.php'); ?>