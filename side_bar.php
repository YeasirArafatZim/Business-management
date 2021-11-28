<!-- Sidebar Section -->
<aside id="doro-aside">
			<!-- Logo -->
			<h1 id="doro-logo" style="font-weight:550">
				<a class="logo-holder text-logo" href="#">
					মুণি ট্রেডার্স
					<span>Innovative Agency</span>

				</a>
			</h1>


			<!-- Menu -->
			<nav id="doro-main-menu">
				<ul>
					<li id="menu-item-162"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-158 current_page_item menu-item-162">
						<a href="/business_management/home/" class= "<?php echo($currentPage == "home" ? 'selectedMenu' : '');  ?>" aria-current="page">Dashboard</a>
					</li>
					<li id="menu-item-159" 
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-159"><a class= "<?php echo($currentPage == "purchase" ? 'selectedMenu' : '');  ?>" href="/business_management/purchase/">Purchase</a>
					</li>
					<li id="menu-item-164"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a class= "<?php echo($currentPage == "sell" ? 'selectedMenu' : '');  ?>" href="/business_management/sell/sell.php">Sell</a>
					</li>
					<li id="menu-item-163"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-163"><a class= "<?php echo($currentPage == "stock" ? 'selectedMenu' : '');  ?>" href="/business_management/stock/stock.php">Stock</a>
					</li>
					<li id="menu-item-160"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-160"><a class= "<?php echo($currentPage == "profit" ? 'selectedMenu' : '');  ?>" href="/business_management/Profit/profitInput.php">Profit</a>
					</li>
					<li>
						<a class="nav-link dropdown-toggle <?php echo($currentPage == "payment" ? 'selectedMenu' : '');  ?>"  onclick="payments()" href="#">
							Payments
						</a>
						<ul class="dropdown-content" id="myDropdown" style="background-color:black;width:100%; overflow:hidden">
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px" href="/business_management/payments/customer/customerPayment.php"><p style="text-align:center">Customer's</p></a></li>
							<li><a class="dropdown-item" style="margin:0px; height:40px;padding-top:10px;" href="/business_management/payments/seller/sellerPayment.php"><p style="text-align:center">Seller's</p></a></li>
							
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
					

				</ul>
			</nav>


			<!-- Sidebar Footer -->
			<div class="doro-footer mt-5" style="position: relative; padding: 0px, margin-top: 30px">
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
			
		</script>
