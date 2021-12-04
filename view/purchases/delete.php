<?php
require_once("../../uservelidation.php");
require_once("../../connect_db.php");

$pur_id = $_GET["pur_id"];

// Checking if this product sold or not
$sql = "select * from purchase inner join sell on purchase.pid = sell.pid where purchase.id = '$pur_id'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
  // You cannot delete this purchase 
  echo "Delete related sell first";
}else{
    // You can delete this purchase

    // Update Seller
  $sql = "select purchase.due as due, purchase.quantity as quantity, purchase.price as price, purchase.packet as packet, purchase.pid as pid, products.sid as sid from purchase INNER JOIN products on purchase.pid = products.id where purchase.id = '$pur_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $sdue = $row["due"];
  $qnt = $row["quantity"];
  $pkt = $row["packet"];
  $pid = $row["pid"];
  $sTotal = $row["quantity"]*$row["price"];
  $sid = $row["sid"];

  $sql = "select cost, paid, due from sellers where phn_no = '$sid'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $nCost = $row["cost"] - $sTotal;
  $nDue =  $row["due"] - $sdue;
  $nPaid = $row["paid"] - ($sTotal - $sdue);

  $sql = "update sellers set cost='$nCost', paid='$nPaid', due='$nDue' where phn_no='$sid'";
  if (mysqli_query($conn, $sql)) {
      echo "Seller's Record updated successfully";
  }else {
      echo "Error updating seller's record: " . mysqli_error($conn);
  }


  // Delete Seller Payment
  $sql = "DELETE FROM seller_payment WHERE pur_id='$pur_id'";
  if (mysqli_query($conn, $sql)) {
      echo "Seller Payment Record deleted successfully";
  } else {
      echo "Error deleting Seller Payment record: " . mysqli_error($conn);
  }

  // Update Stock
  $sql = "select quantity, packet from stock where pid='$pid'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $nQnt = $row["quantity"] - $qnt;
  $nPkt = $row["packet"] - $pkt;

  $sql = "update stock set quantity='$nQnt', packet='$nPkt' where pid='$pid'";
  if (mysqli_query($conn, $sql)) {
      echo "Stock updated successfully";
  } else {
      echo "Error updating Stock record: " . mysqli_error($conn);
  }

  // Delete Purchase
  $sql = "DELETE FROM purchase WHERE id='$pur_id'";
  if (mysqli_query($conn, $sql)) {
      echo "Sell deleted successfully";
  } else {
      echo "Error deleting Sell record: " . mysqli_error($conn);
  }
}





?>