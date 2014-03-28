<?php
session_start();
	require_once'dbcon/connect.php';
	
$userid=$_SESSION["user_id"];
//$fullname=$_SESSION["firstname"]."&nbsp;".$_SESSION["lastname"];
$ctllogin=$_SESSION["client_loginid"];	
$userfirstname=$_SESSION["firstname"];	
$first_name=urlencode($userfirstname);
if(isset($_REQUEST['msg']))
 	{
		$msg = urlencode($_REQUEST['msg']);
 	}
	
	if(isset($_REQUEST['id']))
 	{
		$id = urlencode($_REQUEST['id']);
 	}

if($id!='')
{
	$activate=mysql_query("update w5_user set status ='1' where user_id='$id'");
	if($activate)
	{
			$msg ='7';//duplicate
			header("location:index.php?msg=$msg"); 
			exit();  
	}
}
	
?>

<?php
                      /*                               */
					  /*                               */
					  /* below code is for google api */
					  /*                               */
					  /*                               */
					  
// disable warnings
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE); 

$sClientId = '253053263910.apps.googleusercontent.com';
$sClientSecret = 'YburyBFrYbHQWtqt4er_Occc';
$sCallback = 'http://oditeksolutions.com/clients/w5desi_demo/index.php'; // callback url, don't forget to change it to your!
$iMaxResults = 1000; // max results
$sStep = 'auth'; // current step

// include GmailOath library  https://code.google.com/p/rspsms/source/browse/trunk/system/plugins/GmailContacts/GmailOath.php?r=11
include_once('classes/GmailOath.php');

session_start();

// prepare new instances of GmailOath  and GmailGetContacts
$oAuth = new GmailOath($sClientId, $sClientSecret, $argarray, false, $sCallback);
$oGetContacts = new GmailGetContacts();

if ($_GET && $_GET['oauth_token']) {

    $sStep = 'fetch_contacts'; // fetch contacts step

    // decode request token and secret
    $sDecodedToken = $oAuth->rfc3986_decode($_GET['oauth_token']);
    $sDecodedTokenSecret = $oAuth->rfc3986_decode($_SESSION['oauth_token_secret']);

    // get 'oauth_verifier'
    $oAuthVerifier = $oAuth->rfc3986_decode($_GET['oauth_verifier']);

    // prepare access token, decode it, and obtain contact list
    $oAccessToken = $oGetContacts->get_access_token($oAuth, $sDecodedToken, $sDecodedTokenSecret, $oAuthVerifier, false, true, true);
    $sAccessToken = $oAuth->rfc3986_decode($oAccessToken['oauth_token']);
    $sAccessTokenSecret = $oAuth->rfc3986_decode($oAccessToken['oauth_token_secret']);
    $aContacts = $oGetContacts->GetContacts($oAuth, $sAccessToken, $sAccessTokenSecret, false, true, $iMaxResults);

    // turn array with contacts into html string
    $sContacts = $sContactName = '';
    foreach($aContacts as $k => $aInfo) {
        $sContactName = end($aInfo['title']);
        $aLast = end($aContacts[$k]);
        foreach($aLast as $aEmail) {
            $sContacts .= '<p>' . $sContactName . '(' . $aEmail['address'] . ')</p>';
        }
    }
} else {
    // prepare access token and set it into session
    $oRequestToken = $oGetContacts->get_request_token($oAuth, false, true, true);
    $_SESSION['oauth_token'] = $oRequestToken['oauth_token'];
    $_SESSION['oauth_token_secret'] = $oRequestToken['oauth_token_secret'];
}

?>

<!DOCTYPE html>
<html lang="en">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Author" content="W5RTC" />
<meta name="Description" content="Video chat is avaialable for chrome" />
<meta name="Abstract" content="text chat,no signup needed,effect labs ,IT startup, product company facebook,video chat like free text chat,social networking, better, HD chat solution, WebRTC powered conference video chat, chrome browser video chat,skype alternative, WebRTC video chat, HTML5 video chat solution, video chat with no signup, video conference through webRTC,bistri,HDvideo call, Video calls reinvented,free video conference , effect labs products,friends video chat,WebRTC powered video chat Vline video chat,weemo webrtc chat,skype like software, Real time communication, online video chat, free video chat, peer to peer communication file sharing, WebRTC based chat solution" />
<meta name="KeyWords" content="text chat,no signup needed,effect labs ,IT startup, product company facebook,video chat like free text chat,social networking, better, HD chat solution, WebRTC powered conference video chat, chrome browser video chat,skype alternative, WebRTC video chat, HTML5 video chat solution, video chat with no signup, video conference through webRTC,bistri,HDvideo call, Video calls reinvented,free video conference , effect labs products,friends video chat,WebRTC powered video chat Vline video chat,weemo webrtc chat,skype like software, Real time communication, online video chat, free video chat, peer to peer communication file sharing, WebRTC based chat solution" />
<meta name="page-topic" content="text chat,no signup needed,effect labs ,IT startup, product company facebook,video chat like free text chat,social networking, better, HD chat solution, WebRTC powered conference video chat, chrome browser video chat,skype alternative, WebRTC video chat, HTML5 video chat solution, video chat with no signup, video conference through webRTC,bistri,HDvideo call, Video calls reinvented,free video conference , effect labs products,friends video chat,WebRTC powered video chat Vline video chat,weemo webrtc chat,skype like software, Real time communication, online video chat, free video chat, peer to peer communication file sharing, WebRTC based chat solution" />
<meta name="audience" content="Alle" />
<meta name="robots" content="index, follow" />
<meta name="Content-Language" content="de, at, ch, deutsch, german" />
<meta name="Language" content="English" />
<meta name="revisit-after" content="2" />
<meta name="Revisit" content="After 2 days" />
<meta name="Publisher" content="W5RTC" />
<meta name="distribution" content="text chat,no signup needed,effect labs ,IT startup, product company facebook,video chat like free text chat,social networking, better, HD chat solution, WebRTC powered conference video chat, chrome browser video chat,skype alternative, WebRTC video chat, HTML5 video chat solution, video chat with no signup, video conference through webRTC,bistri,HDvideo call, Video calls reinvented,free video conference , effect labs products,friends video chat,WebRTC powered video chat Vline video chat,weemo webrtc chat,skype like software, Real time communication, online video chat, free video chat, peer to peer communication file sharing, WebRTC based chat solution" />
<meta name="ICBM" content="48.1867, 16.3911" />
<meta name="DC.title" content="pre established title tag" />
<meta name="geo.position" content="48.1867;16.3908" />
<meta name="geo.region" content="AT" />
<meta name="geo.placename" content="Vienna" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no; target-densityDpi=device-dpi" />
<title>...:Welcome to W5RTC Company:...</title>
<link href="css/w5rtc.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<link rel="stylesheet" type="text/css" href="css/tooltip.css" />
<script type="text/javascript" src="js1/w5rtc.js" language="javascript"></script>
<script type="text/javascript" src="js1/modernizr.custom.js" language="javascript"></script>
<script type="text/javascript" src="js1/jquery.min.js"></script>
<script type="text/javascript" src="js1/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js1/jquery-scrolltofixed.js"></script>
<script type="text/javascript" src="js1/unslider.min.js"></script>
<script type="text/javascript" src="js1/jqueryfixed.js"></script>
<script type="text/javascript" src="js1/jquery.ui.totop.js"></script>
<script type="text/javascript" src="js1/jquery.supertoc.min.js"></script>
<script type="text/javascript" src="js1/top.js"></script>
<script type="text/javascript" src="js1/modernizr.js"></script>
<script type="text/javascript" src="js1/imagesliding.js"></script>
<script type="text/javascript" src="js1/showhidejs.js"></script>
<script type="text/javascript">
function reply()
 {
	var ele = document.getElementById("hiddenid");//div id 
	
	var show = document.getElementById("showid");
	var text = document.getElementById("btnsubmit");//btn id
	if(ele.style.display == "block")
	 {
    		ele.style.display = "none";
			show.style.display = "block";
  	 }
	else 
	{
		ele.style.display = "block";
		show.style.display = "none";
	}
} 

