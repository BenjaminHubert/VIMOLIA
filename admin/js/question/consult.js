$(document).ready(function() {
	$('select').material_select();
	
	//proposing doctors
	$('[name="addDoctor"]').click(function(){
		var doctor = $('select#doctors').val();
		var name = $('select#doctors option[value="'+doctor+'"]').attr('data-praticien');
		var skills = $('select#doctors option[value="'+doctor+'"]').attr('data-skills');
		if(doctor != null){
			//activation du bouton d'enregistrement
			$('button[name="setProposedPraticien"]').removeClass('disabled').removeAttr('disabled');
			// mise à jour du select
			$('select#doctors option[value="'+doctor+'"]').remove();
			$('select#doctors').val('-1');
			$('select#doctors').material_select('destroy');
			$('select#doctors').material_select();
			// ajout du praticien dans le formulaire
			$('.proposedPraticien').append('<input type="hidden" name="id_praticien[]" value="'+doctor+'">');
			// ajout du praticien dans le tableau
			$('table.doctors tbody tr.no-doctor').remove();
			$('table.doctors tbody').append('<tr><td>'+name+'</td><td>'+skills+'</td><td><button class="btn-floating waves-effect waves-light blue-grey new-delete"><i class="material-icons">delete_forever</i></button></td></tr>');
			$('.new-delete').click(function(){
				$(this).parent().parent().fadeOut('slow');
			});
		}
	});
	
	$('.delete').click(function(){
		if(confirm('Êtes vous sûre de vouloir supprimer cette proposition?')){
			$(this).parent().parent().fadeOut('slow');
			return true;
		}else return false;
	});
});