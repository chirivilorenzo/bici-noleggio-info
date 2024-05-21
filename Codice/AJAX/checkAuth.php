<?php

header("Content-Type: application/json");

if(!isset($_SESSION)) session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_SESSION["idCliente"]) || isset($_SESSION["idAdmin"])){
        echo json_encode(array("status"=> "success", "code"=> 200));
    }
    else{
        echo json_encode(array("status"=> "error"));
    }
}
else{
    echo json_encode(array("status"=> "error"));
}