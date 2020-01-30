<?php

require_once '../model/partner.php';

$firmname = $_POST['firmname'];
$adress = $_POST['adress'];
$taxnumber = $_POST['taxnumber'];
$contactname = $_POST['contactname'];
$telnumber = $_POST['telnumber'];
$comment = $_POST['comment'];
$partner = new Partner();
$partner->partnerreg($firmname, $adress, $taxnumber, $contactname, $telnumber, $comment);









