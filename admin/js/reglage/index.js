$(document).ready(function(){
	$('.colorpicker').colorPicker(/* optinal options */); // that's it
    $('.scrollspy').scrollSpy();
    $('.toc-wrapper').pushpin();
    
    //delete a subscription type
    $('#subscription-section .delete-button').click(function(){
    	var obj = $(this);
    	if(confirm('Souhaitez vous vraiment supprimer cet abonnement ?')){
	    	$.ajax({
	            url: $(this).attr('data-href'),
	            method: 'POST',
	            data: { method: 'ajax' },
	            dataType: 'JSON'
	        }).done(function(data, textStatus, jqXHR){
	        	if(typeof data.error == 'undefined'){
	        		obj.parents("tr").hide('slow');
	        		Materialize.toast('Supression réussite', 4000, 'HEADER_BACKGROUND-COLOR');
	        	}else Materialize.toast(data.error, 4000, 'red');
	        }).fail(function(jqXHR, textStatus, errorThrown){
	        	Materialize.toast('Une erreur inattendue a été rencontrée', 4000, 'red');
	            console.error(jqXHR);
	        });
    	}
    });
});