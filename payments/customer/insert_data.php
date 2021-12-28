<?php
    require_once("../../uservelidation.php");
	require_once("../../connect_db.php");

	if(isset($_POST["submit"]) && isset($_SESSION["c_phn"])){

        $c_phn = $_SESSION["c_phn"];
        $amount = $_SESSION["c_amount"];
        $sell_id = $_SESSION['sell_id'];
        $temp_amount = $amount;

        foreach($sell_id as $id){
            $i = json_decode($id)->id;

            if($i >= '0'){
                $sql = "SELECT * from sell where id = '$i' ";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $cDue = $row['due'];
            }else{
                $sql = "SELECT * from customer_previous_due where cid = '$c_phn' ";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $cDue = $row['due'];
            }
            
            if($temp_amount >= $cDue){
                $p_amount = $cDue;
                $temp_amount = $temp_amount - $cDue;
            }else{
                $p_amount = $temp_amount;
                $temp_amount = 0;
            }

        
            if($p_amount > 0 && $i >= '0'){
                // Insert Customer Payment
                $sql = "INSERT INTO customer_payment VALUES (DEFAULT, '$c_phn','$p_amount', CURRENT_TIMESTAMP, '$i' )";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                // Update Sell
                $sql = "select due from sell where id = '$i'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $c_due = $row['due'];
                $n_due = $row['due']-$p_amount;

                $sql = "UPDATE sell SET due = '$n_due' WHERE id = '$i'";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error updating purchase: " . mysqli_error($conn);
                }
            }

            if($p_amount > 0 && $i == '-10'){

                // Update Customer previous due
                $sql = "select * from customer_previous_due where cid = '$c_phn'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $pDue = $row["due"];
                $nDue = $pDue - $p_amount;

                $sql = "UPDATE customer_previous_due SET due = '$nDue' WHERE cid = '$c_phn'";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error updating seller_previous_due record: " . mysqli_error($conn);
                }

                // Insert Customer Payment
                $sql = "INSERT INTO customer_payment VALUES (DEFAULT, '$c_phn','$p_amount', CURRENT_TIMESTAMP, '$i' )";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

            }
        }

        // Update Customer
        $sql = "SELECT paid, due FROM customers WHERE phn_no = '$c_phn'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $paid = $row["paid"];
        $due = $row["due"];

        $new_paid = $paid + $amount;
        $new_due = $due - $amount;

        $sql = "UPDATE customers SET paid = '$new_paid', due = '$new_due' WHERE phn_no = '$c_phn'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
            $_SESSION["msg"] = '<script">
                                        window.setTimeout(function(){
                                            alert("Payment not successfully added.");
                                        }, 500); 
                                    </script>';
            header("Location: customerPayment.php");
        }else{
            $_SESSION["msg"] = '<script>
                                    window.setTimeout(function(){
                                        alert("Customer Payment Successfully Added");
                                    }, 500); 
                                </script>';


            unset($_SESSION['c_phn']);
            unset($_SESSION['c_amount']);
            unset($_SESSION['sell_id']);
            header("Location: customerPayment.php");
            }

    }else if(isset($_POST["close"])){
        header("Location: customerPayment.php");
    }

?>