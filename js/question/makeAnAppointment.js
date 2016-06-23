$(document).ready(function(){
	$('.modal-trigger').leanModal({
		dismissible: true, // Modal can be dismissed by clicking outside of the modal
		opacity: .5, // Opacity of modal background
		in_duration: 200, // Transition in duration
		out_duration: 200, // Transition out duration
		ready: function() {}, // Callback for Modal open
		complete: function() {} // Callback for Modal close
	}
	);
});