</script>
<script type="text/javascript">
function update_content(file_name)
{
		 
	 document.getElementById('home').className= ''; 	
	 document.getElementById('aboutus').className= ''; 	
	 document.getElementById('features').className= ''; 
	document.getElementById('feedback').className= ''; 
	 document.getElementById('contactus').className= ''; 
  
	   document.getElementById(file_name).className=  'active';


}
</script>
<script>
function finalval()
{
			if(document.getElementById("screenname").value=="")
			{
				alert("Enter ScreenName");
				return false;
			}
			else if(document.getElementById("w5id").value=="")
			{
				alert("Enter W5id");
				return false;
			}
			else
			{
				//document.getElementById("q3").style.display="";
				//document.getElementById("q2").style.display="none";
				//alert(1);
				document.getElementById('frmsign').method='post';
				//alert(2);
				document.getElementById('frmsign').enctype ='multipart/form-data';
				//alert(3);
				document.getElementById('frmsign').action="innersign.php";
				//alert(4)
				document.getElementById('frmsign').submit();
				//alert(5);
				return true; 
			}
}
</script>

<style>
#video{
width: 120px;
	height: 90px;
	/*border:solid;*/
	/*-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border:5px solid hidden;
	border-radius: 50%;*/
}
canvas {
    display: none;
}
 /*img {
    display: block;
    float: left;
    border: 10px solid #fff;
    border-radius: 10px;
	width: 380px;
    height: 290px;
	margin-left:90px;
}*/
#testimg
{
	
	height:90px;
	width:120px;
}
#photo
{

	height:90px;
	width:120px;
	
}

</style>

<link href="image/favicon.png" rel="shortcut icon" type="image/x-icon" />
</head>

<body onLoad="w5rtctitle()">
<nav class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-top" id="cbp-spmenu-s3">
			<h3><img src="image/w5rtclogo.png" border="0" name="w5rtc" /><br /><br />
            <div class="displaydiv1"><button id="showTop1" class="buttondivone"><img src="image/icon.png" border="0" name="w5rtc" /></button></div>
</h3>
			<a href="#" ><img src="image/videocalling.png" border="0" name="w5rtc" /><br />
Voice Chat</a>
			<a href="#"><img src="image/videocamera.png" border="0" name="w5rtc" /><br />
Video Chat</a>
			<a href="#"><img src="image/videochat.png" border="0" name="w5rtc" /><br />
Chat</a>
			<a href="#"><img src="image/videoconferance.png" border="0" name="w5rtc" /><br />
Video Conferencing</a>
			<a href="#"><img src="image/videoscreening.png" border="0" name="w5rtc" /><br />
Screen Sharing</a>
</nav>
<!--topheaderdiv-->
<div id="menubarfied">
	<div class="bodydivwidth">
		<div class="allsidepadding">
			<div class="fl logodivwidth">
            <img src="image/w5rtclogo.png" border="0" name="w5rtc" />
            </div>
            <div class="tpaddingdiv3 fl">
            	<a class="toggleMenu" href="#">Menu</a>
