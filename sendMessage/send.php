<?php
require_once("../uservelidation.php");
require_once("../connect_db.php");
require_once("../customerMessage.php");

$phn = $_POST['c_phn'];
$cost = $_POST['tCost'];
$due = $_POST['tDue'];
$paid = $_POST['paid'];

sendCustomerMessage($phn, $cost, $paid, $due);
?>