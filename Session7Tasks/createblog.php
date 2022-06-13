
<?php

//calling db connection
require 'dbconnection.php';

// Clean Input Fuctions
function clean($input){
    return stripslashes(strip_tags(trim($input)));
}


if($_SERVER['REQUEST_METHOD'] == "POST")
  $title = clean($_POST['title']);
  $content = clean($_POST['content']);

  //validating
  $errors = [];

  //title validation
  if(empty($title)){
    $errors['title'] = 'Field Required';
  }elseif(!ctype_alpha(trim(str_replace(' ','',$title)))){
    $errors['title'] = 'Title must be in Letters';
  }
  //content validation
  if(empty($content)){
    $errors['content'] = 'Field Required';
  }elseif(strlen($content) < 50){
    $errors['content'] = 'Content must be at least 50 Letters';
  }

  //file create and validate
  if(!empty($_FILES['image']['name'])){
    $tempName = $_FILES['image']['tmp_name'];
    $imgName = $_FILES['image']['name'];
    $imgType = $_FILES['image']['type'];

    $extensionArray = explode('/',$imgType);
    $extension = strtolower(end($extensionArray));

    $allowedExtensions = ['jpeg','jpg','png','gif'];

    if(in_array($extension,$allowedExtensions)){
        $finalName = uniqid().time().'.'.$extension;
        $distPath = 'uploads/'.$finalName;

        if(move_uploaded_file($tempName,$distPath)){
            echo 'File Uploaded<br>';
        }else{
            echo 'Failed to Upload<br>';
        }
    }else{
        echo 'File Type Not Allowed<br>';
    }

}else{
    echo 'Please Select File<br>';
}

  if(count($errors) > 0){
    foreach($errors as $errkey => $errValue){
        echo $errkey.' : '.$errValue.'<br>'; 
    }
  }else{   
    $sqlCommand = "insert into blog (title,content,image) values('$title','$content','$finalName')";
    $operation = mysqli_query($conn,$sqlCommand);

    if($operation){
        echo 'Success, Blog Data Added';
    }else{
        echo 'Failed, '.mysqli_error($conn);
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

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputTitle">Title</label>
                <input type="text" class="form-control" required id="exampleInputTitle" aria-describedby="" name="title" placeholder="Enter Title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <input type="text" class="form-control" required id="exampleInputContent" name="content" placeholder="Enter Content">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Image Upload</label>
                <input type="file" class="form-control" required id="exampleInputImage" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>