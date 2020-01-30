<?php

session_start();
include_once 'dbh.php';

class User extends Dbh {

    public function login($username, $password) {
        $sql = "SELECT * FROM user WHERE felhasznalonev = '$username' AND jelszo = '$password'";
        $stmt = $this->connect()->query($sql);
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            $_SESSION['id'] = $row['0'];
            header('Location: view/homeIn.php');
        } else {
            //echo 'helytelen felhasználónév vagy jelszó';
            $_SESSION['message'] = 'helytelen felhasználónév vagy jelszó';
        }
    }

}
