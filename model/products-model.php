<?php

/* 
 *Products Model
 */

function insertCategory($catName) {
    $db = acmeConnect();
    $sql = 'INSERT INTO categories (categoryName) VALUES (:catName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':catName', $catName, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function insertProduct($catId, $invName, $invDescription, $invImage, $invThumbnail,
        $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle) {
    $db = acmeConnect();
    $sql = 'INSERT INTO inventory (categoryId, invName, invDescription, invImage, invThumbnail,
        invPrice, invStock, invSize, invWeight, invLocation, invVendor, invStyle) 
        VALUES (:catId, :invName, :invDescription, :invImage, :invThumbnail,
        :invPrice, :invStock, :invSize, :invWeight, :invLocation, :invVendor, :invStyle)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':catId', $catId, PDO::PARAM_STR);
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    $stmt->execute();
     $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Gets basic product information from the inventory table for starting an update or delete process
function getProductBasics() {
    $db = acmeConnect();
 $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

// Get product information by invId
function getProductInfo($invId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}
//Update Product
function updateProduct($catId, $invName, $invDescription, $invImage, $invThumbnail,
        $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId) {
    $db = acmeConnect();
    $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, '
            . 'invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, '
            . 'invStock = :invStock, invSize = :invSize, invWeight = :invWeight, '
            . 'invLocation = :invLocation, categoryId = :catId, invVendor = :invVendor, '
            . 'invStyle = :invStyle WHERE invId = :invId'; 
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':catId', $catId, PDO::PARAM_STR);
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
     $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Delete Product
function deleteProduct($invId) {
    $db = acmeConnect();
 $sql = 'DELETE FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}

//Get list of products based on category
function getProductsByCategory($categoryName){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

//Get information on a specific product
function getProductDetails($invId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $details = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $details;
}

//Clear featured aspect from product
function clearFeature(){
 $db = acmeConnect();
 $sql = 'SELECT invName FROM inventory WHERE invFeatured = 1';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $invName = $stmt->fetch(PDO::FETCH_ASSOC);
 $sql2 = 'UPDATE inventory SET invFeatured = NULL WHERE invFeatured = 1';
 $stmt2 = $db->prepare($sql2);
 $stmt2->execute();
 $stmt2->closeCursor();
 return $invName;
}

//Feature an item
function featureItem($invId) {
 $db = acmeConnect();
 $sql = 'UPDATE inventory SET invFeatured = 1 WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}