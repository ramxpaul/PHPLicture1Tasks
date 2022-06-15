<?php 
require 'dbconnection.php';

function clean($input){
    return stripslashes(strip_tags(trim($input)));
}

$link = "https://wikimedia.org/api/rest_v1/metrics/pageviews/per-article/en.wikipedia/all-access/all-agents/Tiger_King/daily/20210901/20210930";
$jsonObj = file_get_contents($link);
$data = json_decode($jsonObj,true);

        for($i=0; $i < count($data['items']);$i++){
                  $project = $data['items'][$i]['project'];
                  $article = $data['items'][$i]['article'];
                  $granularity = $data['items'][$i]['granularity'];
                  $timestamp = $data['items'][$i]['timestamp'];
                  $access = $data['items'][$i]['access'];
                  $agent = $data['items'][$i]['agent'];
                  $views = $data['items'][$i]['views'];
                  $errors = [];

    //validation
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

    //chech for errors 
    if(count($errors) > 0){
        // printing errors
        foreach($errors as $key => $value){
            echo $key.' : '.$value.'<br>';
        }
    }else{
        $sqlCommand = "insert into pageitems (project,article,granularity,timestamp,access,agent,views) values('$project','$article','$granularity','$timestamp','$access','$agent',$views)";
        $operation = mysqli_query($conn,$sqlCommand);    
        }
        
        if($operation){
            echo 'Success, Page Blog Items Added';
        }else{
            echo 'Failed, '.mysqli_error($conn);
        }
     }

    require 'closeConnection.php';
?>