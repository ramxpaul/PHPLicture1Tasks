<?php 

session_start();

$server = "localhost";
$database = "pageviews";
$username = "root";
$password = "";

try{
    $conn = mysqli_connect($server,$username,$password,$database);
    if(!$conn){
        throw new Exception('Error Occured When Try To Connect'.mysqli_connect_error());
    }
}catch(Exception $ex){
    echo $ex->getMessage();
}

?>