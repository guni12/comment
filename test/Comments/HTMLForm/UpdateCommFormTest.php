<?php

namespace Anax\Comments\HTMLForm;

use \Anax\DI\DIFactoryConfig;
use \Anax\Comments\Comm;

/**
 * HTML Form elements.
 */
class UpdateCommFormTest extends \PHPUnit_Framework_TestCase
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
        $commForm = new UpdateCommForm($this->di, 3, 2);
        $this->assertInstanceOf("\Anax\Comments\HTMLForm\UpdateCommForm", $commForm);
    }

    public function testEvenMoreStuff()
    {
        $id = 2;
        $sessid = 1;
        $commForm = new UpdateCommForm($this->di, $id, $sessid);
        $val = $commForm->getCommDetails($id);
        $text = $commForm->decode($val->comment);
        $title = "Testar update";
        $res2 = $commForm->aForm($id, $sessid, $val, $text);
        //include("/../../../htdocs/incl/renderPage.php");
    }
}
