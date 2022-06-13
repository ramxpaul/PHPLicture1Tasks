
<?php

//calling db connection
require 'dbconnection.php';

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
            $sqlInsCommand = "insert into blog (image) values ('$finalName')";
        }else{
            echo 'Failed to Upload<br>';
        }
    }else{
        echo 'File Type Not Allowed<br>';
    }

}else{
    echo 'Please Select File<br>';
}

//requesting the date from db to edit it
$id = $_GET['id'];
$sqlReadCommand = "select * from blog where id = $id";
$resObj = mysqli_query($conn,$sqlReadCommand);
$singleDataRow = mysqli_fetch_assoc($resObj);

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

  

  if(count($errors) > 0){
    foreach($errors as $errkey => $errValue){
        echo $errkey.' : '.$errValue.'<br>'; 
    }
  }else{   
    $sqlUpdCommand = "update blog set title='$title', content ='$content', image='$$finalName' where id='$id'";
    $UpdateOperation = mysqli_query($conn,$sqlUpdCommand);

    if($UpdateOperation){
        $message = 'Success, Your Blog Data Updated';
        $_SESSION['message'] = $message;
        header('Location: indexblog.php');
        exit();
    }else{
        echo "Failed, ".mysqli_error($conn);
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

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$singleDataRow['id'] ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputTitle">Title</label>
                <input type="text" class="form-control" required id="exampleInputTitle" aria-describedby="" name="title" value="<?php echo $singleDataRow['title']; ?>" placeholder="Enter Title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <input type="text" class="form-control" required id="exampleInputContent" name="content" value="<?php echo $singleDataRow['content']; ?>" placeholder="Enter Content">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Image Upload</label>
                <input type="file" class="form-control" required id="exampleInputImage" name="image" value="<?php echo "<img src='./uploads/$singleDataRow[image]' alt=''  height='60px' width='60px'>" ?>">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>