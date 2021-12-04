<?php
    require_once("../../uservelidation.php");
	require_once("../../connect_db.php");

	if(isset($_POST["submit"]) && isset($_SESSION["s_phn"])){

        $s_phn = $_SESSION["s_phn"];
        $p_amount = $_SESSION["p_amount"];
        $purchaseId = $_SESSION['purchase_id'];
        
        if($p_amount > 0 ){
            // Insert Seller Payment
            $sql = "INSERT INTO seller_payment VALUES (DEFAULT, '$s_phn','$p_amount', CURRENT_TIMESTAMP, '$purchaseId' )";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        // Update Purchase
        $sql = "select due from purchase where id = '$purchaseId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $c_due = $row['due'];
        $n_due = $row['due']-$p_amount;

        $sql = "UPDATE purchase SET due = '$n_due' WHERE id = '$purchaseId'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating purchase: " . mysqli_error($conn);
        }
        

        // Update Customer
        $sql = "SELECT paid, due FROM sellers WHERE phn_no = '$s_phn'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $paid = $row["paid"];
        $due = $row["due"];

        $new_paid = $paid + $p_amount;
        $new_due = $due - $p_amount;

        $sql = "UPDATE sellers SET paid = '$new_paid', due = '$new_due' WHERE phn_no = '$s_phn'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
            echo $_SESSION["msg"] = '<script">
                                        window.setTimeout(function(){
                                            alert("Payment not successfully added.");
                                        }, 500); 
                                    </script>';
                header('location: sellerPayment.php');
            }else{
                $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("Payment Successfully Added");
                                        }, 500); 
                                    </script>';


                unset($_SESSION['s_phn']);
                unset($_SESSION['p_amount']);
                header('location: sellerPayment.php');

            }


    }else if(isset($_POST["close"])){
        header("Location: sellerPayment.php");
    }

?>