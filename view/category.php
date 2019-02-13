<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device+width, initial-scale=1.0">
        <title><?php echo $categoryName; ?> Products | Acme, Inc.</title>
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
            <h1><?php echo $categoryName; ?> Products</h1>
            
            <?php if(isset($message)){
                echo $message; } 
            ?>
            
            <?php if(isset($prodDisplay)){ 
                echo $prodDisplay; 
            } ?>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>