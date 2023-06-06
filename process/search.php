<?php


include  "C:/laragon/www/Map/bootstrap/init.php";


$keyword=$_POST['keyword'];

if(!isset($keyword) or empty($keyword)){

    echo "شروع به تایپ کنید...";
}

$locations=getLocations(["keyword"=>$keyword]);

foreach($locations as $loc){
    echo "<a href='".URI_BASE."?loc=$loc->id'><div class='result-item' data-lat='$loc->lat' data-lng='$loc->lng' data-loc='$loc->id'>
        <span class='loc-type'>".locationTypes[$loc->type]."</span>
        <span class='loc-title'>$loc->title</span>
    </div></a>";
}