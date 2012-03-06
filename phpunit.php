<?php
class PhpUnitTest extends PHPUnit_Framework_TestCase
{
	public function testOne()
    {
        $this->assertTrue(TRUE);
    }
 
    /**
     * @depends testOne
     */
    public function testTwo()
    {
    }
}

class RekenMaarRaak extends PHPUnit_Framework_TestCase
{
	public $getal1;
	public $getal2;
	public $getal3;

	public function add($getal1, $getal2)
	{
		$this->getal1 = 5;
		$this->getal2 = 3;
		$this->getal1 + $this->getal2 = $this->getal3;
		$this->assertEquals($this->getal3, 8);
		
		return $this->getal3;
	}	
	public function subtract()
	{
		$this->getal1 = 5;
		$this->getal2 = 3;
		$this->getal1 - $this->getal2 = $this->getal3;
		$this->assertEquals($this->getal3, 2);

		return $this->getal3;
	}

	public function multiply()
	{
		$this->getal1 = 5;
		$this->getal2 = 3;
		$this->getal1 * $this->getal2 = $this->getal3;
		$this->assertEquals($this->getal3, 15);

		return $this->getal3;
	}
	public function divide()
	{
		$this->getal1 = 5;
		$this->getal2 = 3;
		$this->getal1 / $this->getal2 = $this->getal3;
		$this->assertEquals($this->getal3, 25);

		return $this->getal3;
	}
}


?>
