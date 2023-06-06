<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css<?="?v=".rand(1,999); ?>">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <title>Map</title>
  
</head>
<body>

<div class="main">
<div class="head">
        <div class="search-box">
        <input type="text" id="search" placeholder="دنبال کجا می گردی؟">
        <div class="clear"></div>
        <div class="search-results" style="display: none;" >
        
        <!-- <div class="result-item" data-lat='111' data-lng='222'>
            <span class="loc-type">دانشگاه</span>
            <span class="loc-title">دانشگاه شریف</span>
        </div> -->
        </div>
        </div>
        </div>
    <div class="mapcontainer">
        <div id="map" style="width: 100%; height: 100vh;"></div>
    </div>
</div>

<div class="modal-overlay" style="display: none;">
    <div class="modal">
    <span class="close">x</span>
            <h3 class="modal-title">ثبت لوکیشن</h3>
            <div class="modal-content">
                <form id='addLocationForm' action="<?=site_url('process/addLocation.php'); ?>" method="POST">
                <div class="field-row">
                            <div class="field-title">مختصات</div>
                            <div class="field-content">
                                <input type="text" name='lat' id="lat-display" readonly style="width: 200px;text-align: center;">
                                <input type="text" name='lng' id="lng-display" readonly style="width: 200px;text-align: center;">
                            </div>
                    </div>
                    <div class="field-row">
                            <div class="field-title">نام مکان</div>
                            <div class="field-content">
                                <input type="text" name="title" id='l-title' placeholder="مثلا: دفتر مرکزی  ">
                            </div>
                    </div>
                    <div class="field-row">
                        <div class="field-title">نوع</div>
                        <div class="field-content">
                            <select name="type" id='l-type'>
                            <?php foreach(locationTypes as $key=> $locate): ?>
                            <option value="<?=$key?>"><?=$locate ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field-title">ذخیره نهایی</div>
                        <div class="field-content">
                            <input type="submit" value=" ثبت ">
                        </div>
                    </div>
                    <div class="ajax-result"></div>
                </form>
            </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

$(document).ready(function () {

               
$('form#addLocationForm').submit(function (e) { 

e.preventDefault();

var form=$(this);
var result=form.find('.ajax-result');

$.ajax({
    url: 'process/addLocation.php',
    method: 'post',
    data: form.serialize(),
    success: function (response) {

        result.html(response); 
       
    }
});

$( 'form#addLocationForm' ).each(function(){
    this.reset();
});

});




        $('.close').click(function (e) { 
            $('.modal-overlay').fadeOut();
            $('.ajax-result').empty();     
        });


        $('#search').keyup(function (e){
            
            var input=$(this).val();

            const searchresult=$('.search-results');

            

            $.ajax({
                url: "process/search.php",
                method:'POST',
                data: {keyword:input},

                success: function (response) {
                    
                    searchresult.slideDown().html(response);
                }
            });
            
        });


 


    });

const map = L.map("map").setView([30.285973,57.0563795], 16);

const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);





map.on( "dblclick", function(event) {

    L.marker(event.latlng).addTo(map);

    $('.modal-overlay').fadeIn(500);
        
    $('#lat-display').val(event.latlng.lat);
    $('#lng-display').val(event.latlng.lng);
    
    });
        
    


<?php if($location): ?>
    
    L.marker([<?=$location->lat ?>,<?=$location->lng ?>]).addTo(map).bindPopup('<?= $location->title?>').openPopup();

 <?php endif; ?>   

</script>    
</body>
</html>