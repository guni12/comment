<?php

namespace Anax\Comments\HTMLForm;

use \Anax\DI\DIFactoryConfig;

/**
 * HTML Form elements.
 */
class CreateCommFormTest extends \PHPUnit_Framework_TestCase
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
        $commForm = new CreateCommForm($this->di, 1, 3);
        $this->assertInstanceOf("\Anax\Comments\HTMLForm\CreateCommForm", $commForm);
    }

    public function testEvenMoreStuff()
    {
        $commForm = new CreateCommForm($this->di);
        $elements = [
            ["id" => __CLASS__, "legend" => "Gör ett inlägg",],
            [   "title" => ["type"  => "text", "value" => "Titel i createTest"],
                "id" => ["type"  => "hidden", "value" => 2],
                "parentid" => ["type"  => "hidden", "value" => 1],
                "comment" => ["type"  => "textarea", "value" => "Text i createTest"],
                "email" => ["type"  => "text", "value" => "Text i createTest"],
                "submit" => ["type" => "submit", "value" => "Spara", "callback" => [$this, "callbackSubmit"]]]];

        //$this->invokeMethod($commForm->form, 'create', array('elements'));

        $sess = [
            'loggedin' => true,
            'id' => 5,
            'acronym' => 'Gunvor',
            'isadmin' => 1];
        $this->assertInstanceOf("\Anax\Comments\HTMLForm\CreateCommForm", $commForm);
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
