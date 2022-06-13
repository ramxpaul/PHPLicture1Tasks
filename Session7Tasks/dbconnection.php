<?php 

session_start();

$server = "localhost";
$username = "root";
$password = "";
$database = "blogdb";

try{
    $conn = mysqli_connect($server,$username,$password,$database);
    if(!$conn){
         throw new Exception('There is No Connection' . mysqli_connect_error());
    }
}catch(Exception $ex){
    echo $ex->getMessage();
}



?>