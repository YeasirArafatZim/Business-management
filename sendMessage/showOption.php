<!DOCTYPE html>
<html>
<head>
   
</head>
<body>

<?php
require_once("../uservelidation.php");
require_once("../connect_db.php");

$phn = $_GET['p'];
$_SESSION['phn_message'] = $phn;

$sql="SELECT * from customers where phn_no = '$phn'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$tCost = $row['cost'];
$tDue = $row['due'];

if (mysqli_num_rows($result) > 0) {
?>

<div class="row mt-3 mx-2">
    <div class="col-md-12 position-static">
    <label>Name:</label></br>
    <input type="text" value="<?php echo $name;?>" id="name" readonly/>
    </div>
</div>
<div class="row mt-3 mx-2">
    <div class="col-md-12 position-static">
    <label>Total Cost</label></br>
    <input type="text" style="color:green;" value="<?php echo $tCost; ?>" id="tCost" name="tCost" readonly/>
    </div>
</div>
<div class="row mt-3 mx-2">
    <div class="col-md-12 position-static">
    <label>Total Due</label></br>
    <input type="text" id="tDue" name="tDue" style="color:red;" value="<?php echo $tDue; ?>" readonly/>
    </div>
</div>

<div class="row mt-3 mx-2">
    <div class="col-md-12 position-static">
    <label>Date:</label></br>
    <input style="width:100%" type="date" onchange="totalPay(this.value)" value="" name="date" id="date"  required>
    </div>
</div>


<div id="tPay">

</div>


<?php
}else{ ?>
    <div class="row mt-3 mx-2">
    <div class="col-md-12 position-static text-center">
        <label style="color:red;">Customer not found</label></br>
    </div>
</div>
<?php
}
mysqli_close($conn);
?>

</body>
</html>
