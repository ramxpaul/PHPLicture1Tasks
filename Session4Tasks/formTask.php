<?php 

function clean($input){
       
    return strip_tags(stripslashes(trim($input))); 

}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $linkedin = $_POST['linkedin'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
   
    $errors = []; 

   // validate name 
    if(empty($name)){   
          $errors['name'] = 'Field is Required';
    }elseif(!ctype_alpha(trim(str_replace(' ','',$name)))){
        $errors['name'] = 'Name must Be Letters Typed';
    }
    // validate email
      if(empty($email)){
          $errors['email'] = 'Field is Required';
      }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          $errors['email'] = 'Please Enter Email Like (example@company.com)';
      }

      //validate password
      if(empty($password)){
          $errors['password'] = 'Field is Required';
      }elseif(strlen($password) < 6){
        $errors['password'] = 'Minimum Length is 6';
      }

      //validate address
      if(empty($address)){
        $errors['address'] = 'Field is Required';
    }elseif(strlen($address) != 10){
      $errors['address'] = 'The Address Must be 10 Characters only (no more / no less)';
    }

   // validate linkedin 
      if(empty($linkedin)){
          $errors['linkedin'] = 'Field is Required';
      }elseif(!filter_var($linkedin,FILTER_VALIDATE_URL)){

        $errors['linkedin'] = 'Make Sure You Entered the right url format';
      }

      // validate gender
      if(empty($gender)){
          $errors['gender'] = 'please choose your gender';
      }
      //file upload and validate
if (!empty($_FILES['upload']['name'])) {

    $tempName  = $_FILES['upload']['tmp_name'];
    $imageName = $_FILES['upload']['name'];
    $imageType = $_FILES['upload']['type'];

    $extensionArray = explode('/', $imageType);
    $extension =  strtolower( end($extensionArray));

    $allowedExtensions = ['pdf'];

    if (in_array($extension, $allowedExtensions)) {

        $finalName = uniqid() . time() . '.' . $extension;

        $distPath = 'uploads/' . $finalName;

        if (move_uploaded_file($tempName, $distPath)) {
            echo 'File Uploaded<br>';
        } else {
            echo 'Failed to Upload<br>';
        }
    } else {
        echo 'File Type Not Allowed<br>';
    }
} else {
    echo 'Please Select File<br>';
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
        <form  method="post"  action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control"   name="name"  id="exampleInputName" aria-describedby="" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="text" class="form-control" name="email"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Password</label>
                <input type="password" class="form-control" name="password"  id="exampleInputPassword"  placeholder="Enter Your Password">
            </div>

            <div class="form-group">
                <label for="exampleInputLinkedin">Linkedin Account</label>
                <input type="text" class="form-control"  name="linkedin"  id="exampleInputLinkedin" placeholder="Enter Your Linkedin Account">
            </div>

            <div class="form-group">
                <label for="exampleInputAddress">ِAddress</label>
                <input type="text" class="form-control"  name="address"  id="exampleInputAddress" placeholder="Enter Your Address">
            </div>

            <div class="form-group">
                <label for="exampleInputMale">Male</label>
                <input type="radio" name="gender"  id="exampleInputMale">
            </div>

            <div class="form-group">
                <label for="exampleInputFemale">Female</label>
                <input type="radio" name="gender"  id="exampleInputFemale">
            </div>

            <div class="form-group">
                <label for="exampleInputUpload">Upload</label>
                <input type="file" name="upload"  id="exampleInputUpload">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>