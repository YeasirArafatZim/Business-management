<!-- fonts  -->
<link href="https://fonts.maateen.me/charukola-ultra-light/font.css" rel="stylesheet">

<!-- Sidebar Section -->
<aside id="doro-aside">
			<!-- Logo -->
			<h1 id="doro-logo">
				<a class="logo-holder text-logo" style="margin-top:-25px;text-shadow: 3px 3px 5px #B8860B; color: #FFFF00; font-family: 'CharukolaUltraLight', sans-serif; font-weight:bolder;" href="#">

					মুণি ট্রেডার্স
					<span style="margin-top: 12px; color: #5DADE2;text-shadow: 3px 3px 5px #008B8B;">Innovative Agency</span>

				</a>
			</h1>


			<!-- Menu -->
			<nav id="doro-main-menu">
				<ul>
					<li id="menu-item-162"
						style="margin-top: -15px"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-158 current_page_item menu-item-162">
						<a href="/business_management/home/" class= "<?php echo($currentPage == "home" ? 'selectedMenu' : '');  ?>" aria-current="page">Dashboard</a>
					</li>
					<li id="menu-item-159" 
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-159"><a class= "<?php echo($currentPage == "purchase" ? 'selectedMenu' : '');  ?>" href="/business_management/purchase/">Purchase</a>
					</li>
					<li>
						<a class="nav-link dropdown-toggle <?php echo($currentPage == "sell" ? 'selectedMenu' : '');  ?>"  onclick="sell()" href="#">
							Sell
						</a>
						<ul class="dropdown-content" id="myDropdown5" style="background-color:black;width:100%; overflow:hidden">
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px" href="/business_management/sell/sell.php"><p style="text-align:center">New Sell</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/sendMessage/sendMessage.php"><p style="text-align:center">Send Message</p></a></li>
						</ul>
					</li>
					<li id="menu-item-163"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-163"><a class= "<?php echo($currentPage == "stock" ? 'selectedMenu' : '');  ?>" href="/business_management/stock/stock.php">Stock</a>
					</li>
					<li id="menu-item-160"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-160"><a class= "<?php echo($currentPage == "profit" ? 'selectedMenu' : '');  ?>" href="/business_management/profit/profitInput.php">Profit</a>
					</li>
					<li>
						<a class="nav-link dropdown-toggle <?php echo($currentPage == "payment" ? 'selectedMenu' : '');  ?>"  onclick="addNew()" href="#">
							Payments
						</a>
						<ul class="dropdown-content" id="myDropdown3" style="background-color:black;width:100%; overflow:hidden">
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px" href="/business_management/payments/customer/customerPayment.php"><p style="text-align:center">Customer's</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/payments/seller/sellerPayment.php"><p style="text-align:center">Seller's</p></a></li>
							
						</ul>
					</li>

					<li>
						<a class="nav-link dropdown-toggle <?php echo($currentPage == "cost" ? 'selectedMenu' : '');  ?>"  onclick="cost()" href="#">
							Cost
						</a>
						<ul class="dropdown-content" id="myDropdown4" style="background-color:black;width:100%; overflow:hidden">
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px" href="/business_management/cost/add/newCost.php"><p style="text-align:center">Add Cost</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/cost/view/inputDate.php"><p style="text-align:center">View Cost</p></a></li>
							
						</ul>
					</li>

					<li>
						<a class="nav-link dropdown-toggle <?php echo($currentPage == "addnew" ? 'selectedMenu' : '');  ?>"  onclick="payments()" href="#">
							Add New
						</a>
						<ul class="dropdown-content" id="myDropdown" style="background-color:black;width:100%; overflow:hidden">
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px" href="/business_management/addNew/customer/newCustomer.php"><p style="text-align:center">Customer</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/addNew/seller/newSeller.php"><p style="text-align:center">Seller</p></a></li>
							
						</ul>
					</li>

					<li>
						<a class="nav-link dropdown-toggle <?php echo($currentPage == "viewPayment" ? 'selectedMenu' : '');  ?>"  onclick="vpayments()" href="#">
							View Payments
						</a>
						<ul class="dropdown-content" id="myDropdown2" style="background-color:black;width:100%; overflow:hidden">
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px" href="/business_management/viewPayments/customers/inputDate.php"><p style="text-align:center">Customer's</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/viewPayments/sellers/inputDate.php"><p style="text-align:center">Seller's</p></a></li>
							
						</ul>
					</li>

					<li>
						<a class="nav-link dropdown-toggle <?php echo($currentPage == "view" ? 'selectedMenu' : '');  ?>"  onclick="view()" href="#">
							View
						</a>
						<ul class="dropdown-content" id="myDropdown1" style="background-color:black;width:100%; overflow:hidden">
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px" href="/business_management/view/customers/customers.php"><p style="text-align:center">Customers</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/view/sellers/sellers.php"><p style="text-align:center">Sellers</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/view/sells/inputDate.php"><p style="text-align:center">Sells</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/view/purchases/inputDate.php"><p style="text-align:center">Purchases</p></a></li>
						</ul>
					</li>

					<li>
						<a class="nav-link dropdown-toggle <?php echo($currentPage == "other" ? 'selectedMenu' : '');  ?>"  onclick="other()" href="#">
							Other
						</a>
						<ul class="dropdown-content" id="other" style="background-color:black;width:100%; overflow:hidden">
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px" href="/business_management/other/status/status.php"><p style="text-align:center">Status</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/other/take/take.php"><p style="text-align:center">Take</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/other/give/give.php"><p style="text-align:center">Give</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/other/take_details/inputDate.php"><p style="text-align:center">Take Details</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/other/give_details/inputDate.php"><p style="text-align:center">Give Details</p></a></li>
						</ul>
					</li>
					

				</ul>
			</nav>


			<!-- Sidebar Footer -->
			<div class="doro-footer mt-3" style="position: relative; padding: 0px, margin-top: 30px">
				<p><small>
					<p>© মুণি ট্রেডার্স 2021 | All rights reserved.</p>
				</small></p>
			</div>
		</aside>

		


		<script>
			/* When the user clicks on the button, 
			toggle between hiding and showing the dropdown content */
			function payments() {
				let temp = document.getElementById("myDropdown");
				if(temp.style.display === 'block'){
					document.getElementById("myDropdown").style.display = "none";
				}else{
					document.getElementById("myDropdown").style.display = "block";
				}
			}

			function vpayments() {
				let temp = document.getElementById("myDropdown2");
				if(temp.style.display === 'block'){
					document.getElementById("myDropdown2").style.display = "none";
				}else{
					document.getElementById("myDropdown2").style.display = "block";
				}
			}

			function view() {
				let temp = document.getElementById("myDropdown1");
				if(temp.style.display === 'block'){
					document.getElementById("myDropdown1").style.display = "none";
				}else{
					document.getElementById("myDropdown1").style.display = "block";
				}
			}
			function addNew() {
				let temp = document.getElementById("myDropdown3");
				if(temp.style.display === 'block'){
					document.getElementById("myDropdown3").style.display = "none";
				}else{
					document.getElementById("myDropdown3").style.display = "block";
				}
			}
			function cost() {
				let temp = document.getElementById("myDropdown4");
				if(temp.style.display === 'block'){
					document.getElementById("myDropdown4").style.display = "none";
				}else{
					document.getElementById("myDropdown4").style.display = "block";
				}
			}
			function sell() {
				let temp = document.getElementById("myDropdown5");
				if(temp.style.display === 'block'){
					document.getElementById("myDropdown5").style.display = "none";
				}else{
					document.getElementById("myDropdown5").style.display = "block";
				}
			}
			function other() {
				let temp = document.getElementById("other");
				if(temp.style.display === 'block'){
					document.getElementById("other").style.display = "none";
				}else{
					document.getElementById("other").style.display = "block";
				}
			}
			
		</script>
