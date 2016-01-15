<html>
<head>

	<title>OddEven - My Commutes</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css"> -->
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

<?php

include 'header.inc.php';

if(!logged_in())
	header('Location: login.php');

else{

	require 'db_connect.inc.php';

	$query = "Select source, destination from commutes where p_id = '".mysql_real_escape_string($id)."'";

	if($query_run = mysql_query($query)){
		
		$num_rows = mysql_num_rows($query_run);

		if($num_rows != 0){ ?>

		<table>
					<br><br>
					<tr>
						<th>Source</th>
						<th>Destination</th>
					</tr>

		<?php			
			while($rows = mysql_fetch_assoc($query_run)){ ?>

					<tr>
						<td><?php echo $rows['source']; ?></th>
						<td><?php echo $rows['destination']; ?></th>
					</tr><br>

				</table>

			<?php
			}?>

		</table> 
		<?php
		}

		else
			echo '<br><br>You have no Daily Commutes';
		
	}
}

?>
<br><br>
<a href="add_commute.php" class="button">Add Daily Commutes</a>
</body>
</html>