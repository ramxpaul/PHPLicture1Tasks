<!-- //connecting to DB and Sending The Select Operation -->
<?php
require 'dbconnection.php';

$sqlCommand = 'select * from blog';
$resObj = mysqli_query($conn,$sqlCommand);

?>


<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>Read Users </h1>
            <br>  

            <!-- // Successfully Messages // Or Error Messages  -->
            <?php 

            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>

        </div>

        <a href="">+ Account</a>

        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            <?php
            //storing the result of sql select operation(object) as Associated array 
            // $raw = mysqli_fetch_assoc($resObj);  it makes infinty loop why ?
            while($row = mysqli_fetch_assoc($resObj)){

            ?>
    
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['content']; ?></td>
                <td><?php echo "<img src='./uploads/$row[image]' alt=''  height='60px' width='60px'>" ?></td>
                <td>
                    <a href='deleteblog.php?id=<?php echo $row['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                    <a href='updateblog.php?id=<?php echo $row['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                </td>
            </tr>
            <?php } ?>

            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>