<ul class="nav">
<li class="test"><a class="scroll" data-speed="2000" data-easing="easeOutQuad" href="#destination1" onClick="update_content('home'); return false;" id="home">Home</a></li>
<li><a class="scroll" data-speed="2000" data-easing="easeOutQuad" href="#destination2" onClick="update_content('aboutus'); return false;" id="aboutus">About Us</a></li>
<li><a class="scroll" data-speed="2000" data-easing="easeOutQuad" href="#destination3" onClick="update_content('features'); return false;" id="features">Features</a></li>
<li><a class="scroll" data-speed="2000" data-easing="easeOutQuad" href="#destination4" onClick="update_content('feedback'); return false;" id="feedback">Feed Back</a></li>
<li><a class="scroll" data-speed="2000" data-easing="easeOutQuad" href="#destination5" onClick="update_content('contactus'); return false;" id="contactus">Contact Us</a></li>
</ul>
            </div>
            <div class="searchaligndiv fr newselfdiv large-2">
			
			<?php
			if($userid!='')
					{
			?>
					<div class="tpaddingdiv1">
                    	<div class="rpaddingdiv1 fl">
                        	<div class="bordergreendivnew canvasselfdiv">
                            &nbsp;
                            </div>
                        </div>
                        <div class="tpaddingdiv1 fl fontssizediv2 colorblack">
                        <?php echo $userfirstname;?>
                        </div>
                        <div class="clear"></div>
                    	<!--<div class="searchbgdivwidth">
                        	<input id="proposed_location" class="loginnewdiv fl" type="text" tabindex="5" style="width:140px;" placeholder="Proposed Location" name="user[name]"><input type="submit" class="search-form_is fl" id="search-form_is" value="">
                        </div>-->
                    </div>
					<?php
					}
					?>
					
					<?php
					if($userid=='')
					{
					?>
					<div style="padding-top:30px;">
					</div>
					<?php
					}
					else
					{
					?>
					<div style="padding-top:30px; display:none;">
					</div>
					<?php
					}
					?>
					
					
                    <div class="tpaddingdiv1">
                    <div class="textalignleftdiv fl">
					<?php
					if($userid=='')
					{
					?>
					<a href="#"><img src="image/signin.png" border="0" name="w5rtc" id="activator" /></a>
					<?php
					}
					?>
					<?php
					if($userid!='')
					{
					?>
					<a href="logout.php"><img src="image/signout.png" border="0" name="w5rtc" id="activator" /></a>
					<?php
					}
					?>
					</div><div class="textalignrightdiv fr"><button id="showTop" class="buttondivone"><img src="image/icon.png" border="0" name="w5rtc" /></button></div>
                    <div class="clear"></div>
                    </div>
            </div>
            <div class="clear">
            </div>
        </div>
	</div>
</div>
<!--end_topheaderdiv-->
<!--image_slider_div-->
<img id="logo" src="image/logo.png" alt="Unslider logo" width="34" height="27">
<div class="banner">
			<ul>
				<li style="background-image: url(image/slide-1.jpg);">
					<div class="inner">
						<h1>Welcome to W5RTC</h1>
						<p>W5RTC powered Conference Video Chat</p>

						<a class="btn" href="#download">Read More...</a>
					</div>
				</li>

				<li style="background-image: url(image/slide-2.jpg);">
					<div class="inner">
						<h1>Welcome to W5RTC</h1>
						<p>Video chat like free Text Chat</p>

						<a class="btn" href="#download">Read More...</a>
					</div>
				</li>
    				<li style="background-image: url(image/slide-3.jpg);">
					<div class="inner">
						<h1>Welcome to W5RTC</h1>
						<p>Real Time Communication.</p>

						<a class="btn" href="#download">Read More...</a>
					</div>
                    <a id="destination1"></a>
                  </li>
			</ul>
</div>
<!--end_image_slider_div-->

<!--inner_content_div-->
	<div class="row">
		<div class="allsidepadding">
        	<div class="tpaddingdiv4 fontssizediv12 colorsaffron fontweightbolddiv textaligncenterdiv lineheight3">
        	W5RTC - Video Chat made Simple!
        </div>
        <div class="tpaddingdiv3 textaligncenterdiv span4 marginautodiv">
        <img src="image/videoclub.png" border="0" name="w5rtc" />
        </div>
        <div class="tpaddingdiv2 textaligncenterdiv colorgreen fontssizediv5">
        Group Video Chat, Room Creation, Peer-to-Peer
        </div>
        <div class="tbpaddingdiv2 textaligncenterdiv span2 marginautodiv">
        <a id="destination2"></a>
            <div class="food-box">
                <div class="food-box-image"><a href="#"><img src="image/webcam.png" border="0" name="w5rtc" /></a></div>
                    <div class="food-box-transparentbg">
                        <div class="food-box-title"><a href="#">Click Here</a></div>
                    </div>
                <div class="food-box-uploadby">W5RTC</div>
            </div>
        </div>
        </div>
    </div>
<!--end_inner_content_div-->
<!--free_conferencing_div-->
        
	<div class="bgcolorsaffron widthpercentage tbpaddingdiv3">
    	<div class="row">
        	<div class="allsidepadding">
            	<div class="colorwhite fontssizediv14 textaligncenterdiv fontweightbolddiv lineheight5">
        	Now Free Conferencing Just a browser with Internet away!
	        </div>
            <div class="tpaddingdiv2">
            	<div class="span4 marginautodiv textaligncenterdiv"><img src="image/browsericon.png" border="0" name="w5rtc" id="showTop111" /></div>
            </div>
            <div class="tpaddingdiv3 textaligncenterdiv colorwhite fontssizediv5 coloryellow lineheight1">
            <a id="destination3"></a>
            	W5RTC brings Free instant video conferencing without any plugins, downloads and totally hassle free. W5RTC Video Conferencing and Chat solution is as simple as it can be. Its built on top of WebRTC and requires only your browser to start a video chat (upto 4 participants). Start a conference, Share your Conference link with your friends or colleagues and they just need a browser (Chrome, Internet Explorer, Mozila Firefrox, Safari, Opera) with internet to join you!! Try it Now... Presently works with
            </div>
            </div>
        </div>
    </div>
