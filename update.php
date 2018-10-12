<?php
require_once('connect.php');
$idp= $_GET['id'];
$un= $_POST['username'];
$sn= $_POST['surname'];
$cn= $_POST['company'];
$dm= $_POST['device'];
$statusarray = array("Offline", "Online");
$os= array_rand(array_flip($statusarray), 1);
mysql_query("UPDATE clientdbs SET username='$un', surname='$sn', company='$cn', device='$dm', status='$os' where id=$idp");
header("location:home.php?action");
?>