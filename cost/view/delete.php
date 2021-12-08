<?php
require_once("../../uservelidation.php");
require_once("../../connect_db.php");

$cost_id = $_GET["cost_id"];
// Delete Cost
$sql = "DELETE FROM cost WHERE id='$cost_id'";
if (mysqli_query($conn, $sql)) {
    echo "Cost deleted successfully";
    $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("Cost deleted successfully");
                                        }, 500); 
                                     </script>';
} else {
    echo "Error deleting Payment record: " . mysqli_error($conn);
    $_SESSION["msg"] = '<script>
                                        window.setTimeout(function(){
                                            alert("Failed to delete Cost");
                                        }, 500); 
                                     </script>';
}
header('location: inputDate.php');

?>