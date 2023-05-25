<?php 
    include('includes/header.php'); 

    $errors = [];

    if(isset($_POST['register_btn'])) {
        // data
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if(empty($fullname)) {
            $errors[] = 'Fullname is required!';
        } else {
            $fullname_parts = explode(" ", $fullname);
            $name = $fullname_parts[0];
            $surname = $fullname_parts[1];
        }

        if(empty($email)) {
            $errors[] = 'Email is required!';
        }

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
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'password' => password_hash($password1, PASSWORD_BCRYPT )
            ];
    
            // insert user -> db: users
            if($crud->create('users', $data)) {
                header('Location: login.php?action=register&status=1');
            } 
        }
    }
?>

<!-- Login -->
<div class="auth py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <img src="./assets/img/aboutus.webp" class="img-fluid" alt="eStore" />
            </div>
            <div class="col-lg-5 offset-lg-1 col-md-5 offset-md-1 col-sm-12 offset-sm-0 d-flex align-items-center">
                <div class="login w-100">
                    <h2>Register</h2>
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
                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter your name and surname" />
                        </div>
                        <div class="form-group my-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" />
                        </div>
                        <div class="form-group my-4">
                            <label for="password">Password</label>
                            <input type="password" name="password1" id="password" class="form-control" placeholder="Enter your password" />
                        </div>
                        <div class="form-group my-4">
                            <label for="password">Repeat password</label>
                            <input type="password" name="password2" id="password" class="form-control" placeholder="Repeat your password" />
                        </div>
                        <button type="submit" name="register_btn" class="btn btn-sm btn-outline-primary">Register</button>
                        <a href="login.php" class="btn btn-sm btn-link">Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>