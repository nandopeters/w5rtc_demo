<?php
session_start();
	require_once'dbcon/connect.php';
	$photo_url=$_POST['photo'];
	$data=file_get_contents($photo_url);
	$w5id=mysql_real_escape_string(trim($_POST['w5id']));
	$img_name=$w5id.".jpg";
	//echo"<img src='$photo_url' />";
	$photo_store="uploads/".$img_name;
	
	file_put_contents($photo_store, $data);
	//echo $photo."<br />";
	//copy($photo,);
	//echo 123;
	
			//$filename_tmp = $_FILES['imageUpload']['tmp_name'];xcv
						
						//$newpath =$imageuploadpath."$insertid-".$imagelogo;
						//$newdbpath=$imageuploadpath.$imagelogo;
					/*********** Resize Image**************/
					 
					//move_uploaded_file($filename_tmp,$image_path);
					
	
 if (isset($_REQUEST['msg']))
	$msg = urlencode($_REQUEST['msg']);
	
	
	$firstname=mysql_real_escape_string(trim($_POST['firstname']));
	$lastname=mysql_real_escape_string(trim($_POST['lastname']));
	$mailid=mysql_real_escape_string(trim($_POST['emailid']));
	
  	$act_pwd=mysql_real_escape_string(trim($_POST['pass']));
	$encriptpassword=sha1($_POST['pass']);
   	$screenname=mysql_real_escape_string(trim($_POST['screenname']));
	$w5id=mysql_real_escape_string(trim($_POST['w5id']));
		
	$status='0';
	$date=date('Y-m-d H:i:s');
	$txtcaptcha=$_REQUEST['txtcaptcha'];
	$imagelogo=$_FILES['pdffile']['name'];
	
	$fullname=$firstname."".$lastname;
	
	
	
	if(substr($_SESSION["captcha"],0,5)==$_REQUEST['txtcaptcha'])
	{
		$duploginid=mysql_query("select mailid from w5_user where mailid='$mailid'");
		$Duplicatelogin= mysql_num_rows($duploginid);
		if ($Duplicatelogin>0)
		{
			$msg ='5';//duplicate
			header("location:index.php?msg=$msg"); 
			exit();   
		}
		else
		{
		
		
					$added=mysql_query("INSERT INTO `oditek`.`w5_user` (`uimage`, `firstname`, `lastname`, `mailid`, `enc_password`, `actual_password`, `screenname`, `w5id`, `status`, `create_date`) VALUES ('$img_name', '$firstname', '$lastname', '$mailid', '$encriptpassword', '$act_pwd', '$screenname', '$w5id', '$status', '$date')");
					echo $img_name;
				
			
			$insertid=mysql_insert_id();
			
			          
			 		if($imagelogo!='')
					{
						 /*Image upload Query*/
			
			             
						
						list($width,$height)=getimagesize($newpath);
					}
					
					if($added)
					{
						mysql_query("update w5_user set image ='$newpath' where user_id='$insertid'");
						
			/*****************************mail part **********************************************/
					$subject = "Activation Request";						
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= "Content-type: text/html\r\n";
					$headers .= 'From:<info@oditeksolutions.com>' . "\r\n";
					$today = date("F j, Y, g:i a"); 
					
					$txt="<body>
						<table width='700' border='1' align='left'>
						<tr height='30' style='font-family:Tahoma, Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
						<td width='80' align='center'>
						Date:
						</td>
						<td width='700' align='left' style='padding-left:5px;'>
						$today
						</td>
						</tr>
						<tr height='30' style='font-family:Tahoma, Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
						<td width='80' align='center'>
						Name:
						</td>
						<td width='700' align='left' style='padding-left:5px;'>
						$fullname
						</td>
						</tr>
						<tr height='30' style='font-family:Tahoma, Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
						<td width='80' align='center'>
						Email:
						</td>
						<td width='700' align='left' style='padding-left:5px;'>
						$mailid
						</td>
						</tr>
						<tr height='30' style='font-family:Tahoma, Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
						<td width='80' align='center'>
						Activate Your Account :
						</td>
						<td><a href='www.oditeksolutions.com/clients/w5rtc_demo/index.php?id=$insertid'>Click here to Activate Account</a></td>
						</tr>
						</table>
						</body>";
						
						
						$gomail=mail($mailid,$subject,$txt,$headers);

						if($gomail)
						{
							$msg = '3'; 
							header("location:index.php?msg=$msg"); 
							exit();
						} 
						else
						{
							$msg = '4'; //'Unable to Add ';
							header("location:index.php?msg=$msg"); 
							exit();
						} 

					}
					else
					{
							$msg = '4'; //'Unable to Add ';
							header("location:index.php?msg=$msg"); 
							exit();
					}

			
		}
	
	}
	else
	{
			$msg = '6'; //'invalid captcha ';
			header("location:index.php?msg=$msg"); 
			exit();
	}	
	
			
?>



