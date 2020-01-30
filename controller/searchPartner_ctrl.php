<?php
require_once '../model/partner.php';

$firmname = $_POST['firm'];

$sqli = "SELECT * from partner where cegnev LIKE '$firmname%'";
$partner = new Partner();

echo $partner->getAllPartners($sqli);

