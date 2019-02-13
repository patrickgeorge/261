<?php

/* 
 * Products Controller
 */

// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 // Get the products model
 require_once '../model/products-model.php';
 // Get the functions file
 require_once '../library/functions.php';
 
 //Create or access a session
 session_start();
 
  // Get the array of categories
$categories = getCategories();

$navList = writeNav($categories);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
  switch ($action){
 case 'product':
  include '../view/add-product.php';
  break;
 case 'cat':
  include '../view/add-category.php';
  break;
 case 'newCategory':
     $catName = filter_input(INPUT_POST, 'categoryName');
     
     if (empty($catName)) {
         $message = "<p>Please fill in the empty form field</p>";
          include '../view/add-category.php';
     exit; 
     }
     
     $catOutcome = insertCategory($catName);
     
     if ($catOutcome === 1) {
         header('Location: /acme/products/index.php');
         exit;
     } else {
         $message = "<p> Insertion failed. Please try again.</p>";
         include '../view/add-category.php';
         exit;
     }
 case 'newProduct':
     $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
     $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
     $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
     $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
     $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
     $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
     $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
     $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
     $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
     $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
     $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
     $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
     

     
     if(empty($invDescription) || empty($invName) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)){
    $message = '<p>Please provide information for all empty form fields.</p>';
    include '../view/add-product.php';
    exit; 
         }
    $productOutcome = insertProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);

    if($productOutcome === 1){
    $message = "<p>Thanks for adding a new product to our line!.</p>";
    include '../view/add-product.php';
     exit;
    } else {
    $message = "<p>Sorry, but the update failed. Please try again.</p>";
    include '../view/add-product.php';
    exit;
}

case 'mod':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $prodInfo = getProductInfo($invId);
    if(count($prodInfo)<1){
    $message = 'Sorry, no product information could be found.';
    }
    include '../view/prod-update.php';
    exit;
    break;

case 'feature':
     $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $prodInfo = getProductInfo($invId);
    
    if (count($prodInfo)<1){
    $message = 'Sorry, no product information could be found.';
    $_SESSION['message'] = $message;
    }
    
    $noFeature = clearFeature();
    
    if (!$noFeature){
        $message = 'Feature clear failed. Sorry.';
        $_SESSION['message'] = $message;
    } else {
        $message = "<p>Previously featured item $noFeature[invName] cleared</p>";
        $_SESSION['message'] = $message;
    }
    
    $itemFeatured = featureItem($invId);
    
    if (!$itemFeatured) {
        $message = "<p>Feature process failed.</p>";
        $_SESSION['message'] = $message;
    } else {
        $message = "<p>$prodInfo[invName] has been featured.</p>";
        $_SESSION['message'] .= $message;
    }
    
    header('location: /acme/products/');
     break;
    
case 'updateProd':
     $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
     $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
     $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
     $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
     $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
     $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
     $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
     $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
     $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
     $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
     $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
     $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
     $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

     
     if(empty($invDescription) || empty($invName) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)){
    $message = '<p>Please provide information for all empty form fields.</p>';
    include '../view/prod-update.php';
    exit; 
         }
    $updateResult = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId);

    if ($updateResult === 1) {
        $message = "<p class='notice'>Congratulations, $invName was successfully updated.</p>";
        $_SESSION['message'] = $message;
        header('location: /acme/products/');
        exit;
    } else {
    $message = "<p class='notice'>Sorry, but the update to $invName failed. Please try again.</p>";
    include '../view/prod-update.php';
    exit;
}
    break;

case 'del':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $prodInfo = getProductInfo($invId);
    if(count($prodInfo)<1){
    $message = 'Sorry, no product information could be found.';
    }
    include '../view/prod-delete.php';
    exit;
    break; 
    
case 'deleteProd':
     $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
     $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteProduct($invId);

    if ($deleteResult) {
        $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
        $_SESSION['message'] = $message;
        header('location: /acme/products/');
        exit;
    } else {
    $message = "<p class='notice'>Sorry, the deletion of $invName failed. Please try again</p>";
        $_SESSION['message'] = $message;
        header('location: /acme/products/');
        exit;
    exit;
}
    break; 
    
 case 'category':
     $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
    $products = getProductsByCategory($categoryName);
    
    if(!count($products)){
        $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
    } else {
        $prodDisplay = buildProductsDisplay($products);
    }
    include '../view/category.php';
     break;
     
 case 'details':
     $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
     $details = getProductDetails($invId);
     
     if (!count($details)) {
         $message = "<p class='notice'>Sorry, no information about $invId could be found</p";
     } else {
         $detailDisplay = wrapProductDetails($details);
     }
     
     include '../view/product-detail.php';
     break;
     
 default:
     $products = getProductBasics();
     if(count($products) > 0){
  $prodList = '<table id="productTable">';
  $prodList .= '<thead>';
  $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
  $prodList .= '</thead>';
  foreach ($products as $product) {
   $prodList .= "<tr><td>$product[invName]</td>";
   $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
   $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td>";
   $prodList .= "<td><a href='/acme/products?action=feature&id=$product[invId]' title='Click to feature'>Feature</a></tr>";
  }
   $prodList .= '</table>';
  } else {
   $message = '<p class="notify">Sorry, no products were returned.</p>';
}
  include '../view/product-management.php';
  break;
  }