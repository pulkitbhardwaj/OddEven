<?php

session_start();

$id = NULL;

if(isset($_SESSION['email'])){

	$email = $_SESSION['email'];

	if(!empty($email)){

		require ('db_connect.inc.php');

		$query = "Select * from people where email = '".$email."'";

		if($query_run = mysql_query($query)){

			$rows = mysql_num_rows($query_run);

			$id = mysql_result($query_run, 0, 'id');
		}
	}
}

function logged_in(){
	if(isset($_SESSION['email']))
		return true;

	else
		return false;
}

?>