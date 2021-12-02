<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$phn = $_GET['p'];

require_once("../../uservelidation.php");
require_once("../../connect_db.php");

$sql="SELECT purchase.id as id, purchase.due as due, purchase.date as date , products.name as name from purchase inner join products on purchase.pid=products.id where products.sid = '$phn' order by purchase.due desc ";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
?>
<div class="row mt-3 mx-2">
    <div class="col-md-12 position-static">
        <label for="paid_amount">Select a Due</label><br>
                                    
        <select style="widht:100%;" name="productName" id="productName" required>
            <option value="" disabled selected>--Select a Purchase--</option>
                    <?php
                        
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)){
                                if($row["due"] > 0){
                                    $date = strtotime($row['date']);
                                    $date = date("j M,Y  h:i A", $date);
                                ?>
                                    <option value= <?php echo $row["id"] ?>> <?php echo $row["due"]; ?>tk &nbsp;&nbsp;&nbsp;  (<?php echo $date; ?>) &nbsp;&nbsp;&nbsp;(<?php echo $row["name"];?> ) </option>
                    <?php  }} ?>
        </select>
    </div>
</div>

<div class="row mt-3 mx-2">
    <div class="col-md-12 position-static">
        <label for="paid_amount">Paid Amount</label><br>
        <input type="number" min="0" step="0.1" placeholder="amount paid to the seller" id="paid_amount" name="paid_amount" required><br>
    </div>
</div>


<?php
}
mysqli_close($conn);
?>
</body>
</html>