<!--end_free_conferencing_div-->
<!--row_conform_div-->
<div class="row">
	<div class="allsidepadding">
    	<div class="tbpaddingdiv3">
        	<div class="fontssizediv14 fontweightbolddiv colorsaffron textaligncenterdiv lineheight5">
            	Connect, <span class="colorgray">Communicate,</span> <span class="colorgreen">Collaborate</span>
            </div>
            <div class="tbpaddingdiv3">
            	<div class="span2 textaligncenterdiv marginautodiv"><a href="#" id="example-show" onClick="showHidenew('example');return false;"><img src="image/features.png" border="0" name="w5rtc" /></a></div>
            	<div id="example" class="displaydivnone">
				<div class="span8 bpaddingdiv2 textaligncenterdiv marginautodiv transactiondiv">
                	<a href="#"><img src="image/connectivity.png" border="0" name="w5rtc" id="showTopnew" class="imagewidth" /></a>
                </div>
         	<div class="span1 textaligncenterdiv marginautodiv"><a href="#" id="example-hide" onClick="showHidenew('example');return false;"><img src="image/features1.png" border="0" name="w5rtc" /></a></div>
				</div>
            </div>
        </div>
    </div>
</div>
<!--end_row_conform_div-->
<!--text_free_div-->
<a id="destination4"></a>
	<div class="bgcolorgreen widthpercentage tbpaddingdiv3">
       	<div class="row">
			<div class="allsidepadding">
				<div class="large-5 fl">
                	<div class="rpaddingdiv2">
                    	<div class="span5 textaligncenterdiv marginautodiv">
                        <img src="image/ipad.gif" border="0" name="w5rtc" />
                        </div>
                    </div>
                </div>
				<div class="large-7 fl">
                	<div class="lpaddingdiv1 colorwhite fontssizediv14 fontweightbolddiv textalignleftdiv lineheight5">
                    <div class="top1paddingdiv">Text \ Video Chat with your Friends Instantly and its</div>
                    </div>
                    <div class="tpaddingdiv9 textalignleftdiv lineheight6 fontssizediv15 coloryellow">
                    	<div class="lpaddingdiv1">FREE!</div>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
		 </div>
    </div>
<!--end_text_free_div-->
<div class="row">
	<div class="allsidepadding">
    	<div class="tbpaddingdiv3">
        	<div class="large-6 fl">
            	<div class="rpaddingdiv2">
                		<div class="fontssizediv14 colorgreen fontweightbolddiv textaligncenterdiv lineheight5 top1paddingdiv">
        					How would W5RTC Look!
        				</div>
                        <div class="fontssizediv3 colorgray textaligncenterdiv lineheight1 tbpaddingdiv3">
                        	W5RTC is shaping up at the moment and we are excited to present the Video Conferencing part of it currently. W5RTC is going to be full blown chat and conference engine with contact lists, secure conferencing, social networking, anonymous conferencing, IM, Screen Sharing features and we are working hard to give you the best online conferencing and IM experience. 
                        </div>
                </div>
            </div>
            <div class="large-6 fl">
            	<div class="lpaddingdiv2">
                	<div class="span6 textaligncenterdiv marginautodiv">
                        <img src="image/ipadnew.png" border="0" name="w5rtc" />
                    </div>
                </div>
            </div>
            <div class="clear">
            </div>
        </div>
    </div>
</div>
<!--w5all_side_div-->
<div class="row">
	<div class="allsidepadding">
    	<div class="bpaddingdiv1">
            <div class="large-4 fl textaligncenterdiv bpaddingdiv3">
                <div class="wfiveallimage"><a href="w5allpagelink/index.html"><img src="image/w5capi.png" border="0" name="w5rtc" class="span2" /></a></div>
            </div>
            <div class="large-4 fl textaligncenterdiv bpaddingdiv3">
                <div class="wfiveallimage"><a href="w5allpagelink/index.html"><img src="image/w5click.png" border="0" name="w5rtc" class="span2" /></a></div>
            </div>
            <div class="large-4 fl textaligncenterdiv bpaddingdiv3">
              <div class="wfiveallimage"><a href="http://oditeksolutions.com/clients/w5desi_demo/index.php?name='<?php echo $first_name;  ?>'"><img src="image/w5desi.png" border="0" name="w5rtc" class="span2" /></a></div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
</div>
<!--end_w5all_side_div-->
<!--contact_us_div-->
<a id="destination5"></a>
<div class="row">
	<div class="allsidepadding">
    	<div class="tbpaddingdiv2">
        	<iframe width="100%" height="326" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?ie=UTF8&amp;q=SJS+Enterprises+Pvt+Ltd&amp;fb=1&amp;gl=in&amp;hq=SJS+Enterprises+Pvt.+Ltd.&amp;cid=0,0,14462695909710563529&amp;ll=12.872328,77.538574&amp;spn=0.006295,0.006295&amp;t=m&amp;iwloc=A&amp;output=embed" name="SJS Enterprises Pvt Ltd, Kanakapura Rd, Talaghattapura, Bangalore, KA"></iframe>
        </div>
    </div>
</div>
<!--end_conta_us_div-->
<div class="bgcolorgreen widthpercentage tbpaddingdiv3">
	<div class="row">
        <div class="allsidepadding">
        <div class="large-4 fl">
        	<div class="fontssizediv1 colorwhite fottertextalignleftdiv">© 2014 W5RTC Pvt. Ltd. All Rrights Reserved<br />
            Maintained By: <span class="coloryellow fontssizediv1 fontweightbolddiv"><a href="http://www.oditeksolutions.com/" target="_blank">Oditek Solutions</a></span>
