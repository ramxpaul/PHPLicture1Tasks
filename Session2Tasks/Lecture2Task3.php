<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    <?php
    // function test(){
    //     $tryme="<div id='container' </div>";
    //     $tryme2=explode("'",$tryme);
    //     return $tryme2[0];
    // }
    // echo test();
    function test(){
        $tryme='<div id="container">';
        $tryme2 = strpos($tryme,'container');
        if($tryme2>0)
        {
        return 'container';
        }else{
            return 'no id';
        }
    }
    echo test();
    ?>
    
</body>
</html>