<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class Paginator
{	
	private $berichten;

	public function __construct($pagequery,$showquery,$berichtperpagina)
	{
		$this->pagequery = $pagequery;
		$this->showquery = $showquery;
		$this->berichtperpagina = $berichtperpagina;
		$url = $_SERVER['REQUEST_URI'];
		$check = strpos($url,"?");
		if($check === false){
		$mark = "?";
		}
		else{
		$mark = "&";
		}	
		
		echo $mark;
	}	

	public function Currentpage()
	{
		if(!isset($_GET['pagenumber'])){
			$currentpage = 1;
		}else{
			$currentpage = $_GET['pagenumber'];
		}
		return $currentpage;
	}

	public function Berichten()
	{
		$berichten = mysql_query($this->pagequery);		
		$berichten = mysql_fetch_array($berichten);
		return $berichten[0];
	}

	public function Pages()
	{
		$pages = ceil($this->Berichten() / $this->berichtperpagina);
		return $pages;
	}
	
	public function Showall($geenberichten)
	{
		$limit = "limit ".($this->Currentpage() - 1) * $this->berichtperpagina.",".$this->berichtperpagina;
		$query = $this->showquery." ".$limit;
		$queryuitvoer = mysql_query($query);
		if(mysql_num_rows($queryuitvoer) !== 0){		
			while($result = mysql_fetch_assoc($queryuitvoer)){
				$array[] = $result; 
			}		
			return $array;
		}else{
		echo $geenberichten;
		}
	}

	public function Previouspage($weergave)
	{
		$pagenumber = $this->Currentpage();
		if ($pagenumber > 1){ 
			$previous = $pagenumber-1;
			$previouspage = '<a href="'.$_SERVER['PHP_SELF'].'?pagenumber='.$previous.'">'.$weergave.'</a>';
			return $previouspage;
		}
	}

	public function Nextpage($weergave)
	{
		$pagenumber = $this->Currentpage();
		if ($pagenumber < $this->Pages()){
			$next = $pagenumber+1;
			$nextpage = '<a href="'.$_SERVER['PHP_SELF'].'?pagenumber='.$next.'">'.$weergave.'</a>';
			return $nextpage;
		}	
	}

	public function Firstpage($weergave)
	{
		if($this->Currentpage() > 1){
			 $firstpage = '<a href="'.$_SERVER['PHP_SELF'].'?pagenumber=1">'.$weergave.'</a>';
		return $firstpage;
		}    	
	}

	public function Lastpage($weergave)
	{
		if($this->Currentpage() < $this->Pages()){ 
			$lastpage = '<a href="'.$_SERVER['PHP_SELF'].'?pagenumber='.$this->Pages().'">'.$weergave.'</a>';
		return $lastpage;
		}
	}
			
	public function Pagenumbers($maxpagenumbers)
	{	
		$pages = $this->Pages();
		if($pages > 0)
		{	
			$currentpage = $this->Currentpage();
			if($maxpagenumbers > $pages)
			{
				$maxpagenumbers = $pages;
				if($maxpagenumbers % 2 ){
				
				}else{
					$maxpagenumbers = $maxpagenumbers -1 ;
				}
			}
			$numbers = ($maxpagenumbers -1) / 2;
	
			$pagenumberleft = "";
			$pagenumbermid = "";
			$pagenumberright = "";
			$min = $currentpage - $numbers;
			$max = $currentpage + $numbers;      
			
			for($i = $min; $i <= $max; $i++ ){
				if($i > $pages ){
					$number = $i - $maxpagenumbers;
					$pagenumberleft .= '<a href="'.$_SERVER['PHP_SELF'].'?pagenumber='.$number.'">'.$number.'</a>&nbsp;';
				} 
				if($i > 0 && $i <= $pages){
					$pagenumbermid .= ($i == $currentpage) ? '<strong style="text-decoration:none;">'.$i.'</strong>&nbsp;'
					: '<a href="'.$_SERVER['PHP_SELF'].'?pagenumber='.$i.'">'.$i.'</a>&nbsp;';
				} 

				if($i <= 0){
					$number = $i + $maxpagenumbers;
					$pagenumberright .= '<a href="'.$_SERVER['PHP_SELF'].'?pagenumber='.$number.'">'.$number.'</a>&nbsp;';
				} 
			}
			$pagenumbers = $pagenumberleft.$pagenumbermid.$pagenumberright;
			return $pagenumbers;
		}
	}
}

?>
