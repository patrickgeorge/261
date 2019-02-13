<img src="/acme/images/site/logo.gif" alt="acme logo" id="hdrimg1">
<link rel="stylesheet" type="text/css" href="/acme/css/acme_stylesheet.css" title="stylesheet">
<div id="account">
    <?php  
    if (isset($_SESSION['clientData'])) {
        echo "<span id=\"welcome\" ><a href=\"/acme/accounts/index.php?action=adminView\">Welcome, " . $_SESSION['clientData']['clientFirstname'] . "</a></span>"
        . "<h1><a href=\"/acme/accounts/index.php?action=Logout\" id=\"logout\">Log Out</a></h1>";
    } else {
        echo "<img src=\"/acme/images/site/account.gif\" alt=\"account folder\" id=\"hdrimg2\">
    <a href=\"/acme/accounts/index.php?action=login\">
  <p>My Account</p>
    </a>";
    }
    
    ?>
</div>