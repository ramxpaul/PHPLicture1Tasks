<?php
function separate(){

    $originalString= 'http://www.example.com/5478631';
    $separatedString=explode('/',$originalString);
    return $separatedString[3];
}
echo separate();

?>