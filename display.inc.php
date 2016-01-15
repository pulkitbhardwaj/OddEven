<html>

<head>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="css/flexbox.css">
</head>

<?php

require 'db_connect.inc.php';

//$query = "Select * from people left join commutes on people.id = commutes.id";

if($query_run = mysql_query($query)){

	$num_rows = mysql_num_rows($query_run);

	if($num_rows != 0){

		if($flag)
			echo 'Search Results : <br><br>';
		else
			echo 'Popular Commutes : <br><br>';

		while($rows = mysql_fetch_assoc($query_run)){ 
			$temp_id = $rows['p_id'];
			$temp_route = $rows['route_no'];
			$next_page = 'commute_profile.php?no='.urldecode($temp_id).'&rt='.urldecode($temp_route);
			

			if(file_exists("people_images/".$temp_id.".jpg"))
				$img_scr = "people_images/".$temp_id.".jpg";

			else
				$img_scr = "people_images/empty.png";
?>
	

<body>
	<div class="list">
		
		<div class="list-item">
			<a href=<?php echo $next_page; ?> class="popular_commutes">
			<img class="dp" src=<?php echo $img_scr; ?>></div>
		<div class="list-item list-item-data">

		<ul>
			<li class="name"><?php echo $rows['name']; ?></li>
			<li class="email"><?php echo $rows['email']; ?></li>
			<li class="gender"><?php echo $rows['gender']; ?></li>
			<li class="address"><?php echo $rows['address']; ?></li>
		</ul>
		</a>
		</div>
		<div class="list-item list-item-data">
			<a href=<?php echo $next_page; ?> class="popular_commutes">
			<table>
				<tr>
					<td><label class="from">From</label></td>
					<td> : </td>
					<td><?php echo $rows['source']; ?></td>
				</tr>
				<tr>
					<td><label class="to">To</label></td>
					<td> : </td>
					<td><?php echo $rows['destination']; ?></td>
				</tr>
			</table>
			
			</a>
			
		</div>
		
			<?php

			if(!logged_in()){
			?>
				<a class="list-item last-item request" href="#" data-toggle="modal" data-target="#login">Send Request</a>
			<?php
			}

			else{
			?>	
				<a class="list-item last-item request" href="request.php">Send Request</a>

			<?php
			}
			?>	
	
	</div>

<?php
		}
	}
	else{
		if($flag)
			echo 'No Results Found';
		else
			echo 'No Commutes';
	}
		
}

else
	echo 'query not executed';

?>

</body>


</html>