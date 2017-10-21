<?php

namespace Anax\Comments;

use \Anax\DI\DIFactoryConfig;

/**
 * HTML Form elements.
 */
class ShowAllServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Setup
     */
    public function setUp()
    {
        $this->di = new DIFactoryConfig(__DIR__ . "/../../htdocs/incl/di.php");
    }

    public function testBasic()
    {
        /*
        $commAll = new ShowAllService($this->di);
        $this->assertInstanceOf("\Anax\Comments\ShowAllService", $commAll);

        $all = $commAll->getAll();

        $comm = new Comm();
        $comm->setDb($this->di->get("db"));
        $item = $comm->find("id", 3);

        $img = $commAll->getGravatar($item->email);
        $shouldbe = '<img src="https://www.gravatar.com/avatar/76244599cf35c54be93d61ef551adbe8?s=20&d=mm&r=g" alt=""/>';
        $this->assertEquals($shouldbe, $img);

        $when = date("Y-m-d H:i:s");
        $update = $commAll->getExtra($when);
        $this->assertContains("Skrevs", $update);*/
    }
}
