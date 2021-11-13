<?php
	require_once("../../uservelidation.php");
	require_once("../../connect_db.php");
    $currentPage = "payment";
    $result = "";
	if(isset($_POST["submit"])){
		
		$s_phn = $_POST["s_phn"];
		$p_amount = $_POST["paid_amount"];

        $_SESSION['s_phn'] = $s_phn;
        $_SESSION['p_amount'] = $p_amount;

        $sql = "SELECT * FROM sellers WHERE phn_no = '$s_phn'";
        $result = mysqli_query($conn, $sql);
		
	}
?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="index, follow" />
	<title>মুণি ট্রেডার্স &#8211; Payments </title>


	<!-- SideBar Links -->
	<link rel='stylesheet' id='doro-themify-icons-css' href='../../css/themify-icons76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-bootstrap-css' href='../../css/bootstrap76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-style-css' href='../../css/style76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-style-dark-css' href='../../css/style-dark76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-scrollbar-css' href='../../css/scrollbar76f3.css?ver=5.7.3' type='text/css' media='all' />
	<script type='text/javascript' src='../../js/jquery.min9d52.js?ver=3.5.1' id='jquery-core-js'></script>

	<!-- Style  -->
	<link rel="stylesheet" type="text/css" href="../../css/style.css" media='all'>
	<link rel="stylesheet" type="text/css" href="../../purchase/purchase_style.css" media='all'>

	<!-- Font awesome  -->
	<script src="https://kit.fontawesome.com/6a7e053e4e.js" crossorigin="anonymous"></script>



</head>

<body class="home page-template-default page page-id-158 wpb-js-composer js-comp-ver-6.6.0 vc_responsive">

	<div id="doro-page"> <a href="#" class="js-doro-nav-toggle doro-nav-toggle"><i></i></a>
		<!-- Sidebar Section -->
		<?php
			require_once("../../side_bar.php");
		?>

		<!-- Main Section -->
		<div id="doro-main">
			<!-- Heading  -->
			<div class="banner-top">
				<div class="row">
					<div class="col-md-3 col-sm-4 col-6 mg">
						<h3 class="banner-top-text">Seller's Payment</h3>
					</div>
					<div class="col-md-6 col-sm-7 col-6  only-icon">
						<button class="btn"> <i class="fas fa-user"></i></button>
						<button class="btn"><i class="fas fa-sign-out-alt"></i></button>
					</div>
					<div class="col-md-5 col-sm-4 with-icon">
						<button onclick="logout()" class="btn"><i class="fas fa-sign-out-alt"> LogOut</i></button>
						<button class="btn"> <i class="fas fa-user"></i> Profile</button>
					</div>
				</div>
			</div>



			<!-- Default Page -->
			<div class="container px-5 boxWidth">
				<div class="box verify_top px-5 pb-0 mb-4 mt-2" style="background-color: #f9e284;margin-left:20%; margin-right:20%;">
                    <p class="verify_head">Verify Before Submit</p>
                </div>

                <div class="box mt-3 px-5 py-3">
                    <?php if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);
                        $s_name = $row["name"];
                        $address = $row["address"];
                        
                    ?>
                        
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Cutomer's Mobile No: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php $phn = substr($s_phn,5);
                                        $phn = str_split($s_phn, $split_length = 5);
                                        echo $phn[0]."-".$phn[1].$phn[2];?></p>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Seller's Name: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $s_name?></p>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Seller's Address: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $address?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Paid amount: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $p_amount?></p>
                        </div>
                    </div>
                    <?php }else{ ?>

                        <h4 class="mx-auto text-center">You don't make any purchase from this Seller. Please check Mobile no.</h4>

                    <?php } ?>
                
                </div>

                <?php if(mysqli_num_rows($result) > 0){    ?>

                    <div class="box verify_top px-5 pb-0 mt-3 mx-5" style="background-color: #FFD9D9;">
                        <p class="verify_head">You cannot make changes after submitting the form.</p>
                    </div>
                <?php } ?>

                <div style="text-align:center">
                    <form action="insert_data.php" method="post">

                            <input style="margin-right:30px" class="btn_close" type="submit" value="Close" name="close">
                            <?php if(mysqli_num_rows($result) > 0){    ?>
                                <input type="submit" value="Submit" name="submit">
                            <?php } ?>
                        
                        
                    </form>
                </div>
                
			</div>



			<!-- Footer -->
			<div id="footer">
				
			</div>


		</div>
	</div>
	<!-- Main end -->

	<!-- SideBar Scripts -->
	<script type='text/javascript' src='../../js/waypoints-min5152.js?ver=1.0' id='waypoints-min-js'></script>
	<script type='text/javascript' src='../../js/main5152.js?ver=1.0' id='doro-main-js'></script>
    <script>
        const logout = () => location.replace("../../logout.php");
    </script>

	
</body>
</html>
