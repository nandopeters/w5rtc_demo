<?php

// disable warnings
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE); 

$sClientId = '253053263910.apps.googleusercontent.com';
$sClientSecret = 'YburyBFrYbHQWtqt4er_Occc';
$sCallback = 'http://oditeksolutions.com/clients/social/google_contact/index.php'; // callback url, don't forget to change it to your!
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
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Google API - Get contact list </title>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h2> contact list</h2>
        </header>
    <?php if ($sStep == 'auth'): ?>
        <center>
        <h1>&nbsp;</h1>
        <h2>Please click <a href="https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=<?php echo $oAuth->rfc3986_decode($oRequestToken['oauth_token']) ?>"><img src="google-login-button-asif18.png" />
    </center>
    <?php elseif ($sStep == 'fetch_contacts'): ?>
        <center>
        <h1>&nbsp;</h1>
        <br />
        <?= $sContacts ?>
        </center>
    <?php endif ?>

</body>
</html>