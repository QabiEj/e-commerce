<?php 
    include('../includes/header.php'); 
    include('../../classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;
    $categories = $crud->read('categories');

    function imageIsValid($image) { 
        $ext = end(explode('.', $image)); 
        $allowed_extensions = ['png', 'jpg', 'jpeg', 'webp'];
        return in_array($ext, $allowed_extensions);
    }

    if(isset($_POST['create_product_btn'])) {
        $category_id = $_POST['category'];
        $name = $_POST['name'];
        $qty = $_POST['qty'];
        $discount = $_POST['discount'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_FILES['image'];


        $data = ['user_id' => $_SESSION['id'], 'category_id' => $category_id, 'name' => $name, 'qty' => $qty, 'discount' => $discount, 'price' => $price, 'description' => $description];

        if(!empty($image['name']) || imageIsValid($image['name'])) {
            $data['image'] = time().$image['name'];
        }
        
        if($crud->create('products', $data) === true) {
            if(isset($image['name']) && imageIsValid($image['name'])) {
                move_uploaded_file($image['tmp_name'], 'images/'.time().$image['name']);
            }
            header('Location: index.php?action=create&status=success');
        } else {
            $errors = 'Something want wrong!';
        }
    }
?>

<div class="dashboard my-5">
    <div class="container">
        <h3 class="mb-4">Create product</h3>
        <div class="card">
            <div class="card-body">
                <?php if($errors): ?>
                    <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select category</option>
                            <?php foreach($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="qty">Qty</label>
                        <input type="number" name="qty" id="qty" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="discount">Discount</label>
                        <input type="number" name="discount" id="discount" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="form-control" required="" pattern="\d+\.\d{2}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" required="" accept="image/png, image/jpg, image/jpeg, image/webp">
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_product_btn">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>