</div>
        </div>
        <div class="large-2 fr">
        	<div class="marginautodiv">
            	<div class="social-icons">
                		<ul>
		                    <li><a class="linkdin" href="#" target="_blank"> </a></li>
		                    <li><a class="facebook" href="#" target="_blank"></a></li>
		                    <li><a class="googleplus" href="#" target="_blank"></a></li>
		                    <li><a class="twitter" href="#" target="_blank"></a></li>
                            <li><a class="rss" href="#" target="_blank"></a></li>
		                    <div class="clear"></div>
		                </ul>
                </div>
            </div>
        </div>
        <div class="clear"></div>
            <div class="colorwhite textaligncenterdiv fontssizediv fontweightbolddiv">
            	<span class="coloryellow fontweightnormaldiv"><a href="#">Visit Us</a></span> | <span class="coloryellow fontweightnormaldiv"><a href="#">Privacy Policy</a></span> | <span class="coloryellow fontweightnormaldiv"><a href="#">Terms Of Use</a></span>
            </div>
        </div>
	</div>
</div>

<!--end_topheaderdiv-->
<div class="overlay" id="overlay" style="display:none;"></div>
        <div class="box" id="box">
            <!--<a class="boxclose" id="boxclose"></a>-->
<div class="allsidepadding">
	<div class="large-12 marginautodiv">
    	<!--1st_div-->
		<form name="frmlogin" id="frmlogin" method="post" action="innerlogin.php" >
        	<div class="bgcolorwhite greenboxshadow borderradiusdiv2 bordergray" id="showid" style="height:440px;">
            		<span class="fr textalignrightdiv positionabsolute rightsidediv" style="margin:-5px -5px 0px 0px">
                    	<a href="#"><img src="image/closebtn.png" border="0" name="boxclose" id="boxclose"></a>
                    </span>
        	<div class="allpaddingdiv2">
            	<div class="tbpaddingdiv1 textaligncenterdiv">
                	<img src="image/w5brand.png" border="0" name="w5desi" class="span1">
                </div>
                <div class="tbpaddingdiv1 textaligncenterdiv">
                	<div class="twoallpaddingdiv">
                    <div class="bpaddingdiv1"><input id="loginid" class="input-text text large-11" type="text" tabindex="5" placeholder="User Name" name="loginid" style="background-color:#FFF;"></div>
                    <div class="bpaddingdiv1"><input id="password" class="input-text password large-11" type="password" tabindex="5" placeholder="Password" name="password" style="background-color:#FFF;" ></div>
                    </div>
                    <div class="tbpaddingdiv1 allsidepaddingleftright"><div class="allsidedivpadding"><input class="buttonsarfondiv submit large-12" type="submit" value="Sign in" name="submit" onClick="return loginval()"></div></div>
                    <div class="textalignrightdiv fontssizediv1 colorgreen" style="padding-right:13px;">
                    	<a href="#">Need Help ?</a>
                    </div>
                    <div class="margintopbottomdiv middleborderimage">
                    </form>
                    &nbsp;
                    </div>
                    <div class="fontssizediv colorblack">
                    	Sign in with <span class="colorgreen fontweightbolddiv fontstyleitalicdiv"><a href="#">Facebook</a></span> or <span class="colorgreen fontweightbolddiv fontstyleitalicdiv"><a href="#">Linkedin</a></span> or <span class="colorgreen fontweightbolddiv fontstyleitalicdiv">
				<?php if ($sStep == 'auth'): ?><a href="https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=<?php echo $oAuth->rfc3986_decode($oRequestToken['oauth_token']) ?>">Google</a><?php elseif ($sStep == 'fetch_contacts'): ?>
                 <?= $sContacts ?>
        </center>
    <?php endif ?></span>
                    </div>
                    <div class="bpaddingdiv1 textaligncenterdiv colorblack fontssizediv1 fontstyleitalicdiv margintopbottomdiv middleborderimage">
                    <span class="allpaddingdiv1 bgcolorwhite">OR</span>
                    </div>
                    <div class="allsidepaddingleftright"><div class="allsidedivpadding"><input class="buttongreendiv submit large-12" type="button" value="Create New Account" name="btnsubmit" id="btnsubmit" onClick="reply()"></div></div>
                    <div style="padding-bottom:10px;">
                    </div>
                </div>
            </div>
        </div>
		
        <!--end_1st_div-->
		
		
        <!--2nd_div-->
		<form name="frmsign" id="frmsign" method="post" enctype="multipart/form-data">
        <div class="bgcolorwhite greenboxshadow borderradiusdiv2 bordergray" id="hiddenid" style="display:none; height:440px;">
					<span class="fr textalignrightdiv positionabsolute rightsidediv" style="margin:-5px -5px 0px 0px">
                    	<a href="#" id="close"><img src="image/closebtn.png" border="0" name="boxclose1" id="boxclose1"></a>
                    </span>
        	<div id="q1" style="display: block;">
                <div id="boxes">
                    <div style="top: 10%; left: 0px; display: none;" id="dialog" class="window textaligncenterdiv">
                    Click  "Allow" in the browser to use camera. 
                    <!--<a href="#" class="close">Close it</a>-->
                    </div>
                    <!-- Mask to cover the whole screen -->
                    <div style="width: auto; height: auto; display: none; opacity: 0.1;" id="masknew"></div>
                </div>
            <div class="allpaddingnewbottomdiv">
                    <div class="clear"></div>
                	<div class="tbpaddingdiv1 textaligncenterdiv">
                	<img src="image/w5brand.png" border="0" name="w5desi" class="span1">
                	</div>
           </div>
           	<div class="tpaddingdiv1">
            	<div class="allsidepadding">
                	<div class="bpaddingdiv1 fl">
                    	<div class="rpaddingdiv1">
                        	<div class="allsideborderradiusdiv bordergreendiv canvasnewsdiv marginautodiv">
                        	<video id="video" style="display:block"></video>
                            <!--<img src="" id="testimg" border="0" style="z-index:1">-->
                            <canvas id="canvas"></canvas>
                        	</div>
                        </div>
                    </div>
                    <div class="bpaddingdiv2 fr">
                        <div class="allsideborderradiusdiv bordergreendiv canvasnewradiusdiv marginautodiv">
                        <img src="image/photonewimage.jpg" border="0" name="photo" class="allsideborderradiusdiv" id="testimg">
                        <img src="image/photonewimage.jpg" alt="Preview Image" id="imagePreview" width="140" height="90" class="allsideborderradiusdiv" />
                        </div>
                    </div>
                    <div class="clear"></div>
            	</div>
            </div>
           <div class="allpaddingtopdiv">         
                <div class="tbpaddingdiv1 textaligncenterdiv">
                    <div class="bpaddingdiv1 textaligncenterdiv">
                    <a onClick="$('#newfile').click();" href="#" id="umasir"><img src="image/videocam.png" border="0" name="folder" id="btn" class="snapwidth"></a>
                    <a onClick="$('#newfile').click();" href="#" class="displaydivnone"><img src="image/videocam1.png" border="0" name="folder" id="snaptwo" class="snapwidth"></a>
                    </div>
                     <div class="tpaddingdiv2">
                            	<!--<input type="file" name="file" style="visibility:hidden;display:none;" id="pdffile" />
                            <input type="text" id="subfile" class="input-xlarge" style="display:none;">-->
                    	<div class="textaligncenterdiv" id="img"><input type="file" name="imageUpload" id="imageUpload" class="displaydivnone"/> 
