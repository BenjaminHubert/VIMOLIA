$(document).ready(function(){
    $('.materialboxed').materialbox();

    $('.modal-trigger').leanModal();

    $(".delete-article").click(function(){
        var id = $(this).attr('data-value');
        $.ajax({
            url: '<?php echo BASE_URL_ADMIN; ?>article/delete/'+id,
            method: 'POST',
            dataType: 'JSON'
        }).done(function(data, textStatus, jqXHR){
            location.reload();
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.error(jqXHR);
        });
    });
});