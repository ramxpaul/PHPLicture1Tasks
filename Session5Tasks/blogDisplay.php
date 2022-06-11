<?php 

session_start();

echo 'Title is : '.$_SESSION['blogDiplay']['title'].'<br>';
echo 'Content is : '.$_SESSION['blogDiplay']['content'].'<br>';
echo 'Image Name is : '.$_SESSION['blogDiplay']['image'].'<br>';
 
$file = fopen('blogContent.txt','r') or die ('Unable to open the file');
    while(!feof($file)){
        echo fgets($file).'<br>';
    }


?>