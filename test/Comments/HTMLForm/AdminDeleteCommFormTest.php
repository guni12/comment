<?php

namespace Anax\Comments\HTMLForm;

use \Anax\DI\DIFactoryConfig;
use \Anax\Comments\Comm;

/**
 * HTML Form elements.
 */
class AdminDeleteCommFormTest extends \PHPUnit_Framework_TestCase
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
        $commForm = new AdminDeleteCommForm($this->di);
        $this->assertInstanceOf("\Anax\Comments\HTMLForm\AdminDeleteCommForm", $commForm);
    }

    public function testAllPosts()
    {
        $delete = new AdminDeleteCommForm($this->di);
        $res = $delete->getAllPosts();
        $check = [1 => 'Testtitel (1)', 2 => 'Nya tag (2)', -1 => 'Välj en text...', 3 => 'Tufft (3)'];
        $this->assertEquals($check, $res);
        $this->assertArraySubset([-1 => "Välj en text..."], $res);
    }
}
