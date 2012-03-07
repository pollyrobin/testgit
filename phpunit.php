<?php
require('config.php');
require('paginatorclass.php');

class PaginatorTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$dbcon = mysql_connect($GLOBALS['server'], $GLOBALS['username'], $GLOBALS['password']);
		mysql_select_db($GLOBALS['db'], $dbcon) or trigger_error(mysql_error());
		$query = "SELECT id FROM gastenboek";
		$showquery = "SELECT * FROM gastenboek";
		$berichtperpagina = 3;	
		$geenberichten = "er zijn geen berichten";
	
		$_SERVER['REQUEST_URI'] = 'http://impres.local/github/testgit/index.php';
		
		$pagination = new Paginator($query,$showquery,$berichtperpagina);
		$berichten = $pagination->Showall($geenberichten);
	}
	
	public function testCurrentpage()
	{
		$this->assertEquals(1,$this->testCurrentpage());
	}
 
    /**
     * @depends testOne
     */
    public function testTwo()
    {
    }
}
?>
