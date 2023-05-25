<?php 
    include('../includes/header.php'); 
    include('../../classes/CRUD.php');
    
    $crud = new CRUD;
    $promotion = $crud->read('promotions', ['column' => 'id', 'value' => $_GET['id']] ,1);

    $errors = [];

    function imageIsValid($image) { 
        $ext = end(explode('.', $image)); 
        $allowed_extensions = ['png', 'jpg', 'jpeg', 'webp'];
        return in_array($ext, $allowed_extensions);
    }

    if(isset($_POST['update_slide_btn'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $is_active = isset($_POST['is_active']) ? $_POST['is_active'] : 0;
        $image = $_FILES['image'];

        if(empty($title)) {
            $errors[] = 'Title is empty!';
        }
        
        if(empty($subtitle)) {
            $errors[] = 'Subtitle is empty!';
        }

        $data = ['title' => $title, 'subtitle' => $subtitle, 'is_active' => $is_active];

        if(isset($image['name']) && imageIsValid($image['name'])) {
            $data['image'] = time().$image['name'];
        }

        if($crud->update('promotions', $data, ['column' => 'id', 'value' => $id]) === true) {
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
        <h3 class="mb-4">Update slide</h3>
        <div class="card">
            <div class="card-body">
                <?php if($errors): ?>
                    <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if(isset($promotion) && is_array($promotion[0])): ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="<?= $promotion[0]['title'] ?>" id="title" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" value="<?= $promotion[0]['subtitle'] ?>" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="is_active">Is active</label>
                        <input type="checkbox" name="is_active" value="1" <?= ($promotion[0]['is_active'] == 1) ? 'checked' : '' ?>  />
                    </div>
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpg, image/jpeg, image/webp">
                        <br>
                        <p>Existing image:</p>
                        <img src="images/<?= $promotion[0]['image'] ?>" height="80">
                    </div>
                    <input type="hidden" name="id" value="<?= $promotion[0]['id'] ?>">
                    <button type="submit" class="btn btn-primary" name="update_slide_btn">Update</button>
                </form>
                <?php else: ?>
                    <p>Promotion doesn't exist!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>