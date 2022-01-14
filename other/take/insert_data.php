<?php
	require_once("../../uservelidation.php");
	require_once("../../connect_db.php");
    $currentPage = "other";

    $amount = $_SESSION['amount'];
    
    if(isset($_POST["submit"])){
        $sql = "INSERT INTO mishuk_give VALUES (DEFAULT, '01711713781', CURRENT_TIMESTAMP,'$amount')";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Update Mishuk
        $sql = "SELECT amount FROM mishuk WHERE phn_no = '01711713781'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $amnt = $row["amount"];

        $new_amnt = $amount + $amnt;

        $sql = "UPDATE mishuk SET amount = '$new_amnt' WHERE phn_no = '01711713781'";

        if (!mysqli_query($conn, $sql)) {
            echo "Error: ". sql . "<br>" . mysqli_error($conn);
            $_SESSION["msg"] = '<script">
                                    window.setTimeout(function(){
                                        alert("Failed");
                                    }, 500); 
                                </script>';
        }else{

            $_SESSION["msg"] = '<script>
                                    window.setTimeout(function(){
                                        alert("Recieved successfully");
                                    }, 500); 
                                </script>';
        }
        unset($_SESSION['amount']);
        header("Location: take.php");

    }else if(isset($_POST["close"])){
        unset($_SESSION['amount']);
        header("Location: take.php");
    }
?>