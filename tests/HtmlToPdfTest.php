<?php

/**
 * PHP Version 5
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
use PHPUnit_Framework_TestCase as PHPUnit;
use Application\HtmlToPdf;

/**
 * This class provides methods to test the HtmlToPdf class
 * The HtmlToPdfTest class provides methods to build PDF documents from a HTML file or a 
 * string with HTML structure
 * 
 * @author Natan Augusto <natanaugusto@gmail.com>
 */
class HtmlToPdfTest extends PHPUnit {

    /**
     * Sets up the fixture, for example, open a network connection. This method 
     * is called before a test is executed
     */
    public function setUp() {
        $this->HtmlToPdf = new HtmlToPdf;
    }

    /**
     * Testes of create pdf
     */
    public function testCreatePdf() {
        $this->assertEquals('test.pdf', $this->HtmlToPdf->create('Teste', '/tmp/test.pdf'));
    }
    
    /**
     * Teste get/set of HtmlToPdf::getBin() and HtmlToPdf::setBin()
     */
    public function testGetSetExec() {
        //Exec
        $this->assertEquals('/usr/local/bin/wkhtmltopdf', $this->HtmlToPdf->getExec());
        $this->assertEmpty($this->HtmlToPdf->setExec('/usr/local/bin/wkhtmltoimage'));
        $this->assertEquals('/usr/local/bin/wkhtmltoimage', $this->HtmlToPdf->getExec());
    }
    
    /**
     * Teste get/set of HtmlToPdf::getTmp() and HtmlToPdf::setTmp()
     */
    public function testGetSetTmp() {
        //Tmp
        $this->assertEquals('/tmp', $this->HtmlToPdf->getTmp());
        $this->assertEmpty($this->HtmlToPdf->setTmp('/home/natan/Projects/tmp'));
        $this->assertEquals('/home/natan/Projects/tmp', $this->HtmlToPdf->getTmp());
    }

    /**
     * Tears down the fixture, for example, close a network connection. This 
     * method is called after a test is executed.
     */
    public function tearDown() {
        
    }

}
