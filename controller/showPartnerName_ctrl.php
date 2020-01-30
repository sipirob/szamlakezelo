<?php

include_once '../model/partner.php';
$partnerid=$_GET['partnerid'];

$partner=new Partner();
echo $partner->getPartnerName($partnerid);
