<?php

/*
 * Accounts Controller
 */

// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 // Get the accounts model
 require_once '../model/accounts-model.php';
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
 case 'login':
  include '../view/login.php';
  break;
 case 'registration':
  include '../view/registration.php';
  break;
 case 'register':
  // Filter and store the data
$clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
$clientEmail = checkEmail($clientEmail);
$checkPassword = checkPassword($clientPassword);

//Check for preexisting email address
$existingEmail = emailConfirmation($clientEmail);

// Check for existing email address in the table
if($existingEmail){
 $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
 include '../view/login.php';
 exit;
}

// Check for missing data
if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
 $message = '<p>Please provide information for all empty form fields.</p>';
 include '../view/registration.php';
 exit; 
}

// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

// Send the data to the model
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

// Check and report the result
if($regOutcome === 1){
 $_SESSION['message'] = "Thanks for registering, $clientFirstname. Please use your email and password to login.";
 setcookie("firstname", $clientFirstname, strtotime('+1 year'), '/');
 include '../view/login.php';
 exit;
} else {
 $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
 include '../view/registration.php';
 exit;
}
  break;
 case 'Logging':

     $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
     $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
     $clientEmail = checkEmail($clientEmail);
     $checkPassword = checkPassword($clientPassword);
     
     if (empty($clientEmail) || empty($checkPassword)){
          $message = '<p>Please provide information for all empty form fields.</p>';
          include '../view/login.php';
          exit;
     } 
     // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    
    //Delete cookie
    setcookie("firstname", "", strtotime('-3600'), '/');
    
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    include '../view/admin.php';
    exit;
 case 'Logout':
     session_destroy();
     header('Location: /acme/');
     exit;
     break;
 case 'adminView':
     include "../view/admin.php";
     break;
 case 'accountView':
     include '../view/client-update.php';
     break;
 case 'updateAccount':
     $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    
    $existingEmail = emailConfirmation($clientEmail);
    
    if ($clientEmail == $_SESSION['clientData']['clientEmail']) {
        $message = '<p>That email is taken. Please choose another.</p>';
          include '../view/client-update.php';
          exit;
    } elseif ($existingEmail) {
        $message = '<p>That email is taken. Please choose another.</p>';
          include '../view/client-update.php';
          exit;
    } else {
    }
    
    
    
    if(empty($clientEmail)){
        $message = '<p>Please provide an email address.</p>';
        include '../view/client-update.php';
        exit; 
    }
    
    $newInfo = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);
    
    $clientUpdatedData = getClientUpdate($clientId);
    
    $_SESSION['clientData'] = $clientUpdatedData;
    
    if($newInfo === 1){
        $message = "<p class='notice'>Account info successfully changed.</p>";
        include '../view/admin.php';
        exit;
    } else {
        $message = "<p>Sorry $clientId, but the update failed. Please try again.</p>";
        include '../view/admin.php';
        exit;
    }
    
    include '../view/admin.php';
     break;
 case 'newPassword':
     $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
     
    $checkPassword = checkPassword($clientPassword);
    // If the password doesn't match, create an error
    if(!$checkPassword) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/client-update.php';
        exit;
    } else {
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    }
    
    $passwordResults = passUpdate($hashedPassword, $_SESSION['clientData']['clientId']);
    
    if ($passwordResults) {
        $message = "<p>Password successfully changed</p>";
        include '../view/admin.php';
        exit;
    } else {
        $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
        include '../view/admin.php';
        exit;
    }
     break;
 default:
     include '../view/admin.php';
}
