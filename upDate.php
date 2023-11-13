<?php

session_start();
if ($_SESSION['validate'] != true) {
    header('Location: login.php');
}

$nameSession=$_SESSION['name'];
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
    if (isset($_GET['id_up'])) {
        $id_up = $_GET['id_up'];
        $data = crud::userDataPerId($id_up);
    }
    if (isset($_POST['signUP_button'])) {
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (!empty($_POST['name']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password'])) {

            $p = crud::conect()->prepare('UPDATE crudtable SET name=:n,lastName=:l,email=:e,pass=:p where id=:id');
            $p->bindValue(':id', $id_up);
            $p->bindValue(':n', $name);
            $p->bindValue(':l', $lastName);
            $p->bindValue(':e', $email);
            $p->bindValue(':p', $password);
            $p->execute();
            echo '<script>
                document.addEventListener("DOMContentLoaded", function () {
                    callModal("Usuario actualizado correctamente","users.php","modal-general");
                });
                </script>';
        }
    }


    ?>

    <div id="wrapper">
        <!-- Sidebar (Barra lateral izquirda) -->
        <?php include_once("config/sidebar.php"); ?>
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- TopBar (Barra de navegación) -->
            <?php include_once("config/topbar.php"); ?>
            <!-- Topbar -->

            <div class="col-lg-10">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Form Basic</h6>
                    </div>
                    <div class="card-body">
                        <form action="upDate.php?id_up=<?php echo $data['id'] ?>" method="post">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php if (isset($data)) {
                                                                                                                        echo $data['name'];
                                                                                                                    } ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Apellido</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="lastName" value="<?php if (isset($data)) {
                                                                                                                                echo $data['lastName'];
                                                                                                                            } ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword">Correo</label>
                                <input type="email" class="form-control" id="exampleInputPassword1" name="email" value="<?php if (isset($data)) {
                                                                                                                            echo $data['email'];
                                                                                                                        } ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword">Correo</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="password" value="<?php if (isset($data)) {
                                                                                                                                echo $data['pass'];
                                                                                                                            } ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="signUP_button">Actulizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php include('config/scripts.php') ?>
</body>

</html>