<?php

namespace Anax\Comments;

use \Anax\DI\DIFactoryConfig;

/**
 * HTML Form elements.
 */
class CommControllerTest extends \PHPUnit_Framework_TestCase
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
        $commC = new CommController($this->di);
        $this->assertInstanceOf("\Anax\Comments\CommController", $commC);
    }
}
