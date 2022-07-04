<?php
define("ROOTFOLDER", "PHP_tutorials/CURL_REST_API");
function site_url()
{

    $link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/" . ROOTFOLDER;

    return $link;
}
function CallAPI($api_method, $api_url, $data)
{
    $curl = curl_init($api_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, 
    array('Authorization: Bearer ee'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    switch ($api_method) {
        case "GET":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($curl, CURLOPT_POST, true);
            break;
        case "POST":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POST, true);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POST, true);
            break;
        case "DELETE":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_POST, true);
            break;
    }
    $curl_response = curl_exec($curl);
    curl_close($curl);
    return $curl_response;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CURL with REST API structure</title>
</head>

<body>
    <h1>CURL with REST API structure</h1>
    <?php
    $api_method = "GET";
    $api_url = site_url() . "/tasks/1";
    $data = null;
    echo CallAPI($api_method, $api_url, $data) . "<br /><br />";

    $api_method = "GET";
    $api_url = site_url() . "/tasks";
    $data = null;
    echo CallAPI($api_method, $api_url, $data) . "<br /><br />";

    $api_method = "PUT";
    $api_url = site_url() . "/tasks/1";
    $data = array("Title" => "Mr.", "FName" => "Soumyanjan");
    echo CallAPI($api_method, $api_url, $data) . "<br /><br />";

    $api_method = "DELETE";
    $api_url = site_url() . "/tasks/1";
    $data = null;
    echo CallAPI($api_method, $api_url, $data) . "<br /><br />";

    $api_method = "POST";
    $api_url = site_url() . "/tasks";
    $data = array("Title" => "Mr.", "FName" => "Soumyanjan");
    echo CallAPI($api_method, $api_url, $data) . "<br /><br />";

    $api_method = "POST";
    $api_url = site_url() . "/tasks/1";
    $data = array("Title" => "Mr.", "FName" => "Soumyanjan");
    echo CallAPI($api_method, $api_url, $data) . "<br /><br />";
    ?>
</body>

</html>