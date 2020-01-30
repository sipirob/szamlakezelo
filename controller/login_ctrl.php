<?php
include_once 'model/user.php';

           $username=$_POST['username'];
           $password=$_POST['password'];
           $user=new User();
           return $user->login($username,$password);
       
 



