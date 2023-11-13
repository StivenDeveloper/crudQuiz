<?php

session_start();
if (isset($_SESSION["name"])) {
    $nameSession = $_SESSION['name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('config/head.php') ?>
    <title>Sign UPt</title>
</head>

<body>
    <?php

    require('config/conection.php');
    require('config/modal_general.php');
    if (isset($_POST['signUP_button'])) {
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confPassword = $_POST['confiPassword'];
        if (!empty($_POST['name']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            if ($password == $confPassword) {
                $consulta = crud::conect()->prepare('SELECT * FROM  crudtable WHERE email=:e');
                $consulta->bindValue(':e', $email);
                $consulta->execute();
                if ($consulta->rowCount() > 0) {
                    echo '<script>
                                document.addEventListener("DOMContentLoaded", function () {
                                callModal("Ya existe el correo, intenta con otro","signUP.php");
                                });
                            </script>';
                } else {
                    $p = crud::conect()->prepare('INSERT INTO crudtable(name,lastName,email,pass) VALUES(:n,:l,:e,:p)');
                    $p->bindValue(':n', $name);
                    $p->bindValue(':l', $lastName);
                    $p->bindValue(':e', $email);
                    $p->bindValue(':p', $password);
                    $p->execute();
                    if (isset($_SESSION['validate'])) {
                        echo '<script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                    callModal("Usuario registrado correctamente","users.php");
                                    });
                            </script>';
                    } else {
                        echo '<script>
                                document.addEventListener("DOMContentLoaded", function () {
                                callModal("Usuario registrado correctamente","signUP.php");
                                });
                             </script>';
                    }
                }
            } else {
                echo '<script>
                            document.addEventListener("DOMContentLoaded", function () {
                            callModal("Las contraseñas no coinciden","signUP.php");
                            });
                    </script>';
            }
        }
    }

    ?>

    <div id="wrapper">
        <!-- Sidebar (Barra lateral izquirda) -->
        <?php
        if (isset($_SESSION['validate'])) {
            include_once("config/sidebar.php");
        }
        ?>
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- TopBar (Barra de navegación) -->
            <?php
            if (isset($_SESSION["validate"])) {
                include_once("config/topbar.php");;
            }
            ?>
            <!-- Topbar -->

            <div class="container-login">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12 col-md-9">
                        <div class="card shadow-sm my-5">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="login-form">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                            </div>
                                            <form action="signUP.php" method="post">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter First Name" name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" id="exampleInputLastName" placeholder="Enter Last Name" name="lastName">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address" name="email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
                                                </div>
                                                <div class="form-group">
                                                    <label>Repeat Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPasswordRepeat" placeholder="Repeat Password" name="confiPassword">
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary btn-block" name="signUP_button" value="Register">
                                                </div>
                                                <hr>
                                                <a href="index.html" class="btn btn-google btn-block">
                                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                                </a>
                                                <a href="index.html" class="btn btn-facebook btn-block">
                                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                                </a>
                                            </form>
                                            <hr>
                                            <?php if (!isset($_SESSION['validate'])) {
                                               echo' <div class="text-center">
                                                        <a class="font-weight-bold small" href="login.php">Already have an account?</a>
                                                    </div>';
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="form">
        <div class="title">
            <p>Sign UP form</p>
        </div>
        <form action="" method="post">
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="lastName" placeholder="Last name">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="password" placeholder="Password">
            <input type="text" name="confiPassword" placeholder="Confrim password">

            <input type="submit" value="Sign UP" name="signUP_button">
            <a href="./login.php">Do you have account? Sign in</a>
        </form>
    </div> -->
    <div class="version" id="version-ruangadmin"></div>
    <?php include('config/scripts.php') ?>
</body>

</html>