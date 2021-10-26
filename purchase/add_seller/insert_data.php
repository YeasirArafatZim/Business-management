<?php
    require_once("../../uservelidation.php");
	require_once("../../connect_db.php");

	if(isset($_POST["submit"]) && isset($_SESSION["pname"])){

        $pname = $_SESSION["pname"];
        $price = $_SESSION["pprice"];
        $qnt = $_SESSION["qnt"];
        $pkt = $_SESSION["pkt"];
        $s_phn = $_SESSION["s_phn"];
        $p_amount = $_SESSION["amount"];
        $s_name = $_SESSION["s_name"];
        $address = $_SESSION["address"];

        // Add seller
        $sql = "INSERT INTO sellers VALUES ('$s_phn', '$s_name','$address', '0' ,'0', '0' )";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Add Product
        $sql = "INSERT INTO products VALUES ('', '$s_phn','$pname', '$price' )";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // get product id
        $sql = "SELECT id FROM products WHERE name = '$pname' and price = '$price' and sid = '$s_phn'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $pid = $row["id"];


        // Add Stock
        $sql = "INSERT INTO stock VALUES ('', '$pid','$qnt', '$pkt' )";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Add Purchase
        $sql = "INSERT INTO purchase VALUES ('', '$pid','$qnt', '$pkt','$price', CURRENT_TIMESTAMP )";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        
        if($p_amount > 0 ){
            // Insert Seller Payment
            $sql = "INSERT INTO seller_payment VALUES ('', '$s_phn','$p_amount', CURRENT_TIMESTAMP )";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        // Update Seller
        $sql = "SELECT cost, paid, due FROM sellers WHERE phn_no = '$s_phn'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $cost = $row["cost"];
        $paid = $row["paid"];
        $due = $row["due"];

        $new_cost = $cost + $qnt*$price;
        $new_paid = $paid + $p_amount;
        $new_due = $new_cost - $new_paid;

        $sql = "UPDATE sellers SET cost ='$new_cost', paid = '$new_paid', due = '$new_due' WHERE phn_no = '$s_phn'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
            echo $_SESSION["msg"] = '<script">
                                        window.setTimeout(function(){
                                            alert("Please fill up the form first");
                                        }, 500); 
                                    </script>';
                header('location: ../index.php');
            }else{
                $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("Successfully Added");
                                        }, 500); 
                                    </script>';


                unset($_SESSION['pname']);
                unset($_SESSION['pprice']);
                unset($_SESSION['qnt']);
                unset($_SESSION['pkt']);
                unset($_SESSION['s_phn']);
                unset($_SESSION['amount']);
                unset($_SESSION["s_name"]);
                unset($_SESSION["address"]);
                header('location: ../index.php');

            }


    }else if(isset($_POST["close"])){
        header("Location: ../index.php");
    }

?>