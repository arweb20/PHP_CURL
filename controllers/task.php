<?php
include ("../header_config.php");
error_reporting(1);
$headers = getallheaders();
$apikey= $headers['Authorization'];
echo $headers['APIk'];
if (array_key_exists("taskid", $_GET)) {

    $task_id = $_GET['taskid'];
    if ($_SERVER['REQUEST_METHOD'] === "GET") {        
        if($apikey == "Bearer ee"){
            http_response_code(200);
            $response['statusCode'] = 200;
            $response['message'] = "Get method called for single data";
            $response['task_id'] = $apikey ." ".$task_id;
           
        }else{
            http_response_code(205);
        $response['statusCode'] = 205;
        $response['message'] = "Get method called for single data";
        $response['task_id'] = "Failed to token".$apikey ; 
        }       
    } 
    else if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
        http_response_code(200);
        $response['statusCode'] = 200;
        $response['message'] = "Delete method called";
        $response['task_id'] = $task_id;
    } 
    else if ($_SERVER['REQUEST_METHOD'] === "PUT") {
        http_response_code(200);
        $getData=json_decode(file_get_contents("php://input"), true);
        $response['statusCode'] = 200;
        $response['message'] = "Put method called";
        $response['task_id'] = $task_id;
        if($getData != null){
            $response['result'] = $getData;
        }  
    }
     else {
        http_response_code(405);
        $response['statusCode'] = 405;
        $response['message'] = "Request method not allowed";
    }
}

elseif (empty($_GET)) {
    if ($_SERVER['REQUEST_METHOD'] === "GET") {
        http_response_code(200);
        $response['statusCode'] = 200;
        $response['message'] = "Get method called for all the lists";
    } 
    elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
        http_response_code(201);
        $getData=json_decode(file_get_contents("php://input"), true);
        $response['statusCode'] = 201;
        $response['message'] = "Post method called";
        if($getData != null){
            $response['result'] = $getData;
        }       
    } 
    else {
        http_response_code(405);
        $response['statusCode'] = 405;
        $response['message'] = "Request method not allowed";
    }
} 

else {
    http_response_code(405);
    $response['statusCode'] = 405;
    $response['message'] = "Request method not allowed";
}
echo json_encode($response);