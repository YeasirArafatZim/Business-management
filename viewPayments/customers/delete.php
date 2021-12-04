<?php
require_once("../../uservelidation.php");
require_once("../../connect_db.php");

$pay_id = $_GET["pay_id"];
$sql = "select * from customer_payment where id = '$pay_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$cid = $row['cid'];
$sell_id = $row['sell_id'];
$amount = $row['amount'];

if($sell_id == '-10'){
    // Update Customer_previous_due 
    $sql = "select * from customer_previous_due where cid = '$cid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $nAmount = $row["due"] + $amount;

    $sql = "update customer_previous_due set due = '$nAmount' where cid = '$cid'";
    if (mysqli_query($conn, $sql)) {
        echo "Customer_previous_due updated successfully";
      } else {
        echo "Error updating Customer_previous_due record: " . mysqli_error($conn);
    }

}else{
    // Update Sell
    $sql = "select * from sell where id = '$sell_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sDue = $row['due'] + $amount;

    $sql = "update sell set due = '$sDue' where id = '$sell_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Sell Updated successfully";
    } else {
        echo "Error updating Sell's record: " . mysqli_error($conn);
    }
}

// Update Customers
$sql = "select paid, due from customers where phn_no = '$cid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$nDue =  $row["due"] + $amount;
$nPaid = $row["paid"] - $amount;

$sql = "update customers set paid='$nPaid', due='$nDue' where phn_no='$cid'";
if (mysqli_query($conn, $sql)) {
    echo "Customer's Record updated successfully";
} else {
    echo "Error updating customer's record: " . mysqli_error($conn);
}

// Delete Customer payment 
$sql = "DELETE FROM customer_payment WHERE id='$pay_id'";
if (mysqli_query($conn, $sql)) {
    echo "Customer Payment Record deleted successfully";
} else {
    echo "Error deleting Payment record: " . mysqli_error($conn);
}


?>