<label for="imageUpload"><img src="image/uploadphoto.png" border="0" name="folder" class="snapwidth" style="cursor:pointer"  /></label><!--<a onClick="$('#pdffile').click();" href="#"><img src="image/uploadphoto.png" border="0" name="folder" class="snapwidth"></a>--></div>
                    </div>
                </div>
                </div>
                	<div class="tbpaddingdiv1">
                    <div style="padding-bottom:32px;">
                    </div>
                    	<div class="fl lpaddingdiv1">
                        <a href="#"><img src="image/leftarrow.png" border="0" name="btnsubmit" id="btnsubmit" onClick="reply()"></a>
                        </div>
                        <div class="fr rpaddingdiv1">
                       <!-- <a href="#" onClick="showHide(2);"><img src="image/rightarrow.png" border="0" name="w5desi"></a>-->
					   <a href="#" onClick="photoval();"><img src="image/rightarrow.png" border="0" name="w5desi"></a>
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                </div>
				
                <div id="q2" style="display: none;">
                <div class="allpaddingbottomdiv">
                	<div class="tbpaddingdiv1 textaligncenterdiv">
                	<img src="image/w5brand.png" border="0" name="w5desi" class="span1">
                	</div>
                <div class="textaligncenterdiv">
                	<div class="twoallpaddingdiv">
                    <div class="tbpaddingdiv1"><input id="firstname" class="input-text text large-11" type="text" tabindex="5" placeholder="First Name" name="firstname" style="background-color:#FFF;"></div>
                    <div class="bpaddingdiv1"><input id="lastname" class="input-text text large-11" type="text" tabindex="5" placeholder="Last Name" name="lastname" style="background-color:#FFF;"   onKeyUp="showname()"></div>
                    <div class="bpaddingdiv1"><input id="emailid" class="input-text text large-11" type="text" tabindex="5" placeholder="Email ID" name="emailid" style="background-color:#FFF;"></div>
                    <div class="bpaddingdiv1"><input id="pass" class="input-text password large-11" type="password" tabindex="5" placeholder="Password" name="pass" style="background-color:#FFF;"></div>
                    <div class="bpaddingdiv1"><input id="repass" class="input-text password large-11" type="password" tabindex="5" placeholder="Confirm Password" name="repass" style="background-color:#FFF;"></div>
                    </div>
                    <div class="twoallnewpaddingdiv">
                        <div class="bpaddingdiv1 textaligncenterdiv">
                            <img src="php_captcha.php" border="0" class="span3" height="45">
                        </div>
                    </div>
                    <div class="twoallpaddingdiv">
                    <div style="padding-bottom:7px;">
                   <input id="txtcaptcha" class="input-text text large-11" type="text" tabindex="5" placeholder="Type above characters" name="txtcaptcha" style="background-color:#FFF;">
                    </div>
                    </div>
                    <div style="padding-bottom:5px;">
                    </div>                    
                </div>
                </div>
                	<div class="bpaddingdiv1">
                    	<div class="fl lpaddingdiv1">
                        <a href="#" onClick="bakphoto();" id="shopphoto"><img src="image/leftarrow.png" border="0" name="w5desi"></a>
                        </div>
                        <div class="fr rpaddingdiv1">
                        <a href="#" onClick="informval();"><img src="image/rightarrow.png" border="0" name="w5desi"></a>
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                </div>
                
                <div id="q3" style="display: none;">
                <div class="allpaddingnewbottomdiv">
                	<div class="tbpaddingdiv1 textaligncenterdiv">
                	<img src="image/w5brand.png" border="0" name="w5desi" class="span1">
                	</div>
                <div class="tbpaddingdiv1 textaligncenterdiv">
                	<div class="twoallpaddingdiv">
                    <div style="padding-bottom:5px;">
                        <div class="allsideborderradiusdiv bordergreendiv canvasnewradiusdiv marginautodiv">
                        <input type="hidden" id="photo_snap" name="photo" />
                        <img src="image/photonewimage.jpg" border="0" name="photo" class="allsideborderradiusdiv" id="photo">
                        </div>
                    </div>
                    </div>
                    <div class="twoallpaddingdiv textaligncenterdiv">
                    	<div class="bpaddingdiv1">
                        <span class="fontweightbolddiv fontssizediv colorblack ">Screen Name</span><br>
<span class="fontweightbolddiv fontssizediv colorgreen" id="showfullname"></span>
                        </div>
                        <div>
                        <span class="fontweightbolddiv fontssizediv colorblack ">W5 ID</span><br>
