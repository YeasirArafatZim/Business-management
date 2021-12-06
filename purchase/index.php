<?php
	require_once("../uservelidation.php");
	require_once("../connect_db.php");
	$currentPage = "purchase";
?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="index, follow" />
	<title>মুণি ট্রেডার্স &#8211;Purchase </title>


	<!-- SideBar Links -->
	<link rel='stylesheet' id='doro-themify-icons-css' href='../css/themify-icons76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-bootstrap-css' href='../css/bootstrap76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-style-css' href='../css/style76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-style-dark-css' href='../css/style-dark76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-scrollbar-css' href='../css/scrollbar76f3.css?ver=5.7.3' type='text/css' media='all' />
	<script type='text/javascript' src='../js/jquery.min9d52.js?ver=3.5.1' id='jquery-core-js'></script>

	<!-- Style  -->
	<link rel="stylesheet" type="text/css" href="../css/style.css" media='all'>

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
						<h3 class="banner-top-text text-light">PURCHASE</h3>
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
			<div class="container px-5" style="padding-top: 80px;">

                <form action="submit.php" method="post">
                    <div class="box mt-3">
                        <div class="row mt-4 mx-1">
                            <div class="col-md-6 position-static">
                                <label for="pname">Product Name</label><br>
                                <input type="text" placeholder="product name" id="pname" name="pname" required>
                            </div>

                            <div class="col-md-6 position-static">
                                <label for="pprice">Unit Price</label><br>
                                <input type="number" min="0" step="0.1" placeholder="price /kg" id="price" name="pprice" required autocomplete="off"><br>
                            </div>
                        </div>

                        <div class="row mt-3 mx-2">
                            <div class="col-md-6 position-static">
                                <label for="pqnt">Quantity (kg)</label><br>
                                <input type="number" step="any" min="0" placeholder="product quantity in kg" id="qnt" name="pqnt" required>
                            </div>

                            <div class="col-md-6 position-static">
                                <label for="ppkt">No of Packet</label><br>
                                <input type="number" min="0" step="1" placeholder="no of packet" id="pkt" name="ppkt" required><br>
                            </div>
                        </div>

                        <div class="row mt-3 mx-2">
							<div class="col-md-6 position-static">
								<label for="s_phn">Seller's Mobile No</label><br>
                            	<input type="tel" pattern="[0]{1}[1]{1}[0-9]{9}" placeholder="format: 01758123578" id="s_phn" name="s_phn" required><br>
                            </div>

							<div class="col-md-6 position-static">
                                <label for="t_amount">Total Amount</label><br>
                                <input type="number" min="0" step="0.1" placeholder="total amount" id="t_amount" name="t_amount"><br>
                            </div> 
						</div>

						<div class="row mt-3 mx-2">
							<div class="col-md-6 position-static">
								<label for="cost">Transportation Cost</label><br>
								<input type="number" min="0" step="0.1" placeholder="transportation cost" id="cost" name="cost" required><br>
                            </div>
							<div class="col-md-6 position-static">
                                <label for="paid_amount">Paid Amount</label><br>
                                <input type="number" min="0" step="0.1" placeholder="amount paid to the seller" id="paid_amount" name="paid_amount" required><br>
                            </div>
						</div>


                        <br>
                    </div>

                    <div style="text-align:center">
                        <input type="submit" value="Submit" name="submit">
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
	<script type='text/javascript' src='../js/waypoints-min5152.js?ver=1.0' id='waypoints-min-js'></script>
	<script type='text/javascript' src='../js/main5152.js?ver=1.0' id='doro-main-js'></script>
    <script>
        const logout = () => location.replace("../logout.php");
    </script>

	
</body>
</html>

<?php  
		if(isset($_SESSION["msg"] )){
			echo $_SESSION["msg"];
			unset($_SESSION["msg"]);
		}
?>