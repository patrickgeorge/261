<?php
if (!$_SESSION['loggedin'] == TRUE) {
    header('Location: /acme/');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device+width, initial-scale=1.0">
        <title>User Account</title>
    </head>
    <body>
        <div id="content">
       <div id="header">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/header.php'; ?>
        </header> 
           <div id="nav">
             <nav>
            <?php /*include $_SERVER['DOCUMENT_ROOT'].'/acme/common/nav.php'; */?>
            <?php echo $navList; ?> 
             </nav>
           </div>
       </div>
        <main>
            <h1>
                <?php echo $_SESSION['clientData']['clientFirstname']; ?>
            </h1>
            
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
            
            <p>You are logged in.</p>
            <ul>
                <li>First name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                <li>Last name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
            </ul>
            
            <h2>Account Management</h2>
            <p>In order to change your name and email, or to change your password, please <a href="/acme/accounts/index.php?action=accountView">click here</a></p>
            
            <?php
                if ($_SESSION['clientData']['clientLevel'] > 1) {
                    echo "<h2>Product Management</h2><p>Adding, updating and deleting privileges are for administrative use only. For access to product management, please <a href=\"/acme/products/\">click here</a></p>";
                }
            ?>
            
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>