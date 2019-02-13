<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device+width, initial-scale=1.0">
        <title>Login</title>
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
                Login
            </h1>
            <div id="form">
                <?php
                    if (isset($message)) {
                      echo $message;  
                    } elseif (isset($_SESSION['message'])) {
                     echo $_SESSION['message'];
                    }
                ?>
                <form action="/acme/accounts/" method="post">
                <label for="clientEmail">Email address: </label><input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
                <label for="clientPassword">Password: </label>
                <span>Password must be 8 characters long, contain one uppercase letter, one number and one special character.</span>
                <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                <input type="submit" value="Login">
                <input type="hidden" name="action" value="Logging">
            </form>
            
                <div id="register">
            <p>Not Registered? Click Here!</p>
            <a href="/acme/accounts/index.php?action=registration">Register</a>
                </div>
            </div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>