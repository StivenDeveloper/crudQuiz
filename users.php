<?php
session_start();
if ($_SESSION['validate'] != true) {
    header('Location: login.php');
}

include_once('config/conection.php');
require('config/modal_general.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo '<script>
            document.addEventListener("DOMContentLoaded", function () {
                    callModal("Usuario eliminado correctamente","users.php");
            });
        </script>';
    $e = crud::delete($id);
  
}

$nameSession=$_SESSION['name'];
$p = crud::Selectdata();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('config/head.php') ?>
    <title>Document</title>
</head>

<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar (Barra lateral izquirda) -->
        <?php include_once("config/sidebar.php"); ?>
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- TopBar (Barra de navegación) -->
            <?php include_once("config/topbar.php"); ?>
            <!-- Topbar -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                if (count($p) > 0) {
                                    for ($i = 0; $i < count($p); $i++) {
                                        echo '<tr>';
                                        foreach ($p[$i] as $key => $value) {
                                            if ($key != 'id') {
                                                echo '<td>' . $value . '</td>';
                                            }
                                        }
                                ?>

                                        <td><a id="delete" href="users.php?id=<?php echo $p[$i]['id'] ?>"><i class="bi bi-trash-fill"></i></a></td>
                                        <td><a href="upDate.php?id_up=<?php echo $p[$i]['id'] ?>"><i class="bi bi-pencil-square"></i></a></td>
                                <?php
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include('config/scripts.php') ?>
    <?php include('config/dataTable.php') ?>
</body>

</html>