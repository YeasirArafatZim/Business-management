<?php
    $pid = $_GET['p'];
    $q = $_GET['q'];

    require_once("../uservelidation.php");
    require_once("../connect_db.php");

    $sql="select * from stock where pid = '$pid'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $qnt = $row['quantity'];
    $pkt = $row['packet'];

    $perPkt = $qnt/$pkt;

    echo intval($q/$perPkt);



?>