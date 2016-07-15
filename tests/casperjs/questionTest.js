var login_url = "https://box-vimolia-thibaultlenormand.c9users.io/VIMOLIA/login";
var index_url = "https://box-vimolia-thibaultlenormand.c9users.io/VIMOLIA/";
var ask_url = "https://box-vimolia-thibaultlenormand.c9users.io/VIMOLIA/question/add/";
var allQuestions_url = "https://box-vimolia-thibaultlenormand.c9users.io/VIMOLIA/question";
var question = "Question ?";

casper.test.begin('Login in app test', 5, function suite(test) {
    ////////////////////////////
    ///////// CONNECTION ///////
    ////////////////////////////
    casper.start(login_url, function(){
        test.assertHttpStatus(200); // first test
    }).then(function checklogin() {
        test.assertExists('form', 'le formulaire de login existe'); //second test
        casper.waitForSelector("form button[name='submit']", function() {
            this.fillSelectors('form', {
                'input[name = email ]' : 'membre3@gmail.com',
                'input[name = password ]' : 'password'
            }, true);
        });
    }).then(function checklogged(){
        casper.thenOpen(index_url, function() {
            test.assertExists('#logguedIn', 'user is logged in'); // third test
        })
    //////////////////////////////
    ///////// ASK QUESTION ///////
    //////////////////////////////
    }).then(function ask(){
        casper.thenOpen(ask_url, function() {
            test.assertExists('form', 'Le formulaire d\'ajout de question existe');
            casper.waitForSelector("form input[name='question_title']", function() {
                this.fillSelectors('form', {
                    'input[name = question_title ]' : question,
                    'textarea[name = question_text ]' : 'Content and more',
                    'input[name = privacy ]' : '1' // 0 ou 1
                }, true);
            });
        })
    //////////////////////////////
    /////// CHECK QUESTION ///////
    //////////////////////////////
    }).then(function verify(){
        casper.thenOpen(allQuestions_url, function() {
            test.assertTextExists(question, 'La question a bien été créée');
        })
    }).run(function(){
        test.done();
    })
});
