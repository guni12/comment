<?php

namespace Anax\Comments;

use \Anax\DI\DIFactoryConfig;

/**
 * HTML Form elements.
 */
class ShowOneServiceTest extends \PHPUnit_Framework_TestCase
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
        $titel = "";
        $text = "";
        $val = [];
        $commid = 2;
        $commOne = new ShowOneService($this->di, $commid); //No usercontroller
        $this->assertInstanceOf("\Anax\Comments\ShowOneService", $commOne);

        $comm = new Comm();
        $comm->setDb($this->di->get("db"));
        $res2 = $comm->find("id", $commid);

        $decode = $commOne->getDecode($res2);
        $this->assertContains("syssla", $decode);

        $where = "parentid = ?";
        $params = [$commid];
        $comments = $commOne->getParentDetails($where, $params);
        $empty = [];
        $this->assertEquals($empty, $comments);

        //$this->assertEmpty(['parentid']);

        $item = $commOne->getItemDetails($commid);
        //$this->assertArraySubset($item, ['email' => "hulda@händig.se"]);
        $this->assertObjectHasAttribute('email', $item);

        $img = $commOne->getGravatar($item->email);
        $shouldbe = '<img src="https://www.gravatar.com/avatar/5c2ae1f9ee8c57a59ab2735bfd9797de?s=20&d=mm&r=g" alt=""/>';
        $this->assertEquals($shouldbe, $img);

        $isadmin = 1;
        $del = "comm/delete";
        $canedit = $commOne->getCanEdit($item, $isadmin, $del);
        $test = "Ta bort inlägget";
        $this->assertContains($test, $canedit);

        $can = "Ja";
        $getVal = $commOne->getValHtml($item, $can);
        $this->assertContains("Skrevs", $getVal);
    }
}
