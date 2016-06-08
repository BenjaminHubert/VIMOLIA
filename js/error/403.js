$(function(){
    var api = "http://yesno.wtf/api?force=no"
    $.getJSON(api)
    .done(
        function(data){
            $(".main")
            .css({
                "background-image": "url("+data.image+")",
                "position" :"relative",
                "height": "700px",
                "width": "100%",
                "z-index": 0,
                "background-position": "center center",
                "background-size": "cover"
            });
        }
    );
});
