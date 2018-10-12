<?php
require_once('connect.php');
$idp= $_GET['id'];
mysql_query("delete  FROM clientdbs where id=$idp");
header("location:home.php?action");
?>