<?php

 
// files needed to connect to database
include_once 'config/database.php';
include_once("objects/user.php");
 
$database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));
 


// set product property values
$user->firstname = $data->firstname;
$user->email = $data->email;
$user->password = $data->password;
$user->lastname = $data->lastname;

var_dump($user); 
// create the user
if(
    !empty($user->firstname) &&
    !empty($user->email) &&
    !empty($user->password) &&
    $user->create()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "User was created."));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to create user."));
}
?>