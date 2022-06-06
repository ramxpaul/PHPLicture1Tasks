<?php

function nextChar(){
    $char='c';
    $newChar=++$char;
    if(strlen($newChar)>1){
    return $newChar[0];
    }
    return $newChar;
}
echo nextChar();

?>