<span class="fontweightbolddiv fontssizediv colorgreen" id="showw5id"></span>
                        </div>
	                </div>
                    <div class="textaligncenterdiv colorblack fontssizediv1 fontstyleitalicdiv margintopbottomnewdiv middleborderimage">
                    <span class="allpaddingdiv1 bgcolorwhite">OR</span>
                    </div>
                    <div class="twoallpaddingdiv">
                            <div class="bpaddingdiv1 textaligncenterdiv">
                            <input id="screenname" class="input-text text large-11" type="text" tabindex="5" name="screenname" style="background-color:#FFF;" placeholder="Screen Name">
                            </div>
                            <div class="textaligncenterdiv">
                            <div class="divnew"><input id="w5id" class="input-text text large-11" type="text" tabindex="5" name="w5id" style="background-color:#FFF;" placeholder="W5 ID"><span class="spandiv fontsnewsizediv">W5 recommends<br>
Cell No<br>
or<br> PAN No
</span></div>
                            </div>
                            <div style="padding-bottom:8px;">
                    </div> 
                    </div>
                </div>
                        
<div id="qq1" style="display: none;">
</div>
<div id="qqq1" style="display: none;">
</div>
            </div>
                                <div class="bpaddingdiv1">
                    	<div class="fl lpaddingdiv1">
                        <a href="#" onClick="bakinform();" id="bkinform"><img src="image/leftarrow.png" border="0" name="w5desi"></a>
                        </div>
                        <div class="fr rpaddingdiv1">
                        <a href="#" onClick="finalval();"><img src="image/rightarrow.png" border="0" name="w5desi"></a>
                        </div>
                        <div class="clear">
                        </div>
                    </div>
        </div>
        </div>
		
		</form>
        <!--end_2nd_div-->
		
		
    </div>
  </div>
        </div>
<!--image_slider_div-->

<!--total_body_div-->
<!--<div class="bodydivwidth">
	<div class="allsidepadding">
    	<div class="textaligncenterdiv tbpaddingdiv9">
        OMM LORD GANAPATI DEVAYA NAMAHA OMM ASTA KOTI DEVATYA NAMAHA OMM SHIRIDI SAI RAM
        <div style="height:900px;">
        </div>
        </div>
    </div>
</div>-->
<!--end_total_body_div-->

<script>
/********************* photo valid************************************/
function photoval()
{
//alert("bbb"); <img src="image/photonewimage.jpg" border="0" name="photo" class="allsideborderradiusdiv" id="testimg">
	//var uploadphoto=document.getElementById('testimg').innerHTML;

	document.getElementById("q2").style.display="";
	document.getElementById("q1").style.display="none";		 
			/* if(uploadphoto=='<img src="image/photonewimage.jpg" border="0" name="photo" class="allsideborderradiusdiv" id="testimg">')
			{
			alert("mmmm");*/
				/*IndexPos = uploadphoto.lastIndexOf(".");
				sFileExt = uploadphoto.substr(IndexPos+1,uploadphoto.length);
				sFileExt = sFileExt.toLowerCase();
				if ((sFileExt != 'png') && (sFileExt != 'jpg') && (sFileExt != 'jpeg'))
				{
					alert("Upload Photo in JPG/JPEG/PNG Format");
					return false;
				}
				else
				{
					document.getElementById("q2").style.display="";
					document.getElementById("q1").style.display="none";
					return true; 	
				}
			}
			return false;*/
}
/********************* information valid************************************/
function informval()
{
	var etest=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(document.getElementById("firstname").value=="")
			{
				alert("Enter FirstName");
				return false;
			}
			else if(document.getElementById("lastname").value=="")
			{
				alert("Enter LastName");
				return false;
			}
			else if(document.getElementById("emailid").value=="")
			{
				alert("Enter Email Id");
				return false;
			}
			else if(!etest.test(document.getElementById("emailid").value))
			{
				alert("Invalid Email Id");
				return false;
			}
			else if(document.getElementById("pass").value=="")
			{
				alert("Enter Password");
				return false;
			}
			else if(document.getElementById("repass").value=="")
			{
				alert("Enter Re-Password");
				return false;
			}
			else if(document.getElementById("pass").value!=document.getElementById("repass").value)
			{
				alert("Password and confirm Password Mismatched");
				return false;
			}
			else if(document.getElementById("txtcaptcha").value=="")
			{
				alert("Enter Captcha");
				return false;
			}
			else
			{
				document.getElementById("q3").style.display="";
				document.getElementById("q2").style.display="none";
				return true; 
			}
}
/******************** back to photo *******************************/
function bakphoto()
 {
	var ele = document.getElementById("q2");//div id 
	
	var show = document.getElementById("q1");
	var text = document.getElementById("shopphoto");//btn id
	if(ele.style.display == "none")
	 {
    		ele.style.display = "block";
			show.style.display = "none";
  	 }
	else 
	{
		ele.style.display = "none";
		show.style.display = "block";
	}
} 
/********************* Screen valid************************************/

/********************* back information page ************************************/
function bakinform()
 {
	var ele = document.getElementById("q3");//div id 
	
	var show = document.getElementById("q2");
	var text = document.getElementById("bkinform");//btn id
	if(ele.style.display == "none")
	 {
    		ele.style.display = "block";
			show.style.display = "none";
  	 }
	else 
	{
		ele.style.display = "none";
		show.style.display = "block";
	}
} 
/*********************login valid*******************************/
function loginval()
{
			if(document.getElementById("loginid").value=="")
			{
				alert("Enter LoginId");
				return false;
			}
			else if(document.getElementById("password").value=="")
			{
				alert("Enter Password");
				return false;
			}
			else
			{
				return true; 
			}
}
/********************* show fullname ******************************/
function showname()
{
var rand=Math.floor(Math.random()*10000+1)

//alert(randomnumber);
	var first=document.getElementById("firstname").value;
	var last=document.getElementById("lastname").value;
	
	document.getElementById("showfullname").innerHTML=first + last;
	document.getElementById("showw5id").innerHTML=first + last+rand;
}


</script>


