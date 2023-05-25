<?php 
    include('../includes/header.php'); 
    include('../../classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;

    function imageIsValid($image) { 
        $ext = end(explode('.', $image)); 
        $allowed_extensions = ['png', 'jpg', 'jpeg', 'webp'];
        return in_array($ext, $allowed_extensions);
    }

    if(isset($_POST['create_slide_btn'])) {
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $is_active = (isset($_POST['is_active']) && ($_POST['is_active'] === 1)) ? 1 : 0;
        $image = $_FILES['image'];

        if(empty($title)) {
            $errors[] = 'Title is empty!';
        }
        
        if(empty($subtitle)) {
            $errors[] = 'Subtitle is empty!';
        }


        $data = ['title' => $title, 'subtitle' => $subtitle, 'is_active' => $is_active];

        if(empty($image['name']) || !imageIsValid($image['name'])) {
            $errors[] = 'Image is empty or type is not supported!';
        } else {
            $data['image'] = time().$image['name'];
        }
        

        if($crud->create('promotions', $data) === true) {
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
        <h3 class="mb-4">Create slide</h3>
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
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="is_active">Is active</label>
                        <input type="checkbox" name="is_active" value="1" />
                    </div>
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" required="" accept="image/png, image/jpg, image/jpeg, image/webp">
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_slide_btn">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>