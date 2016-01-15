<html>
<head>
	<title>Hay Rom Carpooling</title>
</head>
</html>

<?php

include 'header.inc.php';

$query = NULL;
$flag = false;

if(logged_in()){

	require ('db_connect.inc.php');

	$query = "Select * from people where id = '".mysql_real_escape_string($id)."'";

	if($query_run = mysql_query($query)){

		$name = mysql_result($query_run, 0, 'name');
			
		echo 'Welcome '.$name.'<br><br>';
	}
}

$search_src = NULL;
$search_dest = NULL;

if(isset($_GET['search_src'])&&isset($_GET['search_dest'])){

	$search_src = $_GET['search_src'];
	$search_dest = $_GET['search_dest'];
	$flag = true;

	if(empty($search_src)&&empty($search_dest)){
	
		if(logged_in()){
			$query = "Select * from people p, commutes c where id != '".mysql_real_escape_string($id)."' and p.id = c.p_id order by views desc";
		}
		else
			$query = "Select * from people p, commutes c where p.id = c.p_id order by views desc";
	}

	else if(empty($search_src)){
		if(logged_in()){
			$query = "Select * from people p, commutes c where id != '$id' and c.destination like '%".$search_dest."%' and p.id = c.p_id order by views desc";
		}
		else
			$query = "Select * from people p, commutes c where c.destination like '%".$search_dest."%' and p.id = c.p_id order by views desc";
	}

	else if(empty($search_dest)){
		if(logged_in()){
			$query = "Select * from people p, commutes c where id != '$id' and c.source like '%".$search_src."%' and p.id = c.p_id order by views desc";
		}
		else
			$query = "Select * from people p, commutes c where c.source like '%".$search_src."%' and p.id = c.p_id order by views desc";
	}

	else{
		if(logged_in()){
			$query = "Select * from people p, commutes c where id != '$id' and c.source like '%".$search_src."%' and c.destination like '%".$search_dest."%' and p.id = c.p_id order by views desc";
		}
		else
			$query = "Select * from people p, commutes c where c.source like '%".$search_src."%' and c.destination like '%".$search_dest."%' and p.id = c.p_id order by views desc";
	}
		
}
else{
	
	if(logged_in()){
		$query = "Select * from people p, commutes c where id != '$id' and p.id = c.p_id order by views desc";
	}
	else
		$query = "Select * from people p, commutes c where p.id = c.p_id order by views desc";
}
//include 'search.inc.php';

include 'display.inc.php';

?>