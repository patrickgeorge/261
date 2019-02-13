<?php
if (!$_SESSION['loggedin'] == TRUE) {
    header('Location: /acme/');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device+width, initial-scale=1.0">
        <title>Update Account</title>
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
                Update Account
            </h1>
            
            
            <div id="client-update">
                
                <h2>Account Info</h2>
                
            <div id="updateAccount">
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                
                <form method="post" action="/acme/accounts/index.php">
                    <label for="clientFirstname">First Name: </label><input type="text" name="clientFirstname" id="clientFirstname" value="<?php if(isset($clientFirstname)){echo $clientFirstname;} 
                            elseif(isset($_SESSION['clientData']['clientFirstname'])) {echo $_SESSION['clientData']['clientFirstname']; } ?>" required><br>
                    <label for="clientLastname">Last Name: </label><input type="text" name="clientLastname" id="clientLastname" value="<?php if(isset($clientLastname)){echo $clientLastname;} 
                            elseif(isset($_SESSION['clientData']['clientLastname'])) {echo $_SESSION['clientData']['clientLastname']; } ?>" required><br>
                    <label for="clientEmail">Email address: </label><input type="email" name="clientEmail" id="clientEmail" value="<?php if(isset($clientEmail)){echo $clientEmail;} 
                            elseif(isset($_SESSION['clientData']['clientEmail'])) {echo $_SESSION['clientData']['clientEmail']; } ?>" required>                
                <!-- Add the action name - value pair -->
                <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
                        elseif(isset($clientId)){ echo $clientId; } ?>">
                <input type="hidden" name="action" value="updateAccount"> 
                <input type="submit" value="Update Account">
            </form>
            </div>
            
            
            <h2>New Password</h2>
            <div id="password">
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                
                <form method="post" action="/acme/accounts/index.php">
                    <span>Entering a password here will change the current password. Password must not be the same as the old password. Password must be 8 characters long, contain one uppercase letter, one number and one special character.</span>
                    <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>
                <input type="submit" value="Update Password"><!--
                
                 Add the action name - value pair 
-->                <input type="hidden" name="action" value="newPassword">
                <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
                        elseif(isset($clientId)){ echo $clientId; } ?>"> 
            </form>
            </div>
            </div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>