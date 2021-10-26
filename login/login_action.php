<?php
    require_once("../connect_db.php");

    $user_id = $_POST["phn"];
    $pwd = $_POST["user_pwd"];
    $pwd = md5($pwd);
    

    $sql = "SELECT * FROM admin WHERE phn_no = '$user_id' and user_pwd = '$pwd'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['user_id'] = $user_id;
        header("Location: ../home/");
    } else {
    ?>
            <script>
                
                alert("Wrong User Name or Password");
                location.replace("index.php");

            </script>
    <?php
    }
    mysqli_close($conn);
?>