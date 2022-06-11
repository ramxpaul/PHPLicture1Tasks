<?php


// $test = array_combine($arr[0],$arr[1]);
// $test2 = array_unique($test);

function test2(){
    $arr=[
        ['a','b','c'],
        ['x','b','a'],
        ['z','z','v']
    ];
foreach($arr as $arvalue){
//    $arrSaparatedValues = implode('',$arvalue);
//    $arrSingleValues=[$arrSaparatedValues];
//    print_r($arrSingleValues);
//    $uniqueLetters= array_unique($arrSaparatedValues);
$arrSaparatedValues = implode('',$arvalue);
$uniqueLetters=array_unique([$arrSaparatedValues]);
    foreach([$arrSaparatedValues] as $value)
    {      
        $uniqueLetters=$value;
        print_r($uniqueLetters);
     //    $test2 = array_unique($mytest);
    }
}

}

test2();



?>