<?php
	session_start();	
	$_SESSION['userid'] = "";
	session_destroy();
?>
<script type="text/javascript" language="javascript">
	location.replace("index.php");
</script>