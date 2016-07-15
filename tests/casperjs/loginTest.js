var login_url = "https://box-vimolia-thibaultlenormand.c9users.io/VIMOLIA/login";
var index_url = "https://box-vimolia-thibaultlenormand.c9users.io/VIMOLIA/";

casper.test.begin('Login in app test', 3, function suite(test) {
    casper.start(login_url, function(){
        test.assertHttpStatus(200); // first test
    }).then(function checklogin() {
        test.assertExists('form', 'le formulaire de login existe'); //second test
        casper.waitForSelector("form button[name='submit']", function() {
            this.fillSelectors('form', {
                'input[name = email ]' : 'membre1@gmail.com',
                'input[name = password ]' : 'password'
            }, true);
        });
    }).then(function checklogged(){
        casper.thenOpen(index_url, function() {
            test.assertExists('#logguedIn', 'user is logged in'); // third test
        })
    }).run(function(){
        test.done();
    })
});
