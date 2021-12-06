<?php
require_once("../../uservelidation.php");
require_once("../../connect_db.php");

$sell_id = $_GET["sell_id"];

// Delete Profit 
$sql = "DELETE FROM profit WHERE sell_id='$sell_id'";
if (mysqli_query($conn, $sql)) {
    echo "Profit Record deleted successfully";
  } else {
    echo "Error deleting Profit record: " . mysqli_error($conn);
}

// Update Customer 
$sql = "select * from sell where id = '$sell_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sdue = $row["due"];
$qnt = $row["quantity"];
$pkt = $row["packet"];
$pid = $row["pid"];
$sTotal = $row["quantity"]*$row["price"];
$cid = $row["cid"];

$sql = "select cost, paid, due from customers where phn_no = '$cid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$nCost = $row["cost"] - $sTotal;
$nDue =  $row["due"] - $sdue;
$nPaid = $row["paid"] - ($sTotal - $sdue);

$sql = "update customers set cost='$nCost', paid='$nPaid', due='$nDue' where phn_no='$cid'";
if (mysqli_query($conn, $sql)) {
    echo "Customer's Record updated successfully";
  } else {
    echo "Error updating customer's record: " . mysqli_error($conn);
}


// Delete Payment
$sql = "DELETE FROM customer_payment WHERE sell_id='$sell_id'";
if (mysqli_query($conn, $sql)) {
    echo "Customer Payment Record deleted successfully";
  } else {
    echo "Error deleting Payment record: " . mysqli_error($conn);
}

// Update Stock
$sql = "select quantity, packet from stock where pid='$pid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$nQnt = $row["quantity"] + $qnt;
$nPkt = $row["packet"] + $pkt;

$sql = "update stock set quantity='$nQnt', packet='$nPkt' where pid='$pid'";
if (mysqli_query($conn, $sql)) {
    echo "Stock updated successfully";
  } else {
    echo "Error updating Stock record: " . mysqli_error($conn);
}

// Delete Sell
$sql = "DELETE FROM sell WHERE id='$sell_id'";
if (mysqli_query($conn, $sql)) {
    echo "Sell deleted successfully";
    $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("Successfully Sell Deleted");
                                        }, 500); 
                                     </script>';
  } else {
    echo "Error deleting Sell record: " . mysqli_error($conn);
    $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("Sell not Deleted");
                                        }, 500); 
                                     </script>';
}
header('location: inputDate.php');

?>