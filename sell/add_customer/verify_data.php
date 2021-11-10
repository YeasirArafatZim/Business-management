<?php
	require_once("../../uservelidation.php");
	require_once("../../connect_db.php");
	if(isset($_SESSION["productName"])){
		$pid = $_SESSION["pid"];
        $pname = $_SESSION["productName"];
        $price = $_SESSION["productPrice"];
        $qnt = $_SESSION["productQnt"];
        $pkt = $_SESSION["productPkt"];
        $c_phn = $_SESSION["c_phn"];
        $c_amount = $_SESSION["c_amount"];

		$c_name = $_POST["c_name"];
		$address = $_POST["address"];

		$_SESSION["c_name"] = $c_name;
		$_SESSION["address"]= $address;
	}
?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="index, follow" />
	<title>মুণি ট্রেডার্স &#8211;Admin Panel </title>


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
						<h3 class="banner-top-text">SELL</h3>
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
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Product Name: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $pname?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Unit Price: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $price?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Quantity (kg): </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $qnt?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">No of Packet: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $pkt?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Customer's Mobile No: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php $phn = substr($c_phn,5);
                                        $phn = str_split($c_phn, $split_length = 5);
                                        echo $phn[0]."-".$phn[1].$phn[2];?></p>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Customer's Name: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $c_name?></p>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Customer's Address: </p>
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
                            <p class="verify_data"><?php echo $c_amount?></p>
                        </div>
                    </div>

                
                </div>

                <div class="box verify_top px-5 pb-0 mt-3 mx-5" style="background-color: #FFD9D9;">
                    <p class="verify_head">You cannot make changes after submitting the form.</p>
                </div>

                <div style="text-align:center">
                    <form action="insert_data.php" method="post">

                            <input style="margin-right:30px" class="btn_close" type="submit" value="Close" name="close">
                            <input type="submit" value="Submit" name="submit">
                        
                        
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
