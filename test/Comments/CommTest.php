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
        $titel = "";
        $text = "";
        $val = [];
        $comm = new Comm();
        //$this->assertClassHasAttribute('title', new Comm);
        $this->assertInstanceOf("\Anax\Comments\Comm", $comm);
        $res = $comm->getGravatar("gunvor@behovsbo.se");
        $this->assertEquals("https://www.gravatar.com/avatar/2438dc720f1ca2c32c27a5bb658229c4?s=20&d=mm&r=g", $res);
        $comm->setDb($this->di->get("db"));
        $res2 = $comm->find("id", 1);
        $this->assertInstanceOf("\Anax\Comments\Comm", $res2);
        $res4 = $comm->find("email", "helga@helgon.se");
        $this->assertInstanceOf("\Anax\Comments\Comm", $res4);
        $titel = "Tom";
        $text = "Array";
        $val = $res2;
        //include("/../../htdocs/incl/renderPage.php");
    }


    public function setObjectVars($object, array $vars)
    {
        $has = get_object_vars($object);
        foreach ($has as $name => $oldValue) {
            $object->$name = isset($vars[$name]) ? $vars[$name] : null;
        }
    }

    public function testMoreStuff()
    {
        $titel = "";
        $text = "";
        $val = [];
        //$this->insert();

        $comm = new Comm();
        $comm->setDb($this->di->get("db"));

        $res2 = $comm->find("id", 2);
        $this->assertObjectHasAttribute('parentid', $res2);
        $arr = [];
        $res3 = $this->setObjectVars($res2, $arr);
        $title = "Nya tag";
        $val = $res3;
        //include("/../../htdocs/incl/renderPage.php");
    }

    public function insert()
    {
        sleep(10);
        $textfilter = $this->di->get("textfilter");
        $comment = "Testar att skriva i test.";
        $title = "Titel i test";
        $parses = ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"];
        $comment = $textfilter->parse($comment, $parses);
        $comment->frontmatter['title'] = $title;
        $comment = json_encode($comment);
        $email = "arne@anka.se";

        $now = date("Y-m-d H:i:s");

        $comm = new Comm();
        $comm->setDb($this->di->get("db"));
        $comm->title = $title;
        $comm->userid = "2";
        $comm->parentid = "1";
        $comm->comment = $comment;
        $comm->email = $email;
        $comm->created = $now;
        $comm->updated = "00-00-00 00:00:00";
        $comm->save();
    }
}
