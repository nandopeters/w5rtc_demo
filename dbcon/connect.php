<?php
	/*error_reporting(0);
	$con = mysql_connect("localhost","root","") or die( "Unable to connect to database");
	if (!$con)
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("w5rtc", $con)  or die( "Unable to select database");
	
	function getRecordset($sql){
		$result=mysql_query($sql);
		return $result;
	}*/
	

	error_reporting(0);
	$con = mysql_connect("localhost","root","") or die( "Unable to connect to database");
	if (!$con)
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("oditek", $con)  or die( "Unable to select database");
	
	function getRecordset($sql){
		$result=mysql_query($sql);
		return $result;
	}
 ?>
