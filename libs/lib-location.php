<?php


function addLocation($data){

    global $pdo;
    $sql = "INSERT INTO `locations` (`title`, `lat`, `lng`, `type`) VALUES (:title, :lat, :lng, :type);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title'=>$data['title'],'lat'=>$data['lat'],'lng'=>$data['lng'],'type'=>$data['type']]);
    return $stmt->rowCount();
}

function getLocations($params=[]){

    global $pdo;
    $condition='';

    if(isset($params['status']) and in_array($params['status'],[0,1])){

        $condition="where status={$params['status']}";
    }else if(isset($params['keyword'])){
        $condition = " WHERE status = 1 and title like '%{$params['keyword']}%'";
    }

    $sql = "SELECT * FROM `locations` $condition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


function getLocation($id){

    global $pdo;
    $sql = "SELECT * FROM `locations` WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id"=>$id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}


function updatestatus($id){

    global $pdo;

    $sql="UPDATE `locations` SET `status`= 1 - status  WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id"=>$id]);
    return $stmt->rowCount();

}