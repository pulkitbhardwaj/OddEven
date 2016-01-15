<?php

include 'header.inc.php';

$flag = false;
$email = NULL;

// if(isset($_SESSION['email'])){
// 	$email_fb = $_SESSION['email'];

// 	unset($_SESSION['email']);

// 	if(!empty($email_fb)){

// 			require ('../db_connect.inc.php');

// 			$query = "Select id from people where email = '".$email_fb."'";

// 			if($query_run = mysql_query($query)){

// 				$rows = mysql_num_rows($query_run);

// 				if($rows == 0)
// 					$flag = true;

// 				else{
// 					$id = mysql_result($query_run, 0, 'id');
			
// 					$_SESSION['user'] = $id;

// 					if(preg_match('/commute_profile.php/', $target))
// 						header('Location: default.php');
// 					else
// 						header('Location: '.$target);
// 				}
// 			}
// 		}
// }

if(logged_in()){
	header('Location: index.php');
}

else{

	if(isset($_POST['email'])&&isset($_POST['password'])){

		$email = $_POST['email'];
		$password = $_POST['password'];
		$target = $_SESSION['target_page'];

		unset($_SESSION['target_page']);

		if(!empty($email)&&!empty($password)){

			require ('db_connect.inc.php');

			$query = "Select * from people where email = '".mysql_real_escape_string($email)."' and password = '".mysql_real_escape_string($password)."'";

			if($query_run = mysql_query($query)){

				$rows = mysql_num_rows($query_run);

				if($rows == 0)
					$flag = true;

				else{
					$_SESSION['email'] = $email;

					if(preg_match('/commute_profile.php/', $target))
						header('Location: index.php');
					else
						header('Location: '.$target);
				}
			}
		}
		else
			$flag = true;
	}
}

?>
