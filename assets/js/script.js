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
            
        
    