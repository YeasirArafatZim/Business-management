<?php
	require_once("../uservelidation.php");
	require_once("../connect_db.php");
	$currentPage = "stock";

    $sql = "SELECT sum(stock.quantity*products.price) as result from stock inner join products on stock.pid=products.id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total = $row['result'];

?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="index, follow" />
	<title>মুণি ট্রেডার্স &#8211;Stock </title>


	<!-- SideBar Links -->
	<link rel='stylesheet' id='doro-themify-icons-css' href='../css/themify-icons76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-bootstrap-css' href='../css/bootstrap76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-style-css' href='../css/style76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-style-dark-css' href='../css/style-dark76f3.css?ver=5.7.3' type='text/css' media='all' />
	<link rel='stylesheet' id='doro-scrollbar-css' href='../css/scrollbar76f3.css?ver=5.7.3' type='text/css' media='all' />
	<script type='text/javascript' src='../js/jquery.min9d52.js?ver=3.5.1' id='jquery-core-js'></script>

	<!-- Style  -->
	<link rel="stylesheet" href="../css/style.css">

	<!-- Font awesome  -->
	<script src="https://kit.fontawesome.com/6a7e053e4e.js" crossorigin="anonymous"></script>

    <style>
        #myInput {
            background-image: url('../img/search.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
}
    </style>

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
						<h3 class="banner-top-text text-light">STOCK</h3>
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
                <div class="px-3 mb-3 text-center">
                    <h4 style="font-weight:bold; display: inline">Total Stock: </h4>
                    <h4 id="tProfit" style="font-weight:bold; color:#4BB543; display: inline"><?php echo $total; ?> </h4>
                    <h4 style="font-weight:bold; display: inline">tk</h4>
                </div>
                <div class="px-3 table-responsive">
                    <input type="text" id="myInput" onkeyup="mySearchFunction()" placeholder="Search for products..">
                    <table id="myTable" class="table table-striped borderless table-bordered">
                        <thead class="table-dark">
                            <tr>
                            <th style="text-align:center" scope="col">#</th>
                            <th style="text-align:center" scope="col">Product Name</th>
                            <th style="text-align:center" scope="col">Quantity (kg)</th>
                            <th style="text-align:center" scope="col">Packet</th>
                            <th style="text-align:center" scope="col">Seller Mobile</th>
                            <th style="text-align:center" scope="col">Seller Name</th>
                            <th style="text-align:center" scope="col">Unit Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                                $sql = "SELECT stock.pid as pid, stock.quantity as quantity, stock.packet as packet, products.name as name, products.price as price, sellers.phn_no as s_phn, sellers.name as s_name  FROM stock INNER JOIN products ON stock.pid=products.id INNER JOIN sellers on products.sid=sellers.phn_no where stock.quantity > 0 order by products.name";
                                $result = mysqli_query($conn, $sql);
                                $i = 1;

                                if ($result && mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while($row = mysqli_fetch_assoc($result)) {
                                        
                                        $pid = $row["pid"];
                                        $qnt = $row["quantity"];
                                        $pkt = $row["packet"];
                                        $name = $row["name"];
                                        $price = $row["price"];
                                        $s_phn = $row["s_phn"];
                                        $s_name = $row["s_name"];
                                                                       
                            ?>

                            <tr>
                                <th style="text-align:center" scope="row"><?php echo $i++;  ?></th>
                                <td style="font-weight: bold; color: black; text-align:center"><?php echo $name  ?></td>
                                <td style="color: black; text-align:center"><?php echo $qnt  ?></td>
                                <td style="color: black; text-align:center"><?php echo $pkt ?></td>
                                <td style="color: black; text-align:center"><?php echo $s_phn ?></td>
                                <td style="color: black; text-align:center"><?php echo $s_name  ?></td>
                                <td style="font-weight: bold; color: green; text-align:center"><?php echo $price  ?><sub style="color:gray;">ট</sub></td>
                            </tr>

                            <?php     }}      ?>
                            
                        </tbody>
                    </table>
                
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

        function mySearchFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td1 = tr[i].getElementsByTagName("td")[3];
                td2 = tr[i].getElementsByTagName("td")[4];
                if (td || td1) {
                    txtValue = td.textContent || td.innerText;
                    txtValue1 = td1.textContent || td1.innerText;
                    txtValue2 = td2.textContent || td2.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1  ) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
</script>
	
</body>
</html>
