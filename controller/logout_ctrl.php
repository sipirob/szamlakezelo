<?php

function logOutUser(){
    session_start();
    session_destroy();
    header('Location:../index.php');
}

