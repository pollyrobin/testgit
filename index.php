<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

require('paginatorclass.php');

$dbcon = mysql_connect("ip server", "user", "password");
mysql_select_db("dfguser", $dbcon) or trigger_error(mysql_error());

$query = "SELECT id FROM gastenboek";
$showquery = "SELECT * FROM gastenboek";
$berichtperpagina = 2;
		
$pagination = new Paginator($query,$showquery,$berichtperpagina);

$geenberichten = "er zijn geen berichten";
$berichten = $pagination->Showall($geenberichten);
if (is_array($berichten)){
	foreach($berichten as $result){
		echo $result['naam']."<br />";
		echo $result['titel']."<br />";
		echo $result['bericht']."<br />";
		echo $result['plaats_datum']."<br />";
	}
}

$weergavefirst = '<--'; 
$weergaveprev = '<-'; 
$weergavenext = '->'; 
$weergavelast = '-->'; 
echo $pagination->Firstpage($weergavefirst);
echo $pagination->Previouspage($weergaveprev);
echo $pagination->Nextpage($weergavenext);
echo $pagination->Lastpage($weergavelast);
echo '<br />';
echo $pagination->Pagenumbers(3);


?>

