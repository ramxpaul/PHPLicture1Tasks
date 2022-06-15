<?php

require 'dbconnection.php';


$id = $_GET['id'];
$sqlSelectCommand = "select * from pageitems where id=$id";
$resObj = mysqli_query($conn,$sqlSelectCommand);
$data = mysqli_fetch_assoc($resObj);


function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



# Server Side Code . . . 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $project = clean($_POST['project']);
    $article = clean($_POST['article']);
    $granularity = clean($_POST['granularity']);
    $timestamp = clean($_POST['timestamp']);
    $access = clean($_POST['access']);
    $agent = clean($_POST['agent']);
    $views = clean($_POST['views']);


    # Validate ...... 
    $errors = [];

    if (empty($project)) {
        $errors['project'] = "Field Required";
    }

    if (empty($article)) {
        $errors['article'] = "Field Required";
    }

    if (empty($granularity)) {
        $errors['granularity'] = "Field Required";
    }

    if (empty($timestamp)) {
        $errors['timestamp'] = "Field Required";
    }

    if (empty($access)) {
        $errors['access'] = "Field Required";
    }

    if (empty($agent)) {
        $errors['agent'] = "Field Required";
    }

    if (empty($views)) {
        $errors['views'] = "Field Required";
    }

    //checking errors
    if (count($errors) > 0) {
        // print errors

        foreach ($errors as $key => $value) {
            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else { 

        $sqlUpdateCommand = "update pageitems set project='$project', article='$article', granularity='$granularity', timestamp='$timestamp', access='$access', agent='$agent', views='$views' where id=$id ";    
        $operation =  mysqli_query($conn, $sqlUpdateCommand);

        if ($operation) {
            $message =  "Success , Your Blog Items Updated";
            $_SESSION['message'] = $message;
            
            header('Location: display.php');
            exit(); 

        } else {
            echo "Failed , " . mysqli_error($con);
        }
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<head>
    <title>Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Update Info : </h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$data['id']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Project</label>
                <input type="text" class="form-control" required id="exampleInputName" name="project" placeholder="Enter Project"  value = "<?php echo $data['project'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Article</label>
                <input type="text" class="form-control" required id="exampleInputEmail1" name="article" placeholder="Enter Article" value = "<?php echo $data['article'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Granularity</label>
                <input type="text" class="form-control" required id="exampleInputName"  name="granularity" placeholder="Enter Granularity"  value = "<?php echo $data['granularity'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Timestamp</label>
                <input type="text" class="form-control" required id="exampleInputName"  name="timestamp" placeholder="Enter Timestamp"  value = "<?php echo $data['timestamp'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Access</label>
                <input type="text" class="form-control" required id="exampleInputName"  name="access" placeholder="Enter Access"  value = "<?php echo $data['access'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Agent</label>
                <input type="text" class="form-control" required id="exampleInputName"  name="agent" placeholder="Enter Agent"  value = "<?php echo $data['agent'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Views</label>
                <input type="text" class="form-control" required id="exampleInputName" name="views" placeholder="Enter Views"  value = "<?php echo $data['views'];?>">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>


<?php 
require 'closeConnection.php';

?>
</body>

</html>