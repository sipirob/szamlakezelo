<?php

include_once '../model/partner.php';

$partnerid=$_POST['partnerid'];
$partnername=$_POST['partnername'];
$partneradress=$_POST['partneradress'];
$partnertax=$_POST['partnertax'];
$partnertel=$_POST['partnertel'];
$partnercontact=$_POST['partnercontact'];
$partnercomment=$_POST['partnercomment'];

$partner=new Partner();
$partner->editPartner($partnerid,$partnername,$partneradress,$partnertax,$partnercontact,$partnertel,$partnercomment);

