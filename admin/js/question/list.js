$(document).ready(function() {
	$('select').material_select();
	
	var numberOfRows = $('table tbody tr').length;
	if(numberOfRows == 0){
		$('table tbody').append('<tr><td colspan=5>Aucune donnée</td></tr>');
	}
	
	$('.reset-filter').click(function(){
		$('select').each(function(){
			$(this).material_select('destroy');
			$(this).val('all');	
			$(this).material_select();
		});
	});
});