
<!DOCTYPE html>
<?php
require_once '../controller/logout_ctrl.php';
?>
<?php
session_start();
if (isset($_SESSION['id'])) {
    // header('Location: ../view/homeIn.php');
} else {
    header('Location: ../index.php');
}
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Szamlakezelo</title>
        <link rel="stylesheet" type="text/css" href="../Style/cssHome.css">
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/functions.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--        navigációs sáv-->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
            <a class="navbar-brand" href="#">Logo</a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="billreg" class="nav-link" href="#">Számla rögzítése</a>
                </li>
                <li class="nav-item">
                    <a  id="partnerreg" href="#" class="nav-link" >Partner rögzítése</a>
                </li>
                <li class="nav-item">
                    <a id="bills" class="nav-link" href="#">Számlák</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" name="partners" id="partners">Partnerek</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0" method="post">
                <button name="logout" class="btn btn-success" type="submit">Kilépés</button>
            </form>

        </nav>

        <form id="content"  >

        </form>
<?php
//        kijelentkezés
if (isset($_POST['logout'])) {
    logOutUser();
}
require_once 'modal.php';
?>
        <form id="delForm" name="delForm">
            <!-- Delete modal -->
            <div class="modal" id="deleteModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Partner törlése</h4>

                        </div>

                        <!-- Modal body -->
                        <div class="modal-body" id="delmodalcontent">

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Mégse</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal" id="partnerDelBtn">Törlés</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <!--        update modal-->
        <form id="editForm" name="editForm">

            <div class="modal" id="editModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Partner adatainak módosítása</h4>

                        </div>

                        <!-- Modal body -->
                        <div class="modal-body" id="editmodalcontent">

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Mégse</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal" id="partnerEditBtn">Módosít</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </body>
</html>

