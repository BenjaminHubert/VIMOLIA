$(document).ready(function(){
	$('.modal-trigger').leanModal({
		dismissible: false, // Modal can be dismissed by clicking outside of the modal
		opacity: .5, // Opacity of modal background
		in_duration: 200, // Transition in duration
		out_duration: 200, // Transition out duration
		ready: function() {}, // Callback for Modal open
		complete: function() { // Callback for Modal close
			$('.step-1').show();
			$('.step-2').hide();
			$('.step-1 .error').html('');
			$('.step-2 .name').html('');
	    	$('.step-2 .address').html('');
	    	$('.step-2 .mobile').html('');
	    	$('.step-2 .phone').html('');
	    	$('.step-2 .email').html('');
	    	$('.step-2 .skills').html('');
	    	$('#methodRDV .modal-close').html('Annuler');
	    	$('#methodRDV .modal-close').removeAttr('href');
		} 
	}
	);
	
	$('a[href="#methodRDV"]').click(function(){
		$('#methodRDV').attr('data-id-doctor', $(this).attr('data-id-doctor'));
	});
	
	$('.visio-conference, .physique').click(function(){
		var is_virtual = ($(this).is('.visio-conference'))?1:0;
		console.log();
		$('.step-1 .progress').fadeIn('fast');
		$.ajax({
	        url: '<?php echo BASE_URL;?>question/addAppointment',
	        method: 'POST',
	        data: { id_doctor: $('#methodRDV').attr('data-id-doctor'), is_virtual: is_virtual, id_question: $('#methodRDV').attr('data-id-question') },
	        dataType: 'JSON'
	    }).done(function(data, textStatus, jqXHR){
	    	if(typeof data.error == 'undefined'){
	    		if(data.doctor.first_name != null){
			    	$('.step-2 .name').html('<i class="material-icons left">person</i> '+data.doctor.first_name+' '+data.doctor.last_name);
	    		}
	    		if(data.doctor.address != null){
			    	$('.step-2 .address').html('<i class="material-icons left">location_on</i> '+data.doctor.address+' '+data.doctor.city+' '+data.doctor.postal_code);
	    		}
	    		if(data.doctor.mobile != null){
			    	$('.step-2 .mobile').html('<i class="material-icons left">phone</i> '+data.doctor.mobile);
	    		}
	    		if(data.doctor.phone != null){
			    	$('.step-2 .phone').html('<i class="material-icons left">phone</i> '+data.doctor.phone);
	    		}
	    		if(data.doctor.email != null){
			    	$('.step-2 .email').html('<i class="material-icons left">email</i> '+data.doctor.email);
	    		}
	    		if(data.doctor.skills != null){
			    	$('.step-2 .skills').html('<i class="material-icons left">star</i> '+data.doctor.skills.join(', '));
	    		}
	    		
		    	$('.step-1').slideUp('fast', function(){	
		    		$('#methodRDV .modal-close').html('Fermer');
			    	$('#methodRDV .modal-close').attr('href', '<?php echo BASE_URL;?>question/afficher/'+$('#methodRDV').attr('data-id-question'));
			    	$('.step-2').slideDown('fast');
		    	});
	    	}else $('.step-1 .error').html(data.error);
	    	
	    	$('.step-1 .progress').fadeOut('fast');
	    }).fail(function(jqXHR, textStatus, errorThrown){
	    	console.error(jqXHR);
	    });
	})
});