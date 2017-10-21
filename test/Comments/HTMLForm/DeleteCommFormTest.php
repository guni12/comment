<?php

namespace Anax\Comments\HTMLForm;

use \Anax\DI\DIFactoryConfig;
use \Anax\Comments\Comm;

/**
 * HTML Form elements.
 */
class DeleteCommFormTest extends \PHPUnit_Framework_TestCase
{
        /**
     * Setup
     */
    public function setUp()
    {
        $this->di = new DIFactoryConfig(__DIR__ . "/../../../htdocs/incl/di.php");
    }

    public function testBasic()
    {
        $id = 3;
        $commForm = new DeleteCommForm($this->di, $id);
        $this->invokeMethod($commForm, 'getCommDetails', array('id'));
        //$res = $commForm->getCommDetails($id);
        $this->assertInstanceOf("\Anax\Comments\HTMLForm\DeleteCommForm", $commForm);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
