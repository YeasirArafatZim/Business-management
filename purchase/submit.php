<?php
	require_once("../uservelidation.php");
	require_once("../connect_db.php");

	if(isset($_POST["submit"])){
		$pname = $_POST["pname"];
		$price = $_POST["pprice"];
		$qnt = $_POST["pqnt"];
		$pkt = $_POST["ppkt"];
		$s_phn = $_POST["s_phn"];
        $p_amount = $_POST["paid_amount"];
        $cost = $_POST["cost"];

        $_SESSION['cost'] = $cost;
        $_SESSION["pname"] = $pname;
        $_SESSION["pprice"] = $price;
        $_SESSION["qnt"] = $qnt;
        $_SESSION["pkt"] = $pkt;
        $_SESSION["s_phn"] = $s_phn;
        $_SESSION["amount"] = $p_amount;


        $sql = "SELECT * FROM products WHERE name = '$pname' and price = '$price' and sid = '$s_phn'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // Product already inserted add purchase
            
            header("Location: verify_data.php");


        }else{
            // check seller is inserted or not
            $sql = "SELECT * FROM sellers WHERE phn_no = '$s_phn'";
            $r1 = mysqli_query($conn, $sql);

            if ($r1 && mysqli_num_rows($r1) > 0) {
                // if seller is already added
                header("Location: verify_data.php");
                


            }
            else{   // if seller not added
                // Add seller
                // Add product
                // Add stock
                

                header("Location: add_seller/add_seller.php");

            }

        }

	}
?>