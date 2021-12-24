<?php
require_once("../../uservelidation.php");
require_once("../../connect_db.php");

$s_phn = $_GET["s_phn"];
$date = $_GET['date'];
$date = date("Y-m-d",strtotime($date));
$temp_date = strtotime("1 day", strtotime($date));
$enDate = date("Y-m-d", $temp_date);


$sql = "select * from seller_payment where sid='$s_phn' and date between '$date' and '$enDate'";
$result1 = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result1)){

    $sid = $s_phn;
    $pur_id = $row['pur_id'];
    $amount = $row['amount'];
    $pay_id = $row['id'];

    echo $pay_id . '  '. $amount . '  ' . $sid . '  '. $pur_id . '<br>';
    if($pur_id == '-10'){
        // Update seller_previous_due
        $sql = "select * from seller_previous_due where sid = '$sid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $nAmount = $row["due"] + $amount;

        $sql = "update seller_previous_due set due = '$nAmount' where sid = '$sid'";
        if (mysqli_query($conn, $sql)) {
            echo "seller_previous_due updated successfully";
        } else {
            echo "Error updating seller_previous_due record: " . mysqli_error($conn);
        }

    }else{
        // Update Purchase
        $sql = "select * from purchase where id = '$pur_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $sDue = $row['due'] + $amount;

        $sql = "update purchase set due = '$sDue' where id = '$pur_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Purchase Updated successfully";
        } else {
            echo "Error updating Purchased's record: " . mysqli_error($conn);
        }
    }

    // Update Sellers
    $sql = "select paid, due from sellers where phn_no = '$sid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $nDue =  $row["due"] + $amount;
    $nPaid = $row["paid"] - $amount;

    $sql = "update sellers set paid='$nPaid', due='$nDue' where phn_no='$sid'";
    if (mysqli_query($conn, $sql)) {
        echo "Seller's Record updated successfully";
    } else {
        echo "Error updating Seller's record: " . mysqli_error($conn);
    }

    // Delete Seller payment 
    $sql = "DELETE FROM seller_payment WHERE id='$pay_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Seller Payment Record deleted successfully";
        $_SESSION["msg"] = '<script>
                                            window.setTimeout(function(){
                                                alert("Seller\'s Payment Successfully Deleted");
                                            }, 500); 
                                        </script>';
    } else {
        echo "Error deleting Seller Payment record: " . mysqli_error($conn);
        $_SESSION["msg"] = '<script>
                                            window.setTimeout(function(){
                                                alert("Failed to Delete Seller\'s Payment");
                                            }, 500); 
                                        </script>';
    }

}

 header('location: inputDate.php');
?>