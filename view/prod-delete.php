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
        <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName] ";} 
                elseif(isset($invName)) { echo $invName; }?> | Acme, Inc</title>
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
                <?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName] ";} 
                elseif(isset($invName)) { echo $invName; }?> 
            </h1>
            <div>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
            </div>
            <div id="form">
            <form method="post" action="/acme/products/index.php">
                <label for="invDescription">Inventory Description: </label>
                <textarea name="invDescription" id="invDescription" readonly><?php if(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; } ?></textarea>
                <label for="invName">Inventory Name: </label>
                <input type="text" name="invName" id="invName" readonly <?php if(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }  ?>>
                <input type="submit" value="Delete Product">
                
                <input type="hidden" name="action" value="deleteProd">
                <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} 
                        elseif(isset($invId)){ echo $invId; } ?>"> 
            </form>
          </div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>