<?php
    
    // Using the REST API in order to consume the data
    
    if(isset($_GET['action']) && !empty($_GET['action']))
    {
        $action = $_GET['action'];
        $url = "http://localhost/projects/EmpAPI/app/empDir_API.php?action=$action";
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
    }

    // Using the REST API to Create an Employee from the third party APP

    else if(isset($_POST['emp'],$_POST['action']) && !empty($_POST['action']) && !empty($_POST['emp']))
    {
        $url = "http://localhost/projects/EmpAPI/app/empDir_API.php";
        $client = curl_init($url);
        $emp = $_POST['emp'];
        curl_setopt($client,CURLOPT_POST,1);
        curl_setopt($client,CURLOPT_POSTFIELDS,"emp=$emp");
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    }

    // Manipulation of responses

    $resource = curl_exec($client);
    if(!empty($resource))
    {
        echo $resource;
    }
    else
    {
        echo "Empty Resources";
    }
?>