<?php
    require_once("../../uservelidation.php");
	require_once("../../connect_db.php");

	if(isset($_POST["submit"])){

        $phn = $_SESSION['phn'];
        $name = $_SESSION['name'];
        $add = $_SESSION['add'];
        $due = $_SESSION['due'];

        // Insert into seller_previous_due
        $sql = "INSERT INTO seller_previous_due VALUES ('$phn','$due', CURRENT_TIMESTAMP)";
        if (!mysqli_query($conn, $sql)) {
            echo "Error inserting into seller_previous_due:" . $sql . "<br>" . mysqli_error($conn);
        }
        
        // Insert Customer
        $sql = "INSERT INTO sellers VALUES ('$phn','$name','$add', '$due', '0', '$due')";
        if (!mysqli_query($conn, $sql)) {
            echo "Error inserting into Sellers:" . $sql . "<br>" . mysqli_error($conn);
        }else{
                $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("New Seller added Successful");
                                        }, 500); 
                                    </script>';
                header('location: newSeller.php');
        }


    }else if(isset($_POST["close"])){
        header("Location: newSeller.php");
    }

?>