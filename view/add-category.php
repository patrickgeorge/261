<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device+width, initial-scale=1.0">
        <title>Add Category</title>
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
                Add Category
            </h1>
            <form method="post" action="/acme/products/index.php">
                <label for="categoryName">New Category Name: </label>
                <input type="text" name="categoryName" id="categoryName" required>
                <input type="submit" value="Create">
                
                <input type="hidden" name="action" value="newCategory">
            </form>
            <div>
            <?php
                if (isset($message)) {
                  echo $message;
                }
            ?>
            </div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>