$(document).ready(function () {

    $('.preview').click(function (e) { 
        e.preventDefault();
        $('.modal-overlay').fadeIn();
        $('#mapWivdow').attr('src','<?=URI_BASE?>'+ "?loc=" + $(this).attr('data-loc'));
    });

    $('.modal-overlay .close').click(function (e) { 
        e.preventDefault();
        $('.modal-overlay').fadeOut();
        
    });

    $('.statusToggle').click(function (e) { 
        e.preventDefault();
        var btn=$(this);
        const locid=$(this).attr('data-loc');

        $.ajax({
            url: "process/updatestatus.php",
            method:'POST',
            data: {loc:locid},
            success: function (response) {

                if(response == 1){

                    btn.toggleClass('active');


                }
                
            }
        });
        
    });
    





});
