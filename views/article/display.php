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

<div class="slider">
    <ul class="slides">
        <li>
            <img src="<?php echo $article['main_picture']; ?>">
            <div class="caption center-align">
                <h3><?php echo $article['title'] ?></h3>
            </div>
        </li>
    </ul>
</div>
<div class="row">
    <?php $user = $this->registry->db->getUser($article['id_user']); ?>
    <div class="col s12" id="author">Par <?php echo $user['first_name']." ".$user['last_name']; ?></div>
    <div class="col s12" id="date_pub"><?php echo date('\L\e d/m/Y \à H\hi', strtotime($article['date_publish'])); ?></div>

    <div class="social_network col s12">
        <ul class="share-buttons">
            <li id="fb">
                <div class="fb-share-button" 
                     data-href="<?php echo BASE_URL.'article/display/'.$article['id']; ?>" 
                     data-layout="button">
                </div>
            </li>
            <li id="twt">
                <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($article['title']); ?>">Tweet</a>
            </li>
            <li id="gplus">
                <div class="g-plus" data-action="share" data-annotation="none" data-href="<?php echo BASE_URL.'article/display/'.$article['id']; ?>"></div>
            </li>
        </ul>
    </div>

    <div class="col s12">
        <p id="desc"><?php echo $article['description']; ?></p>
        <div id="content">
            <?php echo $article['content']; ?>
        </div>
    </div>

    <div class="col s12" id="comments">
        <div class="fb-comments" data-href="<?php echo BASE_URL.'article/display/'.$article['id']; ?>" data-numposts="5" data-width="100%"></div>
    </div>
</div>

<script src="https://apis.google.com/js/platform.js" async defer>
    {lang: 'fr'}
</script>