<?php 


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $linkedin = $_POST['linkedin'];
   
    $errors = []; 

   // validate name required 
    if(empty($name)){   
          $errors['name'] = 'Field is Required';
    } 

    // validate email required 
      if(empty($email)){
          $errors['email'] = 'Field is Required';
      }

   // validate linkedin required 
      if(empty($linkedin)){
          $errors['linkedin'] = 'Field is Required';
      }
      
      //checking length of the name field
      if(strlen($name) < 3 && strlen($name) > 0 ){
           $errors['name'] = 'Minimum Length is 3';
    }
    if(strlen($name) > 20){
        $errors['name'] = 'Maximum Length is 20';
 }
     //checking if the name is string typed
    if(is_numeric($name)){
        $errors['name'] = 'Name Must be Letters';
    }
    
    //chech if linkedin url is typed right or wrong
    if(str_contains($linkedin,'linkedin.com')){
        echo 'thanks for your registering ';
    }
    elseif(str_contains($linkedin,'www.linkedin.com')){
        echo 'thanks for your registering ';
    }elseif(str_contains($linkedin,'www.linkedin.com')){
        echo 'thanks for your registering ';
    }else{
        $errors['linkedin'] = 'Please Enter The Right URL';
    }
        // checking error of required values
       if(count($errors) > 0){

           foreach ($errors as $key => $value) {
               echo $key.' : '.$value.'<br>';
           }
       }else{
              echo 'Mr / Miss : '.$name.' || Your Email Is : '.$email.' || linkedin : '.$linkedin.'<br>';
       }

       

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2>
               <!-- action.php -->
        <form  method="post"  action="<?php echo $_SERVER['PHP_SELF'];?>">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control"   name="name"  id="exampleInputName" aria-describedby="" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" name="email"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Linkedin Account</label>
                <input type="text" class="form-control"  name="linkedin"  id="exampleInputPassword1" placeholder="Enter Your Linkedin Account">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>