var root_url = "https://box-vimolia-thibaultlenormand.c9users.io/VIMOLIA/";
var article_url = root_url + "article";
var video_url = root_url + "video";
var not_found_url = root_url + "not_found.php";

var urls = [
    article_url,
    video_url
];

casper.test.begin('Survival tests on web application', 6, function suite(test) {
    casper.start(root_url, function(){
        test.assertHttpStatus(200);
    }).then(function checkPages() {
        urls.forEach(function(url){
            casper.thenOpen(url, function(){
                test.assertHttpStatus(200, 'Expected 200, received '+ casper.currentHTTPStatus);
            })
        })
    }).then(function checkArticles() {
        casper.thenOpen(article_url, function () {
            var articles = casper.evaluate(function() {
                return document.getElementsByClassName('card').length;
            });
            test.assertEquals(articles, 4, 'We should see 4 articles on this page');
        })
    }).then(function checkVideos() {
        casper.thenOpen(video_url, function() {
            var videos = casper.evaluate(function() {
                return document.getElementsByClassName('card').length;
            })
            test.assertEquals(videos, 5, 'We should see 5 videos on this page');
        })
    }).then(function checkInterviews() { // A refaire en simulant les filtres ?
        casper.thenOpen(video_url, function() {
            var interviews = casper.evaluate(function() {
                var cats = document.getElementsByClassName('cat-them');
                var cpt = 0;
                for(i=0; i<cats.length; i++){
                    if(cats[i].innerHTML.indexOf('Interview') > -1){
                        cpt++;
                    }
                }
                return cpt;
            })
            test.assertEquals(interviews, 2, 'We should see 2 videos with Interview category on this page');
        })
    })
    .run(function(){
        test.done();
    })
});