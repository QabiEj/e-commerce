<?php
    include('../includes/header.php'); 
    include('../../classes/CRUD.php');
    
    $crud = new CRUD;
    $products = $crud->read('products');

    if(isset($_GET['action']) && ($_GET['action'] === 'delete')) {
        $product = $crud->read('products', ['column' => 'id', 'value' => $_GET['id']])[0];
        unlink('images/'.$product['image']);
        if($crud->delete('products', ['column' => 'id', 'value' => $_GET['id']])) {
            header('Location: index.php');
        }
    }
?>

<div class="dashboard my-5">
    <div class="container">
        <h3 class="mb-4">Products</h3>
        <a href="create.php" class="btn btn-outline-primary mb-4">Create product</a>
        <?php if($products && count($products)): ?>
        <div class="card">
            <div class="card-body">
                <?php if(isset($_GET['action']) && isset($_GET['status'])): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?php if(($_GET['action'] === 'create') && ($_GET['status'] === 'success')): ?>
                            Product was created successfully.
                        <?php endif; ?>
                        <?php if(($_GET['action'] === 'update') && ($_GET['status'] === 'success')): ?>
                            Product was updated successfully.
                        <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bproductd">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>#</th>
                            </tr>
                            <?php foreach($products as $product): ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td>
                                    <img src="images/<?= $product['image'] ?>" height="80">
                                </td>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['price'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $product['id'] ?>">Edit</a>
                                    <a href="?action=delete&id=<?= $product['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include('../includes/footer.php'); ?>