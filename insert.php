<?php
require_once('connect.php');
$un= $_POST['username'];
$sn= $_POST['surname'];
$cn= $_POST['company'];
$dm= $_POST['device'];
$statusarray = array("Offline", "Online");
$os= array_rand(array_flip($statusarray), 1);
mysql_query("INSERT INTO clientdbs (username, surname, company, device, status) VALUES ('$un', '$sn', '$cn', '$dm', '$os')");
header("location:home.php?action");
?>