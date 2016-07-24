</div>
</main>
<footer class="page-footer FIRST_FOOTER_BACKGROUND-COLOR PRIMARY_COLOR">
    <div class="container">
        <div class="row">
            <div class="col l4 s12">
                <a class="twitter-timeline"
                   data-widget-id="<?php echo TWITTER_ID; ?>"
                   href="https://twitter.com/VimoliaSante"
                   width="300"
                   height="200">
                    Tweets de @VimoliaSante
                </a>
            </div>
            <div class="col l5 s12">
                <h5 class="">Pages</h5>
                <ul>
                    <?php 
                    $listPage = $this->registry->db->getListPage();
                    if(!empty($listPage)){
                        foreach($listPage as $page){
                    ?>
                    <li>
                        <a class="ACCENT_COLOR" href="<?php echo BASE_URL.'page/display/'.$page['id']; ?>"><?php echo $page['title']; ?></a>
                    </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class=""> Développé par </h5>
                <ul>
                    <li><a class="ACCENT_COLOR" href="mailto:delannay.axel@gmail.com" target="_blank">Axel Delannay</a></li>
                    <li><a class="ACCENT_COLOR" href="mailto:bfreylin@gmail.com" target="_blank">Bertrand Freylin</a></li>
                    <li><a class="ACCENT_COLOR" href="mailto:benjam.hubert@gmail.com" target="_blank">Benjamin Hubert</a></li>
                    <li><a class="ACCENT_COLOR" href="mailto:thibaultlenormand@yahoo.fr" target="_blank">Thibault Lenormand</a></li>
                    <li><a class="ACCENT_COLOR" href="mailto:younes.sadmi@gmail.com" target="_blank">Younes Sadmi</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright SECOND_FOOTER_BACKGROUND-COLOR">
        <div class="container PRIMARY_COLOR" style="text-align:center">
            Copyright 2016 © <a class="ACCENT_COLOR" href="<?php echo BASE_URL; ?>"><?php echo APP_TITLE; ?></a> Tous droits réservés.
        </div>
    </div>
</footer>
<script>window.twttr = (function(d, s, id) {
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
}(document, "script", "twitter-wjs"));</script>
</body>
</html>