$(function(){

    $("#add-thematic").click(function(){
        var thematic = $("#new-thematic").val();
        $.ajax({
            url: '<?php echo BASE_URL_ADMIN; ?>reglage/videoThematics/create',
            method: 'POST',
            data: { thematic: thematic },
            dataType: 'JSON'
        }).done(function(data, textStatus, jqXHR){
            location.reload();
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.error(jqXHR);
        });
    });

    $(".edit-thematic").click(function(){
        var td = $(this).parent().prev();
        var id = $(this).attr('data-value');
        var cat = td.text();
        td.html('<input type="text" id="edit" value="'+cat+'">');
        $("#edit").focusout(function(){
            var thematic = $(this).val();
            $.ajax({
                url: '<?php echo BASE_URL_ADMIN; ?>reglage/videoThematics/edit/'+id,
                method: 'POST', 
                data: { thematic: thematic },
                dataType: 'JSON'
            }).done(function(data, textStatus, jqXHR){
                location.reload();
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.error(jqXHR);
            });
        }) 
    });
    
    $(".delete-thematic").click(function(){
        var id = $(this).attr('data-value');
        $.ajax({
            url: '<?php echo BASE_URL_ADMIN; ?>reglage/videoThematics/delete/'+id,
            method: 'POST',
            dataType: 'JSON'
        }).done(function(data, textStatus, jqXHR){
            location.reload();
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.error(jqXHR);
        });
    });
    
});