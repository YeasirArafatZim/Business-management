<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$phn = $_GET['p'];

require_once("../../uservelidation.php");
require_once("../../connect_db.php");

$sql="SELECT phn_no from customers where phn_no = '$phn'";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
?>
<div class="row mt-3 mx-2">
    <div class="col-md-12 position-static">
        <label for="paid_amount">Select a Due</label><br>
                                    
        <select style="widht:100%;" name="productName" id="productName" required>
            <option value="" disabled selected>--Select a Product--</option>
                    <?php
                        $sql="SELECT sell.id as id, sell.due as due,sell.date as date , products.name as name from sell inner join products on sell.pid=products.id where sell.cid = '$phn' order by sell.due desc ";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)){
                                if($row["due"] > 0){
                                    $date = strtotime($row['date']);
                                    $date = date("j M,Y  h:i A", $date);
                                ?>
                                    <option value= <?php echo $row["id"] ?>> <?php echo $row["due"]; ?>tk &nbsp;&nbsp;&nbsp;  (<?php echo $date; ?>) &nbsp;&nbsp;&nbsp;(<?php echo $row["name"];?> ) </option>
                    <?php  }}}
                        $sql = "select * from customer_previous_due where cid = '$phn'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if($row["due"] > 0){
                    ?>
                    <option value= "-10"> Previous Due Payment &nbsp;&nbsp;&nbsp; ( <?php echo $row["due"]; ?>tk )</option>
                    <?php } ?>
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