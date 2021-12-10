<?php
    require_once("../../uservelidation.php");
	require_once("../../connect_db.php");

	if(isset($_POST["submit"]) && isset($_SESSION["c_phn"])){

        $c_phn = $_SESSION["c_phn"];
        $c_amount = $_SESSION["c_amount"];
        $sell_id = $_SESSION['sell_id'];
        
        
        if($c_amount > 0 && $sell_id >= '0'){
            // Insert Customer Payment
            $sql = "INSERT INTO customer_payment VALUES (DEFAULT, '$c_phn','$c_amount', CURRENT_TIMESTAMP, '$sell_id' )";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            // Update sells due
            $sql = "SELECT due FROM sell WHERE id = '$sell_id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $due = $row["due"];
            $due = $due - $c_amount;
            $sql = "UPDATE sell SET due = '$due' WHERE id = '$sell_id'";
            if (!mysqli_query($conn, $sql)) {
                echo "Error updating due in sell table: " . mysqli_error($conn);
            }
        }


        if($c_amount > 0 && $sell_id == '-10'){

            // Update Customer previous due
            $sql = "select * from customer_previous_due where cid = '$c_phn'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $pDue = $row["due"];
            $nDue = $pDue - $c_amount;

            $sql = "UPDATE customer_previous_due SET due = '$nDue' WHERE cid = '$c_phn'";
            if (!mysqli_query($conn, $sql)) {
                echo "Error updating Customer_previous_due record: " . mysqli_error($conn);
            }

            // Insert Customer Payment
            $sql = "INSERT INTO customer_payment VALUES (DEFAULT, '$c_phn','$c_amount', CURRENT_TIMESTAMP, '$sell_id' )";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }

        

        // Update Customer
        $sql = "SELECT cost,paid, due FROM customers WHERE phn_no = '$c_phn'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $cost = $row["cost"];
        $paid = $row["paid"];
        $due = $row["due"];

        $new_paid = $paid + $c_amount;
        $new_due = $due - $c_amount;

        $sql = "UPDATE customers SET paid = '$new_paid', due = '$new_due' WHERE phn_no = '$c_phn'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
            $_SESSION["msg"] = '<script">
                                        window.setTimeout(function(){
                                            alert("Payment not successfully added.");
                                        }, 500); 
                                    </script>';
                header('location: customerPayment.php');
            }else{
                $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("Payment Successfully Added");
                                        }, 500); 
                                    </script>';


                unset($_SESSION['c_phn']);
                unset($_SESSION['c_amount']);
                header('location: customerPayment.php');

            }


    }else if(isset($_POST["close"])){
        header("Location: customerPayment.php");
    }

?>