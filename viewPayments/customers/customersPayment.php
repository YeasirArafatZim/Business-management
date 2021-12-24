<?php
	require_once("../../uservelidation.php");
	require_once("../../connect_db.php");
    $currentPage = "viewPayment";
	$tAmount = 0;

	if(isset($_POST["submit"])){
		$sDate = $_POST["sdate"];
		$eDate = $_POST["edate"];
		$temp_date = strtotime("1 day", strtotime($eDate));
		$enDate = date("Y-m-d", $temp_date);
	}
?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="index, follow" />
	<title>মুণি ট্রেডার্স &#8211; Seller payment </title>



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

	<style>
		#myInput {
            background-image: url('../../img/search.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 12px 40px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 25px;
			margin-left: 10px;
			
		}
		.hide-date{
			visibility: hidden;
		}
		#print-heading{
			display: none;
		}
		@media print{
			/* Hide every other element  */
			body * {
				visibility: hidden;
			}
			.hide-date{
				visibility: visible;
			}
			#print-heading{
				display: block;
			}

			/* Then displaying print container elements  */
			.print-container, .print-container * {
				visibility: visible;
			}
			.print-container{
				position: absolute;
				left: 0px;
				top: 0px;
				
				width: 100%;
				margin-left:auto;
				margin-right:auto;
			}
			
		}
		
	</style>

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
						<h3 class="banner-top-text text-light">CUSTOMERS_PAYMENT</h3>
					</div>
					<div class="col-md-6 col-sm-7 col-6  only-icon">
						<button class="btn" onclick="logout()"> <i class="fas fa-user"></i></button>
						<button class="btn"><i class="fas fa-sign-out-alt"></i></button>
					</div>
					<div class="col-md-5 col-sm-4 with-icon">
						<button onclick="logout()" class="btn"><i class="fas fa-sign-out-alt"> LogOut</i></button>
						<button class="btn"> <i class="fas fa-user"></i> Profile</button>
					</div>
				</div>
			</div>

		
			<!-- Default Page -->
			<div class="container" style="padding-top: 80px;">
				<div>
					<input type="text" id="myInput" onkeyup="mySearchFunction()" placeholder="Search here..">
				</div>
				<div class="px-3 mb-2">
				<button type="button" onclick="printDiv('print-container')" class="btn" style="background-color: #53C222;">Print</button>
				</div>
		
				<div class="print-container">
					<div id = "print-heading">
						<h3 style="text-align:center; font-weight: bold; margin-top:50px">Customers Payment</h3>
					</div>
					<div class="px-3 mb-3">
						<h4 style="font-weight:bold; display: inline">Total Payments: </h4>
						<h4 id="tAmount" style="font-weight:bold; color:#4BB543; display: inline">0 </h4>
						<h4 style="font-weight:bold; display: inline">tk</h4>

						<h6 id="print-date" class="hide-date" style="font-weight:bold; display: inline; float:right;"> <?php if($sDate == $eDate) {$d = date_create($sDate); echo date_format($d, "d-M-y");}else{$e = date_create($eDate); echo date_format($e, "d.M.y");} ?> </h6>
						<h6 class="hide-date" style="display: inline; float:right;"> <?php  if($sDate != $eDate){echo ' - ';} ?> </h6>
						<h6 id="print-date" class="hide-date" style="font-weight:bold; display: inline; float:right;"> <?php if($sDate != $eDate) {$s = date_create($sDate); echo date_format($s, "d.M.y");} ?> </h6>
						<h6 class="hide-date" style="display: inline; float:right;">Date: </h6>					
					</div>
						

					<div class="px-3 table-responsive">
						<!-- <input type="text" id="myInput" onkeyup="mySearchFunction()" placeholder="Search for products.." title="Type in a name"> -->
						<table id="myTable" class="table table-striped borderless table-bordered">
							<thead class="table-dark">
								<tr>
									<th class="text-center" scope="col">#</th>
									<th class="text-center" scope="col">Mobile No</th>
									<th class="text-center" scope="col">Name</th>
									<th class="text-center" scope="col">Date</th>
									<th class="text-center" scope="col">Time</th>
									<th class="text-center" scope="col">Amount</th>
									<th class="text-center" scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								
								<?php  
									$sql = "SELECT id,cid, date, amount, name  FROM customer_payment INNER JOIN customers ON customer_payment.cid=customers.phn_no where customer_payment.date between '$sDate' and '$enDate' order by customer_payment.date desc";
									$result = mysqli_query($conn, $sql);
									$i = 1;

									if ($result && mysqli_num_rows($result) > 0) {
										// output data of each row
										while($row = mysqli_fetch_assoc($result)) {
											$pay_id = $row["id"];
											$name = $row["name"];
											$phn = $row["cid"];
											$dateTime = $row["date"];
											$date = date("d-M-Y",strtotime($dateTime));
											$time = date("h:i A", strtotime($dateTime));
											$amount = $row["amount"];
											$tAmount += $amount;
																		
								?>

								<tr>
									<th class="text-center" scope="row"><?php echo $i++;  ?></th>
									<td class="text-center" style="color: black; font-weight: bold;"><?php echo $phn  ?></td>
									<td class="text-center" style="color: black;"><?php echo $name  ?></td>
									<td class="text-center" style="color: black;"><?php echo $date  ?></td>
									<td class="text-center" style="color: black;"><?php echo $time  ?></td>
									<td class="text-center" style="font-weight: bold; color: green;"><?php echo round($amount,2);  ?><sub style="color:gray;">ট</sub></td>
									<td class="text-center" > <button data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $pay_id;?>" style="margin: 0px; padding: 0px; background-color:white; cursor:pointer"><i class="fas fa-trash-alt fa-lg" style="color:red; background-color:white"></i></button> </td>
								</tr>

								<!-- Modal -->
								<div class="modal fade" id="exampleModal<?php echo $pay_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel" style="font-weight:bold">Delete Sell</h5>
											<button type="button" style="background-color:white; color:black; cursor:pointer; margin:0px; padding: 0px " data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times fa-lg"></i></button>
										</div>
										<div class="modal-body" style="padding:0px; padding-top:18px">
											<h6 style="text-align:center; font-weight:bold; color:#cc0000">Are you sure you want to delete this sell?</h6>
										</div>
										<div class="modal-footer">
											<!-- <button type="button" style="background-color:gray" class="btn" data-bs-dismiss="modal">Close</button> -->
											<a class="btn" href="#" data-bs-dismiss="modal" style="background-color:gray">Close</a>
											<a href="delete.php?pay_id=<?php echo $pay_id;?>" class="btn" style="background-color:#ff1a1a">Delete</a>
										</div>
										</div>
									</div>
								</div>
								<!-- Modal End  -->

								<?php     }}      ?>
								
							</tbody>
						</table>
					
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
	<script type='text/javascript' src='../../js/waypoints-min5152.js?ver=1.0' id='waypoints-min-js'></script>
	<script type='text/javascript' src='../../js/main5152.js?ver=1.0' id='doro-main-js'></script>
	<script>
        const logout = () => location.replace("../../logout.php");
		document.getElementById("tAmount").innerHTML = "<?php echo round($tAmount,2) ?>";
		
		function printDiv(divName) {
			let printDiv = document.getElementsByClassName(divName)[0];
			var a = document.querySelector('body');
			a.removeChild(document.querySelector('#doro-page'));
			a.appendChild(printDiv);
			window.print();
		}

		function mySearchFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td1 = tr[i].getElementsByTagName("td")[1];
                if (td || td1) {
                    txtValue = td.textContent || td.innerText;
                    txtValue1 = td1.textContent || td1.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
		
    </script>

	<!-- Bootstrap for Modal  -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
