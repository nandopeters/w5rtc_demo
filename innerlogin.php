<?php
	session_start();
	require_once'dbcon/connect.php';
	
 if (isset($_REQUEST['msg']))
	$msg = urlencode($_REQUEST['msg']);

			$loginid=htmlspecialchars(trim($_POST['loginid']));
		  	$pwd=htmlspecialchars(trim($_POST['password']));
			$password1 =sha1($pwd);
			$password = $password1;
  
	 		$adminlogin=mysql_query("select * from w5_user where mailid='$loginid' and enc_password='$password' and status='1'");
 			$Num = mysql_num_rows($adminlogin);	
	
				 if ($Num > 0)
				 {
					  while($row = mysql_fetch_array($adminlogin))
					  {
					 	 $userid=htmlspecialchars($row['user_id']);  
						$userfirstname=htmlspecialchars($row['firstname']);
						$userlastname=htmlspecialchars($row['lastname']);
						$ctllogin=htmlspecialchars($row['mailid']);
						
						//$fullname=$userfirstname."&nbsp;".$userlastname;
						
					  }
					  	$_SESSION["user_id"] = $userid;
						$_SESSION["firstname"] = $userfirstname;
						//$_SESSION["firstname"]."&nbsp;".$_SESSION["lastname"] = $fullname;
						$_SESSION["mailid"] = $ctllogin;
					
					 	header("location:index.php");
				}

					  else
					  {
					  		$msg ='2'; // ' invalid login';
							header("location:index.php?msg=$msg"); 
							exit();
					  }
		 

?>

