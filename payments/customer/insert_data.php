<?php
    require_once("../../uservelidation.php");
	require_once("../../connect_db.php");

	if(isset($_POST["submit"]) && isset($_SESSION["c_phn"])){

        $c_phn = $_SESSION["c_phn"];
        $c_amount = $_SESSION["c_amount"];
        
        
        if($c_amount > 0 ){
            // Insert Customer Payment
            $sql = "INSERT INTO customer_payment VALUES ('', '$c_phn','$c_amount', CURRENT_TIMESTAMP )";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        // Update Customer
        $sql = "SELECT paid, due FROM customers WHERE phn_no = '$c_phn'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $paid = $row["paid"];
        $due = $row["due"];

        $new_paid = $paid + $c_amount;
        $new_due = $due - $c_amount;

        $sql = "UPDATE customers SET paid = '$new_paid', due = '$new_due' WHERE phn_no = '$c_phn'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
            echo $_SESSION["msg"] = '<script">
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