$(document).ready(function(){
	$('form').submit(function(){
		var newPassword = $('#newPassword').val();
		var newPasswordConfirmation = $('#newPasswordConfirmation').val();
		
		if(newPassword != newPasswordConfirmation){
			Materialize.toast('Les mots de passe ne sont pas identiques', 4000, 'red');
			return false;
		}
		
		
		return true;
	});
});