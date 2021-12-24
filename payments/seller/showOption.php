<!DOCTYPE html>
<html>
<head>
</head>
<body>


<?php
    $phn = $_GET['p'];

    require_once("../../uservelidation.php");
    require_once("../../connect_db.php");
    $sql = "SELECT due from sellers where phn_no = '$phn' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $tDue = $row['due'];

        // $sql = "SELECT due from seller_previous_due where sid = '$phn'";
        // $result = mysqli_query($conn, $sql);
        // if(mysqli_num_rows($result) > 0){
        //     $row = mysqli_fetch_assoc($result);
        //     $tDue = $tDue + $row['due'];
        // }
?>

<div class="row mt-3 mx-2">
    <div class="col-md-12 position-static">
        <label for="paid_amount">Paid Amount&nbsp;</label><label style="color:red; float:right;">Total Due: <?php echo $tDue ?></label><br>
        <input type="number" onchange="showAmount(this.value)" min="0" max='<?php echo $tDue; ?>' step="0.1" placeholder="amount paid to the seller" id="paid_amount" name="paid_amount" required><br>
    </div>
</div>

<?php

    $sql="SELECT phn_no from sellers where phn_no = '$phn'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
?>
<div class="row mt-3 mx-2">
    <div class="col-md-12 position-static">
        <label for="paid_amount">Select a Due&nbsp;&nbsp;&nbsp;</label> <label id="leftDue" style="color:red;float:right;"></label><br>
                                    
        <select style="widht:100%;" onchange="minusAmount()" name="productName[]" id="productName" multiple="multiple" required >
            <option value="" disabled selected>--Select a Purchase--</option>
                    <?php
                        $sql="SELECT purchase.id as id, purchase.due as due, purchase.date as date , products.name as name from purchase inner join products on purchase.pid=products.id where products.sid = '$phn' order by purchase.due desc ";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result) > 0) {
                        
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)){
                                if($row["due"] > 0){
                                    $date = strtotime($row['date']);
                                    $date = date("j M,Y  h:i A", $date);
                                ?>
                                    <option value= '{"id":"<?php echo $row["id"] ?>", "due":"<?php echo $row['due'];?>"}'> <?php echo $row["due"]; ?>tk &nbsp;&nbsp;&nbsp;  (<?php echo $date; ?>) &nbsp;&nbsp;&nbsp;(<?php echo $row["name"];?> ) </option>
                        <?php  }}}
                        $sql = "select * from seller_previous_due where sid = '$phn'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if($row["due"] > 0){
                    ?>
                    <option value= '{"id":"-10", "due":"<?php echo $row['due'];?>"}'> Previous Due Payment &nbsp;&nbsp;&nbsp; ( <?php echo $row["due"]; ?>tk )</option>
                    <?php } ?>
        </select>
    </div>
</div>


<?php
    }}
mysqli_close($conn);
?>
</body>
</html>