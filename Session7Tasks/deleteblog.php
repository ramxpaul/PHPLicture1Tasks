<?php 
require 'dbconnection.php';

//getting id from the url 
$id = $_GET['id'];

//Operation to delete
$sqlCommand = "delete from blog where id=$id";
$operation = mysqli_query($conn,$sqlCommand);

if($operation){
    $message = 'Record Deleted Successfully';
}else{
    $message = 'Error Occured Please Try Again'.mysqli_error($conn);
}

//setting the message to session
$_SESSION['message'] = $message;
 header("Location: indexblog.php");

?>