<?php
require_once("../../uservelidation.php");
require_once("../../connect_db.php");

$id = $_GET["id"];


$sql = "select * from mishuk_give where id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$amount = $row['amount'];
$phn = $row['phn_no'];

// Update mishuk
$sql = "select amount from mishuk where phn_no = '$phn'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$new_amount =  $row["amount"] - $amount;

$sql = "update mishuk set amount='$new_amount' where phn_no='$phn'";
if (mysqli_query($conn, $sql)) {
    echo "Mishuk Record updated successfully";
} else {
    echo "Error updating Mishuk's record: " . mysqli_error($conn);
}

// Delete Mishuk_give payment 
$sql = "DELETE FROM mishuk_give WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    echo "Mishuk_give Record deleted successfully";
    $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("Mishuk\'s Payment Successfully Deleted");
                                        }, 500); 
                                    </script>';
} else {
    echo "Error deleting Customer Payment record: " . mysqli_error($conn);
    $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("Failed to Delete Mishuk\'s Payment");
                                        }, 500); 
                                    </script>';
}

 header('location: inputDate.php');
?>