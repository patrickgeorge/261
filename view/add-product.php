<?php
 $catList = '<select name="categoryId" id="catList">';
 $catList .= "<option>Choose A Catergory</option>";
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'";
    if (isset($categoryId)) {
        
        if ($category['categoryId'] === $categoryId) {
            $catList .= " selected ";
        }
    }
    
    $catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device+width, initial-scale=1.0">
        <title>Add Product</title>
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
                Add Product
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
                <textarea name="invDescription" id="invDescription" required><?php if(isset($invDescription)){echo $invDescription;}  ?></textarea>
                <label for="invName">Inventory Name: </label>
                <input type="text" name="invName" id="invName" required <?php if(isset($invName)){echo "value='$invName'";}  ?>>
                <label for="invImage">Inventory Image: </label>
                <input type="text" name="invImage" id="invImage" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>>
                <label for="invThumbnail">Inventory Thumbnail</label>
                <input type="text" name="invThumbnail" id="invThumbnail" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?>>
                <label for="invPrice">Inventory Price: </label>
                <input type="number" step="0.01" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>>
                <label for="invStock">Inventory Stock: </label>
                <input type="number" name="invStock" id="invStock" required <?php if(isset($invStock)){echo "value='$invStock'";}  ?>>
                <label for="invSize">Inventory Size: </label>
                <input type="number" name="invSize" id="invSize" required <?php if(isset($invSize)){echo "value='$invSize'";}  ?>>
                <label for="invWeight">Inventory Weight: </label>
                <input type="number" name="invWeight" id="invWeight" required <?php if(isset($invWeight)){echo "value='$invWeight'";}  ?>>
                <label for="invLocation">Inventory Location: </label>
                <input type="text" name="invLocation" id="invLocation" required <?php if(isset($invLocation)){echo "value='$invLocation'";}  ?>>
                <label>Category Type: </label>
                <?php echo $catList; ?> 
                <label for="invVendor">Inventory Vendor: </label>
                <input type="text" name="invVendor" id="invVendor" required <?php if(isset($invVendor)){echo "value='$invVendor'";}  ?>>
                <label for="invStyle">Inventory Style: </label>
                <input type="text" name="invStyle" id="invStyle" required <?php if(isset($invStyle)){echo "value='$invStyle'";}  ?>>
                <input type="submit" value="Create">
                
                <input type="hidden" name="action" value="newProduct">
            </form>
          </div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>