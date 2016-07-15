<?php
//le test de ce fichier consiste à tester le système de routing

include('../../conf/config.php');
require('../../application/registry.class.php');
require('../../application/template.class.php');

class TemplateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider registryProvider 
     */
    public function testConstruct($registry){
        $template = new Template($registry);
        
        $newRegistry = $this->getPrivateProperty('Template', 'registry');
        $this->assertInstanceOf('Registry', $newRegistry->getValue($template));
    }
    
    private function getPrivateProperty($className, $propertyName)
    {
		$reflector = new ReflectionClass( $className );
		$property = $reflector->getProperty( $propertyName );
		$property->setAccessible( true );
 
		return $property;
	}
	
	public function registryProvider()
    {
        return [
            'n°1' => ["oklm"],
            'n°2' => [new Registry()],
            'n°3' => [new Template()],
            'n°4' => [new stdClass()],
            'n°5' => [new Registry(123, 23, 23, 23)]
        ];
    }
}