<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device+width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/acme/css/acme_stylesheet.css" title="stylesheet">
        <title>Error!</title>
    </head>
    <body>
        <div id="content">
       <div id="header">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/header.php'; ?>
        </header> 
           <div id="nav">
             <nav>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/nav.php'; ?>
             </nav>
           </div>
       </div>
        <main>
            <h1>
                Server Error
            </h1>
            <p>Sorry, the server experienced a problem :/</p>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>