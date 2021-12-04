<?php
	require_once("../../uservelidation.php");
	require_once("../../connect_db.php");
    $currentPage = "payment";
    $result = "";
	if(isset($_POST["submit"])){
		$phn = $_POST["c_phn"];
        $_SESSION['phn'] = $phn;
        if(isset($_POST["c_name"])){
            $name = $_POST["c_name"];
            $_SESSION['name'] = $name;
        }
		if(isset($_POST["address"])){
            $add = $_POST["address"];
            $_SESSION['add'] = $add;
        }
        if(isset($_POST["due"])){
            $due = $_POST["due"];
        $_SESSION['due'] = $due;
        }
		
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
						<h3 class="banner-top-text text-light">Customer's Payment</h3>
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
			<div class="container px-5 boxWidth">
				<div class="box verify_top px-5 pb-0 mb-4 mt-2" style="background-color: #f9e284;margin-left:20%; margin-right:20%;">
                    <p class="verify_head">Verify Before Submit</p>
                </div>

                <div class="box mt-3 px-5 py-3">
                    <?php   
                        if(isset($_POST["c_name"])){
                    ?>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Cutomer's Mobile No: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php $c_phn = substr($phn,5);
                                        $c_phn = str_split($phn, $split_length = 5);
                                        echo $c_phn[0]."-".$c_phn[1].$c_phn[2];?></p>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Customer's Name: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $name;?></p>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Customer's Address: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $add;?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_label">Due amount: </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 position-static">
                            <p class="verify_data"><?php echo $due;?></p>
                        </div>
                    </div>
                    
                    <?php
                        }else{
                    
                    ?>
                    
                    <p class="text-center mb-2 mt-2" style="font-size:20px; color: red">This customer is already added</p>
                    
                    <?php } ?>
                </div>

                <?php   
                    if(isset($_POST["c_name"])){
                ?>
                <div class="box verify_top px-5 pb-0 mt-3 mx-5" style="background-color: #FFD9D9;">
                    <p class="verify_head">You cannot make changes after submitting the form.</p>
                </div>
                <?php } ?>

                <div style="text-align:center">
                    <form action="insert_data.php" method="post">
                        <input style="margin-right:30px" class="btn_close" type="submit" value="Close" name="close">
                        <?php  if(isset($_POST["c_name"])){ ?>
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
