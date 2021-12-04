<?php
    require_once("../../uservelidation.php");
	require_once("../../connect_db.php");

	if(isset($_POST["submit"])){

        $phn = $_SESSION['phn'];
        $name = $_SESSION['name'];
        $add = $_SESSION['add'];
        $due = $_SESSION['due'];
        
        // Insert Customer
        $sql = "INSERT INTO customers VALUES ('$phn','$name','$add', '$due', '0', '$due')";
        if (!mysqli_query($conn, $sql)) {
            echo "Error inserting into customers:" . $sql . "<br>" . mysqli_error($conn);
        }else{
                $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("New Customer added Successful");
                                        }, 500); 
                                    </script>';
                header('location: newCustomer.php');
        }


    }else if(isset($_POST["close"])){
        header("Location: newCustomer.php");
    }

?>