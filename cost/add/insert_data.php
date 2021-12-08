<?php
	require_once("../../uservelidation.php");
	require_once("../../connect_db.php");
    $currentPage = "cost";

    $costName = $_SESSION['costName'];
    $amount = $_SESSION['amount'];
    
    if(isset($_POST["submit"])){
        $sql = "INSERT INTO cost VALUES (DEFAULT, '$costName','$amount', CURRENT_TIMESTAMP)";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: ". sql . "<br>" . mysqli_error($conn);
            $_SESSION["msg"] = '<script">
                                    window.setTimeout(function(){
                                        alert("Failed");
                                    }, 500); 
                                </script>';
            header('location: sell.php');
        }else{

            $_SESSION["msg"] = '<script>
                                    window.setTimeout(function(){
                                        alert("New cost added successfully");
                                    }, 500); 
                                </script>';
        }

        header("Location: newCost.php");

    }else if(isset($_POST["close"])){
        unset($_SESSION['costName']);
        unset($_SESSION['amount']);
        header("Location: newCost.php");
    }
?>