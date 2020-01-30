<?php

include_once '../model/bill.php';

$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$partnername=$_POST['partnername'];
$condition=$_POST['condition'];

$bill= new Bill();
echo $bill->getAllBills($fromdate,$todate,$partnername,$condition);