$(function(){
    $('.modal-trigger').leanModal();
    
    $(".delete-page").click(function(){
        var id = $(this).attr('data-value');
        $.ajax({
            url: '<?php echo BASE_URL_ADMIN; ?>page/delete/'+id,
            method: 'POST',
            dataType: 'JSON'
        }).done(function(data, textStatus, jqXHR){
            location.reload();
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.error(jqXHR);
        });
    });
    
});