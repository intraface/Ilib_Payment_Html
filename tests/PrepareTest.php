<?php
require_once 'PHPUnit/Framework.php';

PHPUnit_Util_Filter::addDirectoryToWhitelist(realpath(dirname(__FILE__) . '/../src/'));
PHPUnit_Util_Filter::removeDirectoryFromWhitelist(realpath(dirname(__FILE__) . '/../src/Ilib/Payment/Html/Controller/'));
PHPUnit_Util_Filter::removeDirectoryFromWhitelist(realpath(dirname(__FILE__) . '/../src/Ilib/Payment/Html/templates/'));

class PrepareTest extends PHPUnit_Framework_TestCase
{
    function setUp()
    {

    }
    
    function createPrepare() {
        require_once '../src/Ilib/Payment/Html/Prepare.php';
        return new Ilib_Payment_Html_Prepare('merchant', 'verification', 'session');
    }

    function testConstructor()
    {
        $prepare = $this->createPrepare();
        $this->assertTrue(is_object($prepare));
    }
    
    function testSetPaymentValues() {
        $prepare = $this->createPrepare();
        $this->assertTrue($prepare->setPaymentValues(1, 100.00, 'DKK', 'DK', 'http://localhosts/ok', 'http://localhosts/error', 'http://localhosts/result', 'http://localhosts/input'));
        
    }
    
    function testSetOptionalValues() {
        $prepare = $this->createPrepare();
        $this->assertTrue($prepare->setOptionalValues(array('var1' => 10, 'var2' => 20)));
    }
    
    function testGetPostDestination()
    {
        $prepare = $this->createPrepare();
        $this->assertNULL($prepare->getPostDestination());
        
    }
}
?>