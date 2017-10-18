<?php

namespace Anax\Comments;

use \Anax\DI\DIFactoryConfig;

/**
 * HTML Form elements.
 */
class CommTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Setup
     */
    public function setUp()
    {
        $this->di = new DIFactoryConfig(__DIR__ . "/../../htdocs/incl/di.php");
    }


    public function testCreateObject()
    {
        $comm = new Comm();
        $this->assertInstanceOf("\Anax\Comments\Comm", $comm);
        $res = $comm->getGravatar("gunvor@behovsbo.se");
        $this->assertEquals("https://www.gravatar.com/avatar/2438dc720f1ca2c32c27a5bb658229c4?s=20&d=mm&r=g", $res);
        $comm->setDb($this->di->get("db"));
        $res2 = $comm->find("id", 1);
        $this->assertInstanceOf("\Anax\Comments\Comm", $res2);
        $res4 = $comm->find("email", "helga@helgon.se");
        $this->assertInstanceOf("\Anax\Comments\Comm", $res4);
    }
}
