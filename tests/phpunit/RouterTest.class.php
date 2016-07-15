<?php
//le test de ce fichier consiste à tester le système de routing

require('../../application/registry.class.php');
require('../../application/router.class.php');

class RouterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider routeProvider
     */
    public function testGetController($controller, $action, $expected, $args)
    {
        //simulation requete HTTP
        $registry = new Registry();
        $router = new Router($registry);
        $router->setPath('../..'.DIRECTORY_SEPARATOR.'controller');
        $_GET['rt'] = $expected;
        
        //getController étant privée, on bypass le système
        // équivaut à $router->getController();
        $this->invokeMethod($router, 'getController', []); 
        
        //assertions
        $this->assertEquals($router->controller, $controller);
        $this->assertEquals($router->action, $action);
        $this->assertEquals($router->args, $args);
    }
    
    public function testPath()
    {
        $pathToTest = '../..'.DIRECTORY_SEPARATOR.'controller';
        
        $registry = new Registry();
        $router = new Router($registry);
        $router->setPath($pathToTest);
        
        $routerPath = $this->getPrivateProperty('Router', 'path');
        $this->assertEquals($routerPath->getValue($router), $pathToTest);
    }
    
    public function routeProvider()
    {
        return [
            'article index' => ["article", "index", "article/index", []],
            'article display' => ["article", "display", "article/display", []],
            'index index' => ["index", "index", "index/index", []],
            'login index' => ["login", "index", "login/index", []],
            'login logout' => ["login", "logout", "login/logout", []],
            'page index' => ["page", "index", "page/index", []],
            'page display' => ["page", "display", "page/display/3", ['3']],
            'praticien index' => ["praticien", "index", "praticien/index", []],
            'praticien profile' => ["praticien", "profile", "praticien/profile", []],
            'question index' => ["question", "index", "question/index", []],
            'question afficher' => ["question", "afficher", "question/afficher/9", [9]],
            'question add' => ["question", "add", "question/add", []],
            'question addDetails' => ["question", "addDetails", "question/addDetails", []],
            'question close' => ["question", "close", "question/close", []],
            'question makeAnAppointment' => ["question", "makeAnAppointment", "question/makeAnAppointment", []],
            'question addAppointment' => ["question", "addAppointment", "question/addAppointment", []],
            'search index' => ["search", "index", "search/index", []],
            'search praticien' => ["search", "praticien", "search/praticien/11", [11]],
            'signup index' => ["signup", "index", "signup/index", []],
            'signup member' => ["signup", "member", "signup/member", []],
            'signup doctor' => ["signup", "doctor", "signup/doctor", []],
            'signup validation' => ["signup", "validation", "signup/validation", []],
            'signup cancelTransaction' => ["signup", "cancelTransaction", "signup/cancelTransaction", []],
            'signup returnTransaction' => ["signup", "returnTransaction", "signup/returnTransaction", []],
            'video index' => ["video", "index", "video/index", []],
            'video display' => ["video", "display", "video/display/1000", [1000]]
        ];
    }
    
    private function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
    
        return $method->invokeArgs($object, $parameters);
    }
    
    private function getPrivateProperty($className, $propertyName)
    {
		$reflector = new ReflectionClass( $className );
		$property = $reflector->getProperty( $propertyName );
		$property->setAccessible( true );
 
		return $property;
	}
}