<!DOCTYPE html>
<html lang="en">
    <head >
        <meta name="viewport" content="width=device+width, initial-scale=1.0">
        <title>Register</title>
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
                Register Now!!
            </h1>
            <div id="form">
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                
                <form method="post" action="/acme/accounts/index.php">
                    <label for="clientFirstname">First Name: </label><input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br>
                    <label for="clientLastname">Last Name: </label><input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required><br>
                    <label for="clientEmail">Email address: </label><input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
                    <label for="clientPassword">Password: </label>
                    <span>Password must be 8 characters long, contain one uppercase letter, one number and one special character.</span>
                    <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                <input type="submit" value="Register">
                
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="register">
            </form>
            </div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>