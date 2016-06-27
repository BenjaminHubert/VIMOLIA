$(document).ready(function(){
	//MODAL RATE INIT
	$('.modal-trigger.rate').leanModal({
		dismissible: true, // Modal can be dismissed by clicking outside of the modal
		opacity: .5, // Opacity of modal background
		in_duration: 300, // Transition in duration
		out_duration: 200, // Transition out duration
		ready: function(){}, // Callback for Modal open
		complete: function(){  // Callback for Modal close
				$('form.rate-appointment #rate-select').barrating('clear');
				$('form.rate-appointment #comment').val('');
				$('form.rate-appointment #comment').trigger('autoresize');
				$('form.rate-appointment #comment').next().removeClass("active");
			}
		}
	);
	//MODAL HISTORY INIT
	$('.modal-trigger.watch').leanModal({
		dismissible: true, // Modal can be dismissed by clicking outside of the modal
		opacity: .5, // Opacity of modal background
		in_duration: 300, // Transition in duration
		out_duration: 200, // Transition out duration
		ready: function(){}, // Callback for Modal open
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
		readonly: false, //If set to true, the ratings will be read-only.
		fastClicks: true, //Remove 300ms click delay on touch devices.
		hoverState: true, //Change state on hover.
		silent: false //Supress callbacks when controlling ratings programatically.
    });
	$('#history-select').barrating({
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
	//CANCELLING AN APPOINTMENT
	$('a.cancel').click(function(){
		var id_appointment = $(this).attr('data-id-appointment');
		var button = $(this);
		if(confirm('Souhaitez vous vraiment annuler ce rdv ?')){
			$.ajax({
                url: '<?php echo BASE_URL_ADMIN;?>mesRendezVous/cancel',
                method: 'POST',
                data: { id_appointment: id_appointment },
                dataType: 'JSON'
            }).done(function(data, textStatus, jqXHR){
            	if(typeof data.error == 'undefined'){
        			button.parent().hide('slow', function(){
        				$('tr[data-id-appointment="'+id_appointment+'"] .chip-is-validated').remove();
        				$('tr[data-id-appointment="'+id_appointment+'"] .chip-is-canceled').html('Annulé');
        			});
        		}else Materialize.toast(data.error, 4000, 'red');
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.error(jqXHR);
            });
		}
	});
	//RATING AN APPOINTMENT
	$('a.rate').click(function(){
		var id_appointment = $(this).attr('data-id-appointment');
		$('form.rate-appointment').attr('data-id-appointment', id_appointment);
	});
	
	$('form.rate-appointment').submit(function(){
		var id_appointment = $('form.rate-appointment').attr('data-id-appointment');
		var button = $('a.rate[data-id-appointment="'+id_appointment+'"]');
		var rate = $('form.rate-appointment #rate-select').val();
		var comment = $('form.rate-appointment #comment').val();
		
		if(rate != ''){
			$.ajax({
                url: '<?php echo BASE_URL_ADMIN;?>mesRendezVous/rate',
                method: 'POST',
                data: { id_appointment: id_appointment, rate: rate, comment: comment },
                dataType: 'JSON'
            }).done(function(data, textStatus, jqXHR){
            	if(typeof data.error == 'undefined'){
            		$('form.rate-appointment .modal').closeModal();
            		button.attr('href', '#history-modal');
            		button.attr('data-rate', rate);
            		button.attr('data-comment', comment);
        			button.removeClass('rate');
        			button.addClass('watch');
        			button.removeClass('modal-trigger');
        			button.html('<i class="material-icons right">history</i>Voir</a>');
        			$('form.rate-appointment').removeAttr('data-id-appointment');
        			$('a.watch').click(function(){
        				var rate = $(this).attr('data-rate');
        				var comment = ($(this).attr('data-comment') != '')? $(this).attr('data-comment') : 'Aucun commentaire';
        				$('#history-modal.modal .comment').html(comment);
        				$('#history-modal.modal #history-select').barrating('set', rate);
        			});
        		}else Materialize.toast(data.error, 4000, 'red');
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.error(jqXHR);
            });
		}else Materialize.toast('Veuillez au moins sélectionner une étoile', 4000, 'red');
		return false;
	});
	//SEE HISTORY
	$('a.watch').click(function(){
		var rate = $(this).attr('data-rate');
		var comment = ($(this).attr('data-comment') != '')? $(this).attr('data-comment') : 'Aucun commentaire';
		$('#history-modal.modal .comment').html(comment);
		$('#history-modal.modal #history-select').barrating('set', rate);
	});
});