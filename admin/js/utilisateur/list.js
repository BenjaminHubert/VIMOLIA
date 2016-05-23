$(document).ready(function(){
    $('.remove-button').click(function(){
        return confirm('Êtes vous sûr de vouloir supprimer "'+$(this).attr('data-firstName')+' '+$(this).attr('data-lastName')+'" ?')
    });
});