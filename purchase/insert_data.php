<?php
    require_once("../uservelidation.php");
	require_once("../connect_db.php");

	if(isset($_POST["submit"]) && isset($_SESSION["pname"])){

        $pname = $_SESSION["pname"];
        $price = $_SESSION["pprice"];
        $qnt = $_SESSION["qnt"];
        $pkt = $_SESSION["pkt"];
        $s_phn = $_SESSION["s_phn"];
        $p_amount = $_SESSION["amount"];


        $sql = "SELECT * FROM products WHERE name = '$pname' and price = '$price' and sid = '$s_phn'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // Product already inserted add purchase
            $row = mysqli_fetch_assoc($result);
            $pid = $row["id"];

            // Add Purchase
            $sql = "INSERT INTO purchase VALUES (DEFAULT, '$pid','$qnt', '$pkt','$price', CURRENT_TIMESTAMP )";
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
            $n_q = $q + $qnt;
            $n_p = $p + $pkt;

            $sql = "UPDATE stock SET quantity = '$n_q', packet = '$n_p' WHERE id = '$id'";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: ". sql . "<br>" . mysqli_error($conn);
            }


            
            if($p_amount > 0 ){
                // Insert Seller_Payment
                $sql = "INSERT INTO seller_payment VALUES (DEFAULT, '$s_phn','$p_amount', CURRENT_TIMESTAMP )";
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
                echo "Error: ". sql . "<br>" . mysqli_error($conn);
                $_SESSION["msg"] = '<script">
                                        window.setTimeout(function(){
                                            alert("Please fill up the form first");
                                        }, 500); 
                                    </script>';
                header('location: index.php');
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

                header('location: index.php');

            }



        }else{
            // check seller is inserted or not
            $sql = "SELECT * FROM sellers WHERE phn_no = '$s_phn'";
            $r1 = mysqli_query($conn, $sql);

            if ($r1 && mysqli_num_rows($r1) > 0) {
                // if seller is already added

                // Add Product
                $sql = "INSERT INTO products VALUES (DEFAULT, '$s_phn','$pname', '$price' )";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                // get product id
                $sql = "SELECT id FROM products WHERE name = '$pname' and price = '$price' and sid = '$s_phn'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $pid = $row["id"];


                // Add Stock
                $sql = "INSERT INTO stock VALUES (DEFAULT, '$pid','$qnt', '$pkt' )";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                // Add Purchase
                $sql = "INSERT INTO purchase VALUES (DEFAULT, '$pid','$qnt', '$pkt','$price', CURRENT_TIMESTAMP )";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                
                if($p_amount > 0 ){
                    // Insert Seller Payment
                    $sql = "INSERT INTO seller_payment VALUES (DEFAULT, '$s_phn','$p_amount', CURRENT_TIMESTAMP )";
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
                        header('location: index.php');
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
                    header('location: index.php');
    
                }


            }
            else{   // if seller not added
                // Add seller
                // Add product
                // Add stock

                header("Location: add_seller/add_seller.php");

            }

            

        }


    }else if(isset($_POST["close"])){
        header("Location: index.php");
    }

?>