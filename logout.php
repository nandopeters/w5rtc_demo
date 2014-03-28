<?php
	session_start();
	session_unset();
	session_destroy();
	//change the link where you want to move after logout
	header("Location:http://oditeksolutions.com/clients/w5rtc_demo/index.php");

?>