<?php 
session_start();

function clean($input){
    return strip_tags(stripslashes(trim($input)));
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = clean($_POST['title']);
    $content = clean($_POST['content']);
}

$errors = [];

// Validating Title
if(empty($title)){
    $errors['title'] = 'Field is Required';
}elseif(!ctype_alpha(trim(str_replace(' ','',$title)))){
    $errors['title'] = 'Name Must Be Letters Typed';
}

// Validating Content
if(empty($content)){
    $errors['content'] = 'Field is Required';
}elseif(strlen($content) < 50){
    $errors['content'] = 'Contnet must be 50 Characters or more';
}

// Validating And Making File Upload
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
    foreach($errors as $key => $value){
        echo $key.' : '. $value.'<br>';
    }
}else{
    $_SESSION['blogDiplay'] = [
        'title' => $title,
        'content' => $content,
        'image' => $finalName
    ];
   

    function delete(){
        $file = fopen('blogContent.txt','r') or die ('Unable to open the file');
        while(!feof($file)){
            $singleData = fgets($file);
            str_replace($singleData,'',$file);           
        }
    }


    //file 
    $file = fopen('blogContent.txt','a') or die ('Unable to open file');
    $text = uniqid()."||".$title."||".$content."||".$finalName.'<button type="submit" delete() class="btn btn-primary">Submit</button>'."\n";
    fwrite($file,$text);
    fclose($file);
    

    
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
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputTitle">Title</label>
                <input type="text" class="form-control"   name="title"  id="exampleInputTitle" aria-describedby="" placeholder="Enter Title">
            </div>


            <div class="form-group">
                <label for="exampleInputContent">Content</label>
                <input type="text" class="form-control" name="content"  id="exampleInputContent"  placeholder="Enter Content">
            </div>

            <div class="form-group">
                <label for="exampleInputImage">Upload</label>
                <input type="file" class="form-control" name="image"  id="exampleInputImage">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>