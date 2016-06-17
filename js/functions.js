//datepicker french transalation
jQuery.extend( jQuery.fn.pickadate.defaults, {
	monthsFull: [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' ],
	monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec' ],
	weekdaysFull: [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ],
	weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
	today: 'Aujourd\'hui',
	clear: 'Effacer',
	close: 'Fermer',
	firstDay: 1,
	format: 'dd mmmm yyyy',
	formatSubmit: 'yyyy-mm-dd',
	labelMonthNext:"Mois suivant",
	labelMonthPrev:"Mois précédent",
	labelMonthSelect:"Sélectionner un mois",
	labelYearSelect:"Sélectionner une année"
});

$(document).ready(function(){
	$('.button-collapse').sideNav({
		menuWidth: 300, // Default is 240
		edge: 'left', // Choose the horizontal origin
		closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
	}
	);
	$(".dropdown-button").dropdown();
	$('textarea[lenght], input[lenght]').characterCounter();

	$('[data-tooltip]').tooltip();
});