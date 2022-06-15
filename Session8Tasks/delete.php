<?php
require 'dbconnection.php';

$id = $_GET['id'];

$sqlCommand = "delete from pageitems where id=$id";
$operation = mysqli_query($conn,$sqlCommand);

if($operation){
    $message = 'Row Deleted';
}else{
    $message = 'Error Occurred'.mysqli_error($conn);
}

require 'closeConnection.php';
 $_SESSION['message'] = $message;
 header("Location: display.php")
?>