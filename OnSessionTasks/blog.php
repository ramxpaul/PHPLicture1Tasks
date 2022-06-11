<?php 
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title     = $_POST['title'];
    $content    = $_POST['content'];
   
    $errors = []; 

   // validate name 
    if(empty($title)){   
          $errors['title'] = 'Field is Required';
    }
    // validate email
      if(empty($content)){
          $errors['content'] = 'Field is Required';
      }elseif(strlen($content) < 30){
          $errors['content'] = 'content must be 30 letters or more';
      }

        // checking error of required values
       if(count($errors) > 0){

           foreach ($errors as $key => $value) {
               echo $key.' : '.$value.'<br>';
           }
       }else{
        $_SESSION['blogData'] = [
            'title' => $title,
            'content' => $content];
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
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control"   name="title"  id="exampleInputName" aria-describedby="" placeholder="Enter Title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <input type="text" class="form-control" name="content"  id="exampleInputEmail1"  placeholder="Enter Content">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>