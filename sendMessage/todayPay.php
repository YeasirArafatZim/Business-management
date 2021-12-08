<?php
    require_once("../uservelidation.php");
    require_once("../connect_db.php");
    $date = $_GET['date'];
    $temp_date = strtotime("1 day", strtotime($date));
    $enDate = date("Y-m-d", $temp_date);

    $phn = $_SESSION['phn_message'];

    $sql = "SELECT sum(amount) as tamount from customer_payment where cid = '$phn' and date between '$date' and '$enDate'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $tamount = $row["tamount"];
    if(!isset($tamount)){
        $tamount = "0";
    }
?>

<div class="row mt-3 mx-2">
    <div class="col-md-12 position-static">
    <label>Today's Payment</label></br>
    <input type="text" id="paid" name="paid" value="<?php echo $tamount; ?>" style="color:green;" readonly/>
    <!-- <p id="tPay">Hello</p> -->
    </div>
</div>