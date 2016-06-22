$(document).ready(function(){
    $('.slider').slider({
        height: 330
    });
    $('.slider').slider('next');
    $('.slider').slider('prev');
    $('.video-container').hover(function(){
        $('.slider').slider('pause');
    });
    $('.slider').click(function(){
        $('.slider').slider('play');
    });
});