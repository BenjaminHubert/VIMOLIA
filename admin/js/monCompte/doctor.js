$(document).ready(function(){
    //set datepicker
    $('.datepicker').pickadate({
        max: new Date(),
        selectYears: true,
        selectMonths: true,
        firstDay: 1,
        clear: '',
    });
    //set the select materialize design
    $('select').material_select();
});