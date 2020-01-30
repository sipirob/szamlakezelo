<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Szamlakezelo</title>
        <link rel="stylesheet" type="text/css" href="Style/cssHome.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--        navigációs sáv-->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
            <a class="navbar-brand" href="#">Logo</a>
            <ul class="navbar-nav mr-auto">

            </ul>


        </nav>
        <!--borítókép-->
        <form method="POST">
            <div  class="container-fluid thumbnail img-responsive img-fluid">

                <div class="row ">
                    <div  class="col-lg-6">

                        <h1 id="brandname">Üdvözöljük a számlakezelő rendszerében</h1>
                        <p id="alcim">Számlái kezeléséhez lépjen be</p>

                    </div>
                    <div class="col-lg-6">
                        <input class="form-control mr-sm-2" type="text" placeholder="Felhasználónév" name="username"><br>
                        <input class="form-control mr-sm-2" type="password"  placeholder="Jelszó" name="password"><br>

                        <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            //unset($_SESSION['message']);
                        }
                        ?>

                        <button type="submit" id="loginbtn"  class="btn btn-success btn-lg" name="loginbtn">Belépés</button>

                    </div>
                </div>

            </div>
        </form>
        <?php
        if (isset($_POST['loginbtn'])) {
            require_once 'controller/login_ctrl.php';
        }
        ?>
    </body>
</html>
