<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Sden81\BracketCalc;

class BracketCalcTest extends TestCase
{
    protected $_bracketCalc;

    protected function setUp()
    {
        $this->_bracketCalc = new BracketCalc();
    }

    /**
     * неправильные скобки
     */
    public function testInvalidBrackets()
    {
        $this->_bracketCalc->setInputText(")(()");
        $this->assertFalse($this->_bracketCalc->analyzeThis());
    }

    /**
     * правильные скобки
     */
    public function testVailidBrackets()
    {
        $this->_bracketCalc->setInputText("()");
        $this->assertTrue($this->_bracketCalc->analyzeThis());
    }

    /**
     * пустой текст
     */
    public function testEmptyText()
    {
        $this->_bracketCalc->setInputText("");
        $this->expectException(InvalidArgumentException::class);
        $this->_bracketCalc->analyzeThis();
    }

    /**
     * неправильный текст
     */
    public function testInvalidText()
    {
        $this->_bracketCalc->setInputText("denis ");
        $this->expectException(InvalidArgumentException::class);
        $this->_bracketCalc->analyzeThis();
    }

}
