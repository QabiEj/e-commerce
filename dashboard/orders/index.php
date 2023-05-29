<?php 
include('../includes/header.php'); 

include('../../classes/CRUD.php');
$crud = new CRUD;

if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    $orders = $crud->read('orders');
} else if(isset($_SESSION['role']) && $_SESSION['role'] == 'customer') {
    $orders = $crud->read('orders', ['column' => 'user_id', 'value' => $_SESSION['id']]);
} else {
    $orders = []; // Set $orders as an empty array if no conditions are met
}
?>

<div class="dashboard my-5">
    <div class="container">
        <h3 class="mb-4">Orders</h3>
        <div class="card">
            <div class="card-body">
                <?php if(is_array($orders) && count($orders) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Customer details</th>
                                <th>Notes</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            <?php foreach($orders as $order): ?>
                            <tr>
                                <td><?= $order['id'] ?></td>
                                <td><?= $order['customer_data'] ?></td>
                                <td><?= $order['notes'] ?></td>
                                <td><?= $order['total'] ?> EUR</td>
                                <td>
                                    <a href="?action=delete&id=<?= $order['id'] ?>">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <p>0 Orders</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
