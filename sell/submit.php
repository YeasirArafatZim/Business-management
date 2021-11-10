<?php
	require_once("../uservelidation.php");
	require_once("../connect_db.php");

	if(isset($_POST["submit"])){
		$pid = $_POST["productName"];
		$price = $_POST["price"];
		$qnt = $_POST["qnt"];
		$pkt = $_POST["pkt"];
		$c_phn = $_POST["c_phn"];
        $c_amount = $_POST["paid_amount"];


        $_SESSION["pid"] = $pid;
        $_SESSION["productPrice"] = $price;
        $_SESSION["productQnt"] = $qnt;
        $_SESSION["productPkt"] = $pkt;
        $_SESSION["c_phn"] = $c_phn;
        $_SESSION["c_amount"] = $c_amount;

        $sql = "SELECT * FROM products WHERE id = '$pid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $_SESSION["productName"] = $row["name"];


        $sql = "SELECT * FROM stock WHERE pid = '$pid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $quantity = $row["quantity"];

        if($quantity >= $qnt){
            $sql = "SELECT * FROM customers WHERE phn_no = '$c_phn'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                // Customer already added
                header("Location: verify_data.php");


            }else{
                // Add customer
                header("Location: add_customer/add_customer.php");

            }

        }else{
            header("Location: insufficientProduct/insufficientProduct.php");
        }
    }

?>