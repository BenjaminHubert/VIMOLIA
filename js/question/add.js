$(document).ready(function() {
	$('textarea.ask').characterCounter();
	$('.modal-trigger').leanModal();

	$('.accept').click(function(){
		$('.privacy').val('1');
		$('form').submit();
	});
	$('.refuse').click(function(){
		$('.privacy').val('0');
		$('form').submit();
	});
	$('form').submit(function(){
		if($('#question_title').val() == ''){
			Materialize.toast('La question est vide', 4000, 'red');
			return false;
		}
		
		return true;
	});
});