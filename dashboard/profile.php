<?php 
    include('includes/header.php'); 
    
    include('../classes/CRUD.php');
    $crud = new CRUD;

    $user = $crud->read('users', ['column' => 'id', 'value' => $_SESSION['id']], 1);

    if(is_array($user)) { $user = $user[0]; }
    $errors = [];

    // update user data
    if(isset($_POST['update_profile_btn'])) {
        // data
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if(empty($name)) {
            $errors[] = 'Name is required!';
        } 

        if(empty($surname)) {
            $errors[] = 'Surname is required!';
        } 

        if(empty($phone)) {
            $errors[] = 'Phone is required!';
        }

        if(empty($address)) {
            $errors[] = 'Address is required!';
        }

        if(count($errors) === 0) {
            $data = [
                'name' => $name,
                'surname' => $surname,
                'phone' => $phone,
                'address' => $address,
            ];

            if(!empty($_FILES['image']['name'])) {
                $data['avatar'] = time().$_FILES['image']['name'];
            }

            if($crud->update('users', $data, ['column' => 'id', 'value' => $_SESSION['id']])) {
                if(!empty($_FILES['image']['name'])) {
                    if(move_uploaded_file($_FILES['image']['tmp_name'], 'assets/avatars/'.time().$_FILES['image']['name'])) {
                        header('Location: http://localhost/e-commerce/dashboard/profile.php');
                    } else {
                        $errors[] = 'Something want wrong while uploading avatar image!';
                    }
                }

                header('Location: http://localhost/e-commerce/dashboard/profile.php');
            } else {
                $errors[] = 'Something want wrong!'; 
            }
        }
        }

    // update password
    if(isset($_POST['update_password_btn'])) {
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        
        if(empty($password1)) {
            $errors[] = 'Password is required!';
        }

        if(empty($password2)) {
            $errors[] = 'Repeat password is required!';
        }

        if($password1 !== $password2) {
            $errors[] = 'Fields: Password & Repeat password must have same values!';
        }

        if(count($errors) === 0) {
            $data = [
                'password' => password_hash($password1, PASSWORD_BCRYPT)
            ];
    
            if($crud->update('users', $data, ['column' => 'id', 'value' => $_SESSION['id']])) {
                unset($_SESSION['id']);
                unset($_SESSION['fullname']);
                unset($_SESSION['email']);
                unset($_SESSION['is_loggedin']);
                unset($_SESSION['role']);

                header('Location: http://localhost/e-commerce/login.php');
            } 
        }
    }
?>

<div class="profile my-5">
    <?php if($errors): ?>
    <div class="container">
        <ul>
        <?php foreach($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <div class="container">
        <h3 class="mb-4">Profile</h3>
        <p></p>                        <div class="card mb-4">
            <div class="card-header">
                <h5>Update</h5>
            </div>
            <div class="card-body">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" required="" value="<?= $user['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" name="surname" class="form-control" id="surname" required="" value="<?= $user['surname'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="address" required="" value="<?= $user['address'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" name="phone" class="form-control" id="phone" required="" value="<?= $user['phone'] ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpg, image/jpeg, image/webp">
                        <?php if(!empty($user['avatar']) && ($user['avatar'] !== 'avatar.png')): ?>
                            <img src="assets/avatars/<?= $user['avatar'] ?>" height="80px" class="pt-2" alt="<?= $user['name'] ?>" />
                        <?php endif; ?>
                    </div>
                    <button type="submit" name="update_profile_btn" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5>Change password</h5>
            </div>
            <div class="card-body">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="password1" class="form-label">Password</label>
                        <input type="password" name="password1" class="form-control" id="password1" required="">
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label">Repeat Password</label>
                        <input type="password" name="password2" class="form-control" id="password2" required="">
                    </div>
                    <button type="submit" name="update_password_btn" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
