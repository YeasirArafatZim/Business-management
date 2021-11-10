<?php
    require_once("../../uservelidation.php");
	require_once("../../connect_db.php");

    

	if(isset($_POST["submit"]) && isset($_SESSION["productName"])){

        $pid = $_SESSION["pid"];
        $pname = $_SESSION["productName"];
        $price = $_SESSION["productPrice"];
        $qnt = $_SESSION["productQnt"];
        $pkt = $_SESSION["productPkt"];
        $c_phn = $_SESSION["c_phn"];
        $c_amount = $_SESSION["c_amount"];

        $cname = $_SESSION["c_name"];
		$address = $_SESSION["address"];

        // Add Customer
        $sql = "INSERT INTO customers VALUES ('$c_phn', '$cname', '$address', '0', '0', '0')";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Add Sell
        $sql = "INSERT INTO sell VALUES ('', '$pid','$c_phn','$qnt', '$pkt','$price', CURRENT_TIMESTAMP )";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Update Stock
        $sql = "SELECT * FROM stock WHERE pid = '$pid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        $q = $row["quantity"];
        $p = $row["packet"];
        $n_q = $q - $qnt;
        $n_p = $p - $pkt;

        $sql = "UPDATE stock SET quantity = '$n_q', packet = '$n_p' WHERE id = '$id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: ". sql . "<br>" . mysqli_error($conn);
        }

        // Add Profit
        $sql = "SELECT * FROM products WHERE id = '$pid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $profit = ($price - $row["price"]) * $qnt;

        $sql = "INSERT INTO profit VALUES ('', '$pid','$c_phn', CURRENT_TIMESTAMP, '$profit' )";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Add Customer payment
        if($c_amount > 0 ){
            $sql = "INSERT INTO customer_payment VALUES ('', '$c_phn','$c_amount', CURRENT_TIMESTAMP )";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        // Update Customer
        $sql = "SELECT cost, paid, due FROM customers WHERE phn_no = '$c_phn'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $cost = $row["cost"];
        $paid = $row["paid"];
        $due = $row["due"];

        $new_cost = $cost + $qnt*$price;
        $new_paid = $paid + $c_amount;
        $new_due = $new_cost - $new_paid;

        $sql = "UPDATE customers SET cost ='$new_cost', paid = '$new_paid', due = '$new_due' WHERE phn_no = '$c_phn'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: ". sql . "<br>" . mysqli_error($conn);
            $_SESSION["msg"] = '<script">
                                    window.setTimeout(function(){
                                        alert("Please fill up the form first");
                                    }, 500); 
                                </script>';
            header('location: sell.php');
        }else{

            $_SESSION["msg"] = '<script>
                                    window.setTimeout(function(){
                                        alert("Successfully Added");
                                    }, 500); 
                                </script>';


            unset($_SESSION['pid']);
            unset($_SESSION['productName']);
            unset($_SESSION['productPrice']);
            unset($_SESSION['productQnt']);
            unset($_SESSION['productPkt']);
            unset($_SESSION['c_phn']);
            unset($_SESSION['c_amount']);
            unset($_SESSION['c_name']);
            unset($_SESSION['address']);

            header('location: ../sell.php');

            }



    }else if(isset($_POST["close"])){
        header("Location: ../sell.php");
    }

?>