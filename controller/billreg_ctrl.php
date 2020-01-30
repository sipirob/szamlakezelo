<?php
include_once '../model/bill.php';

$billnumb=$_POST['billnumb'];
$billdate=$_POST['billdate'];
$deadline=$_POST['deadline'];
$paytype=$_POST['paytype'];
$netto=$_POST['netto'];
$brutto=$netto*1.27;
$billregdate=$_POST['billregdate'];
$partnername=$_POST['partnername'];

$bill= new Bill();
$bill->uploadBill($billnumb,$billdate,$deadline,$paytype,$netto,$brutto,$billregdate,$partnername);