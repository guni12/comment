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
        $findDb = realpath(__DIR__ . "/../../../../../data/db.sqlite");
        $longpath = "C:\Users\Gunvor\Documents\code\p\dbwebb-kurser\\";
        $longpath .= "ramverk1\me\anax\data\db.sqlite";
        $this->assertEquals($longpath, $findDb);
        $comm->setDb($this->di->get("db"));
        //$url = $this->di->get("url");
        //$res3 = call_user_func([$url, "create"], "comm");
        //$this->assertEquals("://C:/cygwin64/usr/local/bin/phpunit.phar/comm", $res3);
        //$here = realpath(__DIR__);
        $res2 = $comm->find("id", 1);
        $this->assertInstanceOf("\Anax\Comments\Comm", $res2);
        $res4 = $comm->find("email", "gunvor@behovsbo.se");
        $this->assertInstanceOf("\Anax\Comments\Comm", $res4);

        //$commController = $this->di->get("commController");
        //$res5 = new ShowOneService($this->di, 1);
    }



    /**
     * Test case to initiate through re-randomze an object.
     *//*
    public function testRandom()
    {
        $guess = new Guess();
        $guess->random();
        $this->assertEquals(6, $guess->tries());
        $guess->random(7);
        $this->assertEquals(7, $guess->tries());
    }*/






    /**
     * Test
     */
    /*
    public function testGetGravatar($email, $size = 20, $dim = 'mm', $rad = 'g', $img = false, $atts = array())
    {
        $gravatar = new Comm($this->di);
        $form->create();

        $res = $form->getHTML();
        $exp = <<<EOD
\n<form id='anax/htmlform' class='htmlform' method='post'>
<input type="hidden" name="anax/htmlform-id" value="anax/htmlform" />
<fieldset>



</fieldset>
</form>\n
EOD;

        $this->assertEquals($res, $exp, "Empty form missmatch.");
    }



    /**
     * Test
     *//*
    public function testCreate2()
    {
        $form = new Form($this->di);
        $form->create([
            "enctype" => "multipart/form-data"
        ]);

        $res = $form->getHTML();
        $exp = <<<EOD
\n<form id='anax/htmlform' class='htmlform' method='post' enctype='multipart/form-data'>
<input type="hidden" name="anax/htmlform-id" value="anax/htmlform" />
<fieldset>



</fieldset>
</form>\n
EOD;

        $this->assertEquals($res, $exp, "Form with enctype missmatch.");
    }*/
}
