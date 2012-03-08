<?php
require('config.php');
require('paginatorclass.php');

class PaginatorTest extends PHPUnit_Framework_TestCase
{
    public $pagination;
    public function setUp()
    {
        $dbcon = mysql_connect($GLOBALS['server'], $GLOBALS['username'], $GLOBALS['password']);
        mysql_select_db($GLOBALS['db'], $dbcon) or trigger_error(mysql_error());
        $query = "SELECT id FROM gastenboek";
        $showquery = "SELECT * FROM gastenboek";
        $berichtperpagina = 3;
   
        $_SERVER['REQUEST_URI'] = 'http://impres.local/github/testgit/index.php';
   
        $this->pagination = new Paginator($query,$showquery,$berichtperpagina);
        $this->berichtenaantal = $this->pagination->Berichten();
    }
   
    public function testCurrentpage()
    {
        $this->assertEquals(1, $this->pagination->Currentpage());
    }
   
    public function testBerichten()
    {
        $this->assertEquals(9, $this->pagination->Berichten());
    }
 
    public function testPages(){
        $this->assertEquals(true, is_numeric($this->pagination->Pages()));
    }

    public function testShowall()
    {
        $geenberichten = "er zijn geen berichten";
        $this->pagination->Showall($geenberichten); 
        $this->assertEquals(true, is_array($this->pagination->Showall($geenberichten)));
    }

    public function testPreviouspage(){
		$this->Currentpage() = 5;
        $weergave = 'iets';
        $this->assertEquals(true, is_string($this->pagination->Previouspage($weergave)));
    }
    public function testNextpage(){
        $weergave = 'iets';
        $this->assertEquals(true, is_string($this->pagination->Nextpage($weergave)));
    }
    public function testFirstpage(){
        $weergave = 'iets';
        var_dump($this->pagination->Firstpage($weergave));
        $this->assertEquals(true, is_string($this->pagination->Firstpage($weergave)));
    }
    public function testLastpage(){
        $weergave = 'iets';
        $this->assertEquals(true, is_string($this->pagination->Lastpage($weergave)));
    }
    /*/**
     * @depends testOne
     */
    /*public function testTwo()
    {
    }*/
}
?>

