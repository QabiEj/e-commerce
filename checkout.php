<?php 
    include('includes/header.php'); 

    // check?
    if(!isset($_SESSION['is_loggedin']) || $_SESSION['is_loggedin'] != 1) {
        die('<div class="container my-4">Please <a href="login.php">login</a> first</div>');
    }


    $errors = [];

    if(isset($_POST['checkout_btn'])) {
        // data
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $notes = $_POST['notes'];

        if(empty($fullname)) {
            $errors[] = 'Fullname is required!';
        } 

        if(empty($email)) {
            $errors[] = 'Email is required!';
        }

        if(empty($phone)) {
            $errors[] = 'Phone is required!';
        }

        if(empty($address)) {
            $errors[] = 'Address is required!';
        }

        if(count($errors) === 0) {
            $data = [
                'user_id' => 3,
                'customer_data' => ($fullname ."<br />" .$phone ."<br />" .$email ."<br />" .$address),
                'notes' => $notes,
                'total' => array_reduce($_SESSION['cart'], function($sum, $item) { 
                    return $sum + ($item['qty'] * $item['price']); 
                })
            ];
    
            if($crud->create('orders', $data)) {
                // pivot table: order_product (for each cart product: order_id, product_id)
                $order_id = $crud->read('orders', [], $limit = 1, $order = ['column' => 'id', 'order' => 'DESC'])[0]['id'];

                foreach($_SESSION['cart'] as $item) {
                    $crud->create('order_product', ['order_id' => $order_id, 'products_id' => $item['id']]);
                }

                unset($_SESSION['cart']);

                header('Location: index.php?action=checkout&status=1');
            } else {
                $errors[] = 'Something want wrong!'; 
            }
        }
    }
?>

<!-- Checkout page -->
<div class="checkout py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h2>Buy from the best</h2>
            </div>
            <div>
                <a href="#" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                    Empty cart
                </a>
            </div>
        </div>
        <div class="my-5">
            <h4 class="mb-4">
                Checkout
            </h4>
            <div class="checkout-form">
                <?php if($errors): ?>
                    <ul>
                        <?php foreach($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        <label for="fullname my-2">Fullname</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Fullname" required />
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
                    </div>
                    <div class="form-group my-2">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" required />
                    </div>
                    <div class="form-group my-2">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control" required></textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" class="form-control"></textarea>
                    </div>
                    <button type="submit" name="checkout_btn" class="btn btn-sm btn-outline-primary">Submit</button>
                </form>
            </div>
        </div> <!-- ./div -->
    </div>
</div>


<?php include('includes/footer.php'); ?>