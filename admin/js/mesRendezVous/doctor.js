$(document).ready(function(){
	$('a.cancel').click(function(){
		var id_appointment = $(this).attr('data-id-appointment');
		var button = $(this);
		if(confirm('Souhaitez vous vraiment annuler ce rdv ?')){
			$.ajax({
                url: '<?php echo BASE_URL_ADMIN;?>mesRendezVous/cancel/',
                method: 'POST',
                data: { id_appointment: id_appointment },
                dataType: 'JSON'
            }).done(function(data, textStatus, jqXHR){
            	if(typeof data.error == 'undefined'){
        			button.parent().hide('slow', function(){
        				$('tr[data-id-appointment="'+id_appointment+'"] .chip-is-canceled').html('Annulé');
        			});
        		}else Materialize.toast(data.error, 4000, 'red');
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.error(jqXHR);
            });
		}
	});
	$('a.watch').click(function(){
		
	});
});