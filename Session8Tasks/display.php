<?php
require 'dbconnection.php';

$sqlCommand = "select * from pageitems";
$resObj = mysqli_query($conn,$sqlCommand);


?>

<!DOCTYPE html>
<html>

<head>
    <title>Blog Content</title>

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
            <h1>Blog Items</h1>
            <br>

         <?php 
          
            # Check if there is a message in the session 
            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
         
         ?>
    
        </div>

        <a href="create.php">+ Add More Items</a>

        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>project</th>
                <th>article</th>
                <th>granularity</th>
                <th>timestamp</th>
                <th>access</th>
                <th>agent</th>
                <th>views</th>
            </tr>

     <?php 
         while($row = mysqli_fetch_assoc($resObj)){
           
     ?>
            <tr>
                <td><?php  echo $row['id'];  ?></td>
                <td><?php  echo $row['project'];  ?></td>
                <td><?php  echo $row['article'];  ?></td>
                <td><?php  echo $row['granularity'];  ?></td>
                <td><?php  echo $row['timestamp'];  ?></td>
                <td><?php  echo $row['access'];  ?></td>
                <td><?php  echo $row['agent'];  ?></td>
                <td><?php  echo $row['views'];  ?></td>

                <td>
                    <a href='delete.php?id=<?php  echo $row['id'];  ?>' class='btn btn-danger m-r-1em'>Delete</a>
                    <a href='update.php?id=<?php  echo $row['id'];  ?>' class='btn btn-primary m-r-1em'>Edit</a>
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


<?php 
require 'closeConnection.php';

?>