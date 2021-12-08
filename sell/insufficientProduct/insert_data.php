<?php
    require_once("../../uservelidation.php");
	require_once("../../connect_db.php");

    

	if(isset($_POST["submit"])){

        $pid = $_SESSION["pid"];
        $pname = $_SESSION["productName"];
        $price = $_SESSION["productPrice"];
        $qnt = $_SESSION["productQnt"];
        $pkt = $_SESSION["productPkt"];
        $c_phn = $_SESSION["c_phn"];
        $c_amount = $_SESSION["c_amount"];
        $cDue = $price*$qnt - $c_amount;


        $qnt2 = $_SESSION['qnt2'];
	    $pkt2 = $_SESSION['pkt2'];
        $pid2 = $_SESSION['pid2'];

        
        $qnt1 = $qnt - $qnt2;
        $pkt1 = $pkt - $pkt2;


        $sql = "select * from customers where phn_no = '$c_phn'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) == 0) {
            $cname = $_SESSION["c_name"];
		    $address = $_SESSION["address"];

            // Add Customer
            $sql = "INSERT INTO customers VALUES ('$c_phn', '$cname', '$address', '0', '0', '0')";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }

        // Add Sell
        $sql = "INSERT INTO sell VALUES (DEFAULT, '$pid','$c_phn','$qnt1', '$pkt1','$price', CURRENT_TIMESTAMP, '$cDue' )";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }else{
            $sell_id1 = mysqli_insert_id($conn);
        }
        $sql = "INSERT INTO sell VALUES (DEFAULT, '$pid2','$c_phn','$qnt2', '$pkt2','$price', CURRENT_TIMESTAMP, '0' )";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }else{
            $sell_id2 = mysqli_insert_id($conn);
        }

        // Update Stock
        $sql = "SELECT * FROM stock WHERE pid = '$pid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        $q = $row["quantity"];
        $p = $row["packet"];
        $n_q = $q - $qnt1;
        $n_p = $p - $pkt1;

        $sql = "UPDATE stock SET quantity = '$n_q', packet = '$n_p' WHERE id = '$id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: ". sql . "<br>" . mysqli_error($conn);
        }

        $sql = "SELECT * FROM stock WHERE pid = '$pid2'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        $q = $row["quantity"];
        $p = $row["packet"];
        $n_q = $q - $qnt2;
        $n_p = $p - $pkt2;

        $sql = "UPDATE stock SET quantity = '$n_q', packet = '$n_p' WHERE id = '$id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: ". sql . "<br>" . mysqli_error($conn);
        }

        // Add Profit
        $sql = "SELECT * FROM products WHERE id = '$pid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $profit = ($price - $row["price"]) * $qnt1;

        $sql = "INSERT INTO profit VALUES (DEFAULT, '$pid','$c_phn', CURRENT_TIMESTAMP, '$profit', '$sell_id1' )";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $sql = "SELECT * FROM products WHERE id = '$pid2'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $profit = ($price - $row["price"]) * $qnt2;

        $sql = "INSERT INTO profit VALUES (DEFAULT, '$pid2','$c_phn', CURRENT_TIMESTAMP, '$profit', '$sell_id2' )";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Add Customer payment
        if($c_amount > 0 ){
            $sql = "INSERT INTO customer_payment VALUES (DEFAULT, '$c_phn','$c_amount', CURRENT_TIMESTAMP, '$sell_id1' )";
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