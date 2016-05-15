$(document).ready(function(){
    //set datepicker
    $('.datepicker').pickadate({
        max: "<?php echo date('Y-m-d');?>",
        selectYears: true,
        selectMonths: true,
        firstDay: 1,
        clear: '',
    });
    //check if the password confirmation is the same than it should be
    $('#password').change(function(){
        $('#password_confirmation').attr('pattern', '^'+($(this).val())+'$');
    });
});