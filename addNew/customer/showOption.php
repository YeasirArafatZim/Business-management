<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$phn = $_GET['p'];

require_once("../../uservelidation.php");
require_once("../../connect_db.php");

$sql="SELECT * from customers where phn_no = '$phn'";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) == 0) {
?>
    <div class="row mt-3 mx-2">
        <div class="col-md-12 position-static">
            <label for="pqnt">Name</label><br>
            <input type="text" placeholder="customer's name*" id="c_name" name="c_name" required>
        </div>
    </div>

    <div class="row mt-3 mx-2">
        <div class="col-md-12 position-static">
            <label for="s_phn">Address</label><br>
            <input type="text" placeholder="customer's address*" id="address" name="address" required><br>
        </div>
    </div>

    <div class="row mt-3 mx-2">
        <div class="col-md-12 position-static">
            <label for="s_phn">Previous Due</label><br>
            <input type="number" min="0" step="0.1" placeholder="Customer's previous due" id="due" name="due" required><br>
        </div>
    </div>

<?php
}else{
?>

<div class="row mt-3 mx-2">
        <div class="col-md-12 position-static text-center">
            <label for="s_phn" style="color:red;">This Customer is already added</label><br>
            
        </div>
</div>

<?php
}
mysqli_close($conn);
?>
</body>
</html>