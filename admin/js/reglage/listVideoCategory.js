$(function(){

    $("#add-category").click(function(){
        var category = $("#new-category").val();
        $.ajax({
            url: '<?php echo BASE_URL_ADMIN; ?>reglage/videoCategories/create',
            method: 'POST',
            data: { category: category },
            dataType: 'JSON'
        }).done(function(data, textStatus, jqXHR){
            location.reload();
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.error(jqXHR);
        });
    });

    $(".edit-category").click(function(){
        var td = $(this).parent().prev();
        var id = $(this).attr('data-value');
        var cat = td.text();
        td.html('<input type="text" id="edit" value="'+cat+'">');
        $("#edit").focusout(function(){
            var category = $(this).val();
            $.ajax({
                url: '<?php echo BASE_URL_ADMIN; ?>reglage/videoCategories/edit/'+id,
                method: 'POST', 
                data: { category: category },
                dataType: 'JSON'
            }).done(function(data, textStatus, jqXHR){
                location.reload();
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.error(jqXHR);
            });
        }) 
    });
    
    $(".delete-category").click(function(){
        var id = $(this).attr('data-value');
        $.ajax({
            url: '<?php echo BASE_URL_ADMIN; ?>reglage/videoCategories/delete/'+id,
            method: 'POST',
            dataType: 'JSON'
        }).done(function(data, textStatus, jqXHR){
            location.reload();
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.error(jqXHR);
        });
    });
    
});