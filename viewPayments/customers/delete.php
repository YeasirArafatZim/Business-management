<?php
require_once("../../uservelidation.php");
require_once("../../connect_db.php");

$c_phn = $_GET["c_phn"];
$date = $_GET['date'];
$date = date("Y-m-d",strtotime($date));
$temp_date = strtotime("1 day", strtotime($date));
$enDate = date("Y-m-d", $temp_date);


$sql = "select * from customer_payment where cid='$c_phn' and date between '$date' and '$enDate'";
$result1 = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result1)){

    $cid = $c_phn;
    $sell_id = $row['sell_id'];
    $amount = $row['amount'];
    $pay_id = $row['id'];

    if($sell_id == '-10'){
        // Update seller_previous_due
        $sql = "select * from customer_previous_due where cid = '$cid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $nAmount = $row["due"] + $amount;

        $sql = "update customer_previous_due set due = '$nAmount' where cid = '$cid'";
        if (mysqli_query($conn, $sql)) {
            echo "customer_previous_due updated successfully";
        } else {
            echo "Error updating customer_previous_due record: " . mysqli_error($conn);
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
        echo "Customers Record updated successfully";
    } else {
        echo "Error updating Customers record: " . mysqli_error($conn);
    }

    // Delete Customer payment 
    $sql = "DELETE FROM customer_payment WHERE id='$pay_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Customer Payment Record deleted successfully";
        $_SESSION["msg"] = '<script>
                                            window.setTimeout(function(){
                                                alert("Customer\'s Payment Successfully Deleted");
                                            }, 500); 
                                        </script>';
    } else {
        echo "Error deleting Customer Payment record: " . mysqli_error($conn);
        $_SESSION["msg"] = '<script>
                                            window.setTimeout(function(){
                                                alert("Failed to Delete Customer\'s Payment");
                                            }, 500); 
                                        </script>';
    }

}

 header('location: inputDate.php');
?>