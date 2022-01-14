<?php
	require_once("../../uservelidation.php");
	require_once("../../connect_db.php");
    $currentPage = "other";
?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="index, follow" />
	<title>মুণি ট্রেডার্স &#8211; Recieved Money </title>


	<!-- SideBar Links -->
	<link rel='stylesheet' id='doro-themify-icons-css' href='../../css/themify-icons76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-bootstrap-css' href='../../css/bootstrap76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-style-css' href='../../css/style76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-style-dark-css' href='../../css/style-dark76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-scrollbar-css' href='../../css/scrollbar76f3.css?ver=5.7.3' type='text/css' media='all' />
	<script type='text/javascript' src='../../js/jquery.min9d52.js?ver=3.5.1' id='jquery-core-js'></script>

	<!-- Style  -->
	<link rel="stylesheet" href="../../css/style.css">

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
						<h3 class="banner-top-text text-light">Recieved Money</h3>
					</div>
					<div class="col-md-6 col-sm-7 col-6  only-icon">
						<button onclick="logout()" class="btn"><i class="fas fa-sign-out-alt"></i></button>
						<button class="btn"> <i class="fas fa-user"></i></button>
					</div>
					<div class="col-md-5 col-sm-4 with-icon">
						<button onclick="logout()" class="btn"><i class="fas fa-sign-out-alt"> LogOut</i></button>
						<button class="btn"> <i class="fas fa-user"></i> Profile</button>
					</div>
				</div>
			</div>

		
			<!-- Default Page -->
			<div class="container" style="padding-top: 80px;">

				<div style="margin-top: 5%;">
					<h4 style="font-weight: bold; text-align:center">Select Dates</h4>
				

				<form action="takeDetails.php" method="post">
					<div class="box row mx-5 py-5">
						<div class = "px-3 pb-4 col" style="text-align:center">
							<label>Start Date:</label></br>
							<input type="date" value="<?php date_default_timezone_set('Asia/Dhaka'); echo date('Y-m-d')  ?>" name="sdate" id="sdate"  >
						</div>
						<div class = "px-3 pb-4 col" style="text-align:center">
							<label>End Date:</label></br>
							<input type="date" value="<?php date_default_timezone_set('Asia/Dhaka'); echo date('Y-m-d')  ?>" name="edate" id="edate"  >
						</div>
					</div>
					<div style="text-align:center">
						<input type="submit" name="submit" value="Submit">
					</div>
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
<?php  
		if(isset($_SESSION["msg"] )){
			echo $_SESSION["msg"];
			unset($_SESSION["msg"]);
		}
?>