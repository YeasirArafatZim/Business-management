<?php
	require_once("../uservelidation.php");
	require_once("../connect_db.php");
	$currentPage = "home";

	$sql = "select sum(profit) as tProfit from profit";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$tProfit = $row['tProfit'];

	$sql = "select sum(quantity*price) as result from sell";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sells = $row['result'];

	$sql = "select sum(due) as dues from customers";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$dues = $row['dues'];

	$sql = "select sum(quantity*price) as result from purchase";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$purchases = $row['result'];

	$sql = "select count(phn_no) as result from sellers";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sellers = $row['result'];

	$sql = "select count(phn_no) as result from customers";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$customers = $row['result'];
	
?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="index, follow" />
	<title>মুণি ট্রেডার্স &#8211;Dashboard </title>


	<!-- SideBar Links -->
	<link rel='stylesheet' id='doro-themify-icons-css' href='../css/themify-icons76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-bootstrap-css' href='../css/bootstrap76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-style-css' href='../css/style76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-style-dark-css' href='../css/style-dark76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-scrollbar-css' href='../css/scrollbar76f3.css?ver=5.7.3' type='text/css' media='all' />
	<script type='text/javascript' src='../js/jquery.min9d52.js?ver=3.5.1' id='jquery-core-js'></script>

	<!-- Style  -->
	<link rel="stylesheet" href="..//css/style.css">

	<!-- Font awesome  -->
	<script src="https://kit.fontawesome.com/6a7e053e4e.js" crossorigin="anonymous"></script>

</head>

<body class="home page-template-default page page-id-158 wpb-js-composer js-comp-ver-6.6.0 vc_responsive">

	<div id="doro-page"> <a href="#" class="js-doro-nav-toggle doro-nav-toggle"><i></i></a>
		<!-- Sidebar Section -->
		<?php
			require_once("../side_bar.php");
		?>

		<!-- Main Section -->
		<div id="doro-main">

			<!-- Heading  -->
			<div class="banner-top">
				<div class="row">
					<div class="col-md-3 col-sm-4 col-6 mg">
						<h3 class="banner-top-text text-light">DASHBOARD</h3>
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
			<div class="container" style="padding-top: 140px">


				<div class="row pb-5 ml-2">
					<div class="col position-static">
						<div class="card text-white bg-success mb-3 position-static" style="max-width: 18rem;">
							<div class="card-header" style="font-size:20px">Profits</div>
							<div class="card-body">
								<h5 class="card-title" style="color:black">Total Profit</h5>
								<p class="card-text" style="color:white; font-size:18px;font-weight:bold"><?php echo $tProfit; ?></p>
							</div>
						</div>
					</div>

					<div class="col position-static">
						<div class="card text-white bg-primary mb-3 position-static" style="max-width: 18rem;">
							<div class="card-header" style="font-size:20px">Sells</div>
							<div class="card-body">
								<h5 class="card-title" style="color:black">Total Sell</h5>
								<p class="card-text" style="color:white; font-size:18px;font-weight:bold"><?php echo $sells; ?></p>
							</div>
						</div>
					</div>

					<div class="col position-static">
						<div class="card text-white bg-danger mb-3 position-static" style="max-width: 18rem;">
							<div class="card-header" style="font-size:20px">Dues</div>
							<div class="card-body">
								<h5 class="card-title" style="color:black">Total Due</h5>
								<p class="card-text" style="color:white; font-size:18px;font-weight:bold"><?php echo $dues; ?></p>
							</div>
						</div>
					</div>
				</div>

			
				<div class="row ml-2">
					<div class="col position-static">
						<div class="card text-white bg-warning mb-3 position-static" style="max-width: 18rem;">
							<div class="card-header" style="font-size:20px">Purchases</div>
							<div class="card-body">
								<h5 class="card-title" style="color:black">Total Purchase</h5>
								<p class="card-text" style="color:white; font-size:18px;font-weight:bold"><?php echo $purchases; ?></p>
							</div>
						</div>
					</div>

					<div class="col position-static">
						<div class="card text-white bg-secondary mb-3 position-static" style="max-width: 18rem;">
							<div class="card-header" style="font-size:20px">Sellers</div>
							<div class="card-body">
								<h5 class="card-title" style="color:black">Total Seller</h5>
								<p class="card-text" style="color:white; font-size:18px;font-weight:bold"><?php echo $sellers; ?></p>
							</div>
						</div>
					</div>

					<div class="col position-static">
						<div class="card text-white bg-info mb-3 position-static" style="max-width: 18rem;">
							<div class="card-header" style="font-size:20px">Customers</div>
							<div class="card-body">
								<h5 class="card-title" style="color:black">Total Customer</h5>
								<p class="card-text" style="color:white; font-size:18px;font-weight:bold"><?php echo $customers; ?></p>
							</div>
						</div>
					</div>
				</div>



			<!-- Footer -->
			<div id="footer">
				
			</div>


		</div>
	</div>
	<!-- Main end -->

	<!-- SideBar Scripts -->
	<script type='text/javascript' src='../js/waypoints-min5152.js?ver=1.0' id='waypoints-min-js'></script>
	<script type='text/javascript' src='../js/main5152.js?ver=1.0' id='doro-main-js'></script>
	<script>
        const logout = () => location.replace("../logout.php");
    </script>
	
</body>
</html>
