<?php
class PostprocessTest extends PHPUnit_Framework_TestCase
{
    function setUp()
    {
    }
    
    function createPostprocess() 
    {
        require_once '../src/Ilib/Payment/Html/Postprocess.php';
        return new Ilib_Payment_Html_Postprocess('merchant', 'verification', 'session');
    }

    function testConstructor()
    {
        $prepare = $this->createPostprocess();
        $this->assertTrue(is_object($prepare));
    }
}

