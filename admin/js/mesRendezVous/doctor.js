$(document).ready(function(){
	//MODAL INIT
	$('.modal-trigger.watch').leanModal({
		dismissible: true, // Modal can be dismissed by clicking outside of the modal
		opacity: .5, // Opacity of modal background
		in_duration: 300, // Transition in duration
		out_duration: 200, // Transition out duration
		ready: function(){ // Callback for Modal open
			
			}, 
		complete: function(){  // Callback for Modal close
			
			}
		}
	);
	//RATE PLUGIN INIT
	$('#rate-select').barrating({
		theme: 'css-stars', //Specify a theme.
		initialRating: null, //Specify initial rating by passing select field's option value. If null, the plugin will try to set the initial rating by finding an option with a `selected` attribute.
		showValues: false, //If set to true, rating values will be displayed on the bars.
		showSelectedRating: true, //If set to true, user selected rating will be displayed next to the widget.
		deselectable: true, //If set to true, user can deselect a rating. For this feature to work the select field must contain a first option with an empty value.
		reverse: false, //If set to true, the ratings will be reversed.
		readonly: true, //If set to true, the ratings will be read-only.
		fastClicks: true, //Remove 300ms click delay on touch devices.
		hoverState: true, //Change state on hover.
		silent: false //Supress callbacks when controlling ratings programatically.
    });
	//VALID AN APPOINTMENT
	$('a.valid').click(function(){
		var id_appointment = $(this).attr('data-id-appointment');
		var button = $(this);
		if(confirm('Confirmez vous avoir eu rendez vous avec ce patient ?')){
			$.ajax({
                url: '<?php echo BASE_URL_ADMIN;?>mesRendezVous/valid/',
                method: 'POST',
                data: { id_appointment: id_appointment },
                dataType: 'JSON'
            }).done(function(data, textStatus, jqXHR){
            	if(typeof data.error == 'undefined'){
        			button.parent().hide('slow', function(){
        				$('tr[data-id-appointment="'+id_appointment+'"] .chip-is-validated').html('Consulté');
        			});
        		}else Materialize.toast(data.error, 4000, 'red');
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.error(jqXHR);
            });
		}
	});
	//SEE THE RATE AND THE COMMENT OF AN APPOINTMENT
	$('a.watch').click(function(){
		var rate = $(this).attr('data-rate');
		var comment = ($(this).attr('data-comment') != '')? $(this).attr('data-comment') : 'Aucun commentaire';
		$('#history-modal.modal .comment').html(comment);
		$('#history-modal.modal #rate-select').barrating('set', rate);
	});
});