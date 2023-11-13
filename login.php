<?php
require('config/conection.php');
session_start();
require('config/modal_general.php');
if (isset($_POST['login_button'])) {
    $_SESSION['validate'] = false;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $p = crud::conect()->prepare('SELECT * FROM crudtable WHERE email=:e and pass=:p');
    $p->bindValue(':e', $email);
    $p->bindValue(':p', $password);
    $p->execute();
    $data = array();
    $data = $p->fetchAll(PDO::FETCH_ASSOC);
    if ($p->rowCount() > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['pass'] = $password;
        $_SESSION['name'] = $data[0]['name'];
        $_SESSION['validate'] = true;
        Header('Location: users.php');
    } else {
        echo
        '<script>
                document.addEventListener("DOMContentLoaded", function () {
                    callModal("Usuario y contraseña incorrectos","login.php");
                });
        </script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('config/head.php') ?>
</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Crud Quiz</h1>
                                    </div>
                                    <form class="user" action="login.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="Enter your email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-block" value="Login" name="login_button">
                                        </div>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="font-weight-bold small" href="signUP.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="version" id="version-ruangadmin"></div>
    <!-- Login Content -->
    <?php include('config/scripts.php') ?>
</body>


</html>