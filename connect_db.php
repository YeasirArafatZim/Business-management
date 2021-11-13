<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fish_db";
    
        // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

        // Set Default time
    date_default_timezone_set("Asia/Dhaka");
    
        // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
?>