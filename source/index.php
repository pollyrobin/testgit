<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

/** added comment to verify sha1 git test **/ 

require('paginatorclass.php');
require('config.php');

$dbcon = mysql_connect($server, $username, $password);
mysql_select_db($db, $dbcon) or trigger_error(mysql_error());

$query = "SELECT id FROM gastenboek";
$showquery = "SELECT * FROM gastenboek";
$berichtperpagina = 3;
		
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
echo $pagination->Pagenumbers(4);
echo $pagination->Nextpage($weergavenext);
echo $pagination->Lastpage($weergavelast);

?>
