<?php 
    include('../includes/header.php'); 
    include('../../classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;

    $categories = $crud->read('categories');
    $product = $crud->read('products', ['column' => 'id', 'value' => $_GET['id']] ,1);

    function imageIsValid($image) { 
        $ext = end(explode('.', $image)); 
        $allowed_extensions = ['png', 'jpg', 'jpeg', 'webp'];
        return in_array($ext, $allowed_extensions);
    }

    if(isset($_POST['update_product_btn'])) {
        $id = $_POST['id'];
        $category_id = $_POST['category'];
        $name = $_POST['name'];
        $qty = $_POST['qty'];
        $discount = $_POST['discount'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_FILES['image'];

        $data = [
            'user_id' => $_SESSION['id'], 
            'category_id' => $category_id, 
            'name' => $name, 
            'qty' => $qty, 
            'discount' => $discount, 
            'price' => $price, 
            'description' => $description
        ];

        if(isset($image['name']) || imageIsValid($image['name'])) {
            $data['image'] = time().$image['name'];
        }
        
        if($crud->update('products', $data, ['column' => 'id', 'value' => $id]) === true) {
            if(isset($image['name']) && imageIsValid($image['name'])) {
                if(move_uploaded_file($image['tmp_name'], 'images/'.time().$image['name'])) {
                    unlink('images/'.$promotion[0]['image']);
                }
            }
            header('Location: index.php?action=update&status=success');
        } else {
            $errors = 'Something want wrong!';
        }
    }
?>

<div class="dashboard my-5">
    <div class="container">
        <h3 class="mb-4">Update product</h3>
        <div class="card">
            <div class="card-body">
                <?php if($errors): ?>
                    <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if(isset($product) && is_array($product[0])): ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select category</option>
                            <?php foreach($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= ($category['id'] == $product[0]['category_id']) ? 'selected' : '' ?>><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="<?= $product[0]['name'] ?>" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="qty">Qty</label>
                        <input type="number" name="qty" id="qty" value="<?= $product[0]['qty'] ?>" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="discount">Discount</label>
                        <input type="number" name="discount" id="discount" value="<?= $product[0]['discount'] ?>" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" value="<?= $product[0]['price'] ?>" class="form-control" required="" pattern="\d+\.\d{2}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"><?= $product[0]['description'] ?></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpg, image/jpeg, image/webp">
                        <br>
                        <p>Existing image:</p>
                        <img src="images/<?= $product[0]['image'] ?>" height="80">
                    </div>
                    <input type="hidden" name="id" value="<?= $product[0]['id'] ?>">
                    <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                </form>
                <?php else: ?>
                    <p>Product doesn't exist!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>