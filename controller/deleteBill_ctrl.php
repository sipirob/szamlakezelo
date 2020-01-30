<?php

include_once '../model/bill.php';

$billid=$_GET['delBillId'];

$bill=new Bill();
$bill->deleteBill($billid);