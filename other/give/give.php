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
	<title>মুণি ট্রেডার্স &#8211; Give </title>


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
						<h3 class="banner-top-text text-light">Money Given</h3>
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

			<?php

				$sql = "SELECT amount from mishuk where phn_no = '01711713781'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$tDue = $row['amount'];
			?>
			<!-- Default Page -->
			<div class="container" style="padding-top: 80px">

                <div style="text-align:center; font-weight:bold">
                    <h3 style="font-weight:bold">Give Money to Cash</h3>
                </div>

                <form action="verify_data.php" method="post">
                    <div class="box mt-3 mx-auto" style="width:70%;">

						<div class="row mt-3 mx-2">
							<div class="col-md-12 position-static">
								<label for="amount">Amount&nbsp;</label><label style="color:red; float:right;">Total Due: <?php echo $tDue ?></label><br>
								<input type="number" min="0" max='<?php echo $tDue; ?>' step="0.1" placeholder="Amount paid to Mishuk bhai" id="amount" name="amount" required><br>
							</div>
						</div>

						
                        <br/>
                    </div>

                    <div style="text-align:center">
                        <input type="submit" value="Submit" name="submit" class="btnSuccess">
                    </div>
                    
                </form>



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