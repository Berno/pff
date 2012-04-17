<?php

/**
 * Test class for App.
 * Generated by PHPUnit on 2012-03-04 at 11:37:03.
 */
class AppTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \pff\App
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $conf = new \pff\Config();
        $moduleManager = $this->getMock('\\pff\\ModuleManager', array(), array($conf));
        $this->object = new \pff\App('one/two/three', $conf, $moduleManager);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown() {
    }


    public function testSetErrorReportingProd() {
        $this->object->getConfig()->setConfig('development_environment', false);
        $this->object->setErrorReporting();
        $this->assertEquals('Off', ini_get('display_errors'));
    }

    /**
     * @covers \pff\App::setErrorReporting
     * @return void
     */
    public function testSetErrorReportingDev() {
        $this->object->getConfig()->setConfig('development_environment', true);
        $this->object->setErrorReporting();
        $this->assertEquals('On', ini_get('display_errors'));
    }

    /**
     * Tests the setting of a user defined route.
     *
     * @return void
     */
    public function testSetRoutes() {
        $this->assertEmpty($this->object->getRoutes());
        $this->object->addRoute('test', 'test');
        $tmp = $this->object->getRoutes();
        $this->assertArrayHasKey('test', $tmp);
        $this->assertEquals('Test', $tmp['test']);
    }

    public function testApplyRouting() {
        $this->object->addRoute('test', 'test');
        $tmpReq = 'test';
        $this->assertTrue($this->object->applyRouting($tmpReq));
        $this->assertEquals($tmpReq, 'Test_Controller');
    }

    /**
     * Fails the addition to a static route that points to a non existant file
     *
     * @return void
     */
    public function testSetRoutesFails() {
        $this->setExpectedException('\\pff\\RoutingException');
        $this->object->addRoute('test', 'testNOTController');
    }

    /**
     * Tests the setting of a user defined route.
     *
     * @return void
     */
    public function testSetStaticRoutes() {
        $this->assertEmpty($this->object->getStaticRoutes());
        $this->object->addStaticRoute('test', 'testPage.php');
        $tmp = $this->object->getStaticRoutes();
        $this->assertArrayHasKey('test', $tmp);
        $this->assertEquals('testPage.php', $tmp['test']);
    }

    public function testApplyStaticRouting() {
        $this->object->addStaticRoute('test', 'testPage.php');
        $tmpReq = 'test';
        $this->assertTrue($this->object->applyStaticRouting($tmpReq));
        $this->assertEquals($tmpReq, 'app' . DS . 'pages' . DS . 'testPage.php');
    }

    /**
     * Fails the addition to a static route that points to a non existant file
     *
     * @return void
     */
    public function testSetStaticRoutesFails() {
        $this->setExpectedException('\\pff\\RoutingException');
        $this->object->addStaticRoute('test', 'testNOTPage.php');
    }

}