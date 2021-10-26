<?php 
	session_start();
	if( !isset($_SESSION['user_id'] )){
?>
		<script type="text/javascript" language="javascript">
			alert("Please Log in first.");
			location.replace("../index.php");
		</script>

<?php }  ?>