<?php 
    include('../includes/header.php'); 
    include('../../classes/CRUD.php');
    
    $crud = new CRUD;
    $category = $crud->read('categories', ['column' => 'id', 'value' => $_GET['id']] ,1);

    $errors = [];

    if(isset($_POST['update_category_btn'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];

        if(empty($name)) {
            $errors[] = 'Name is empty!';
        }

        if(empty($id)) {
            header('Location: index.php');
        }

        if($crud->update('categories', ['name' => $name], ['column' => 'id', 'value' => $id]) === true) {
            header('Location: index.php?action=update&status=success');
        } else {
            $errors = 'Something want wrong!';
        }
    }
?>

<div class="dashboard my-5">
    <div class="container">
        <h3 class="mb-4">Update category</h3>
        <div class="card">
            <div class="card-body">
                <?php if($errors): ?>
                    <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if(isset($category) && is_array($category[0])): ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group mb-4">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="<?= $category[0]['name'] ?>" class="form-control" required="">
                    </div>
                    <input type="hidden" name="id" value="<?= $category[0]['id'] ?>">
                    <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                </form>
                <?php else: ?>
                    <p>Category doesn't exist!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>