<div id="fb-root"></div>
<script>
    // FB
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.6&appId=1703275343238189";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // TW
    window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));
</script>

<div class="row">
    <div class="col s12 m10 offset-m1">
        <h3><?php echo htmlentities($video['title']); ?></h3>
    </div>

    <div class="col s12 m10 offset-m1">
        <div class="video-container">
            <iframe width="853" height="480" src="<?php echo str_replace('watch?v=', 'embed/', $video['url']); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

    <div class="social_network col s12 m10 offset-m1">
       
       <span id="date_pub"><?php echo date('\L\e d/m/Y \à H\hi', strtotime($video['date_create'])); ?></span>
        <ul class="share-buttons">
            <li id="fb">
                <div class="fb-share-button" 
                     data-href="<?php echo BASE_URL.'video/display/'.$video['id']; ?>" 
                     data-layout="button">
                </div>
            </li>
            <li id="twt">
                <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($video['title']); ?>">Tweet</a>
            </li>
            <li id="gplus">
                <div class="g-plus" data-action="share" data-annotation="none" data-href="<?php echo BASE_URL.'video/display/'.$video['id']; ?>"></div>
            </li>
        </ul>
        
    </div>

    <div class="col s12 m10 offset-m1">
        <p id="desc"><?php echo htmlentities($video['description']); ?></p>
    </div>

    <div class="col s12 m10 offset-m1" id="comments">
        <div class="fb-comments" data-href="<?php echo BASE_URL.'video/display/'.$video['id']; ?>" data-numposts="5" data-width="100%"></div>
    </div>
</div>

<script src="https://apis.google.com/js/platform.js" async defer>
    {lang: 'fr'}
</script>