<script>
 	$(document).ready(function(){
 		// This is the simple bit of jquery to duplicate the hidden field to subfile
 		$('#pdffile').change(function(){
			$('#subfile').val($(this).val());
		}); 

		// This bit of jquery will show the actual file input box
		$('#showHidden').click(function(){
			$('#pdffile').css('visibilty','visible');
		});
 	});
 	</script>
<script src="js1/classie.js"></script>
<script src="js1/showhide.js"></script>
<script type="text/javascript" src="js1/script.js"></script>
<script>
			if(window.chrome) {
				$('.banner li').css('background-size', '100% 100%');
			}

			$('.banner').unslider({
				arrows: true,
				fluid: true,
				dots: true
			});

			//  Find any element starting with a # in the URL
			//  And listen to any click events it fires
			$('a[href^="#"]').click(function() {
				//  Find the target element
				var target = $($(this).attr('href'));

				//  And get its position
				var pos = target.offset(); // fallback to scrolling to top || {left: 0, top: 0};

				//  jQuery will return false if there's no element
				//  and your code will throw errors if it tries to do .offset().left;
				if(pos) {
					//  Scroll the page
					$('html, body').animate({
						scrollTop: pos.top,
						scrollLeft: pos.left
					}, 1000);
				}

				//  Don't let them visit the url, we'll scroll you there
				return false;
			});

			var GoSquared = {acct: 'GSN-396664-U'};
		</script>
        <script src="js1/smooth-scroll.js"></script>
<script type="text/javascript">
            $(function() {
                $('#activator').click(function(){
                    $('#overlay').fadeIn('fast',function(){
                        $('#box').animate({'top':'60px'},500);
                    });
                });
                $('#boxclose').click(function(){
                    $('#box').animate({'top':'-700px'},500,function(){
                        $('#overlay').fadeOut('fast');
                    });
                });
				$('#boxclose1').click(function(){
                    $('#box').animate({'top':'-700px'},500,function(){
                        $('#overlay').fadeOut('fast');
                    });
                });

            });
        </script>
                <script>
						//(function() {
						//the below code is for taking pic and stop camera

  var streaming = false,
      video        = document.querySelector('#video'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  =document.querySelector('#btn');
      width = 120,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);
document.getElementById('btnsubmit').onclick=function()
{
navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
		localStream=stream;
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = localStream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
		$('#masknew').hide();
		$('.window').hide();
		
      }
	  
      video.play();
	  
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );
 
	  
  reply();
  
 //newImage();
}
function newImage()
{
	//alert(document.getElementById("umasir"));
	//document.getElementById("umasir").innerHTML="";
	  var retake='<img src="image/videocam1.png" id="btn2" class="snapwidth">';
	  document.getElementById("umasir").innerHTML=retake;
	  startbutton  =document.querySelector('#btn2');
	   startbutton.addEventListener('click', function(ev){
	  //alert("1");
      takepicture();
	  //alert("2");
	 
    ev.preventDefault();
  }, false);
}

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
	var imgtest=document.getElementById("testimg");
	imgtest.src=data;
	//alert(data);
	document.getElementById('photo_snap').value=data;
	
	document.getElementById("video").style.display="block";
	document.getElementById("imgtest").style.display="block";
	
  }

  startbutton.addEventListener('click', function(ev){
	  //alert("1");
	   document.getElementById('imagePreview').style.display='none';
		document.getElementById('testimg').style.display='block';
      takepicture();
	  //alert("2");
	 
    ev.preventDefault();
  }, false);
  document.getElementById('close').onclick=function()
  {
	  alert('hello');
	  if (localStream) 
		{
			 localStream.stop();
		     //alert('123'); 
			 video.src="";
		}
  }
/*function close_cam()
{
	alert('hello');
	if(stream)
	{
		video.src="";
	}
}*/
//})();
document.getElementById('img').onclick=function()
{
	  alert('hiii');
	 document.getElementById('testimg').style.display='none';
	 document.getElementById('imagePreview').style.display='block';
	 
	 //document.getElementById('').style.
	// $("#testimg > img").first().clone().appendTo("#photo");
}
</script>
<script type="text/javascript">
$(document).ready(function() {	

		var id = '#dialog';
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#masknew').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#masknew').fadeIn(1000);	
		$('#masknew').fadeTo("slow",0.4);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 	
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#masknew').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#masknew').click(function () {
		$(this).hide();
		$('.window').hide();
	});		
	
});

</script>
<script>
$('#imageUpload').change(function(){			
			readImgUrlAndPreview(this);
			function readImgUrlAndPreview(input){
				 if (input.files && input.files[0]) {
			            var reader = new FileReader();
			            reader.onload = function (e) {	
						//alert(123);	
						            	
			                $('#imagePreview').attr('src', e.target.result);
							$('#photo').attr('src', e.target.result);
							document.getElementById('photo_snap').value=e.target.result;
								//alert(e.target.result);
							//document.getElementById('').
							  //$('#photo').attr('src', e.target.result);
							}
			          };
			          reader.readAsDataURL(input.files[0]);
			     }	
		});
</script>
</body>
</html>

<script>
function messagestatus(st)
{
	switch(st)
	{		
		case 2:
		{
			alert("Invalid Login");
			document.location.href="index.php";
			break;
		}
		case 3:
		{
			alert("Thanks for Registration");
			document.location.href="index.php";
			break;
		}	
		case 4:
		{
			alert("Sorry,Unable To Registration");
			document.location.href="index.php";
			break;
		}
		case 5:
		{
			alert("Login Id Already exit");
			document.location.href="index.php";
			break;
		}
		case 6:
		{
			alert("Invalid Captcha");
			document.location.href="index.php";
			break;
		}
		case 7:
		{
			alert("Activated Your Account");
			document.location.href="index.php";
			break;
		}								
	}
}
messagestatus(<?php echo $msg ?>);
</script>
