<?php

function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail,FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    return preg_match($pattern, $clientPassword);
}

function writeNav($categories) {
 $navList = '<ul>';
 $navList .= "<li><a href='/acme/' title='View the Acme home page'>Home</a></li>";
 foreach ($categories as $category) {
  $navList .= "<li><a href='/acme/products/?action=category&categoryName=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
 $navList .= '</ul>';
 
 return $navList;
}

function getFeaturedInfo() {
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invFeatured = 1';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}

//Build a display of Products with an Unordered List
function buildProductsDisplay($products){
 $pd = '<ul id="prod-display">';
 foreach ($products as $product) {
  $pd .= '<li>';
  $pd .= "<a href='/acme/products/?action=details&invId=".urlencode($product['invId'])."'><img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
  $pd .= '<hr>';
  $pd .= "<a href='/acme/products/?action=details&invId=".urlencode($product['invId'])."'><h2>$product[invName]</h2></a>";
  $pd .= "<span>$product[invPrice]</span>";
  $pd .= '</li>';
 }
 $pd .= '</ul>';
 return $pd;

 }
 
 //Build a display of Product Details
 function wrapProductDetails($details) {
     $det = "<h1>$details[invName]</h1>";
     $det .= '<div id="detailDisplay">';
     $det .= "<img src='$details[invImage]' alt='Image of $details[invName] on Acme.com'>";
     $det .= "<p>$details[invDescription]</p>";
     $det .= '<br>';
     $det .= "<p>A $details[invVendor] product</p>";
     $det .= "<p>Primary material: $details[invStyle]</p>";
     $det .= "<p>Product weight: $details[invWeight]</p>";
     $det .= "<p>Shipping Size: $details[invSize]</p>";
     $det .= "<p>Ships from $details[invLocation]</p>";
     $det .= '<br>';
     $det .= "<p>Number in stock: $details[invStock]</p>";
     $det .= '<br>';
     $det .= "<h3>$details[invPrice]</h3>";
     $det .= '</div>';
     return $det;
 }
 
 //Builds featured section of the homepage
 function buildFeatured($prodInfo) {
     $featureBuild = '<div id="featured">';
     $featureBuild .= "<img src='$prodInfo[invImage]' alt='featured image'>";
     $featureBuild .= '<div id="descrip">';
     $featureBuild .= "<p>$prodInfo[invDescription]</p>";
     $featureBuild .= "<img id='actionbtn' alt='Add to cart button' src='images/site/iwantit.gif'>";
     $featureBuild .= "</div>";
     $featureBuild .= "</div>";
     return $featureBuild;
 }