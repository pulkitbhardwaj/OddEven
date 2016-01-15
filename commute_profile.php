<?php

include 'header.inc.php';

$id = $_GET['no'];
$route = $_GET['rt'];

require 'db_connect.inc.php';

$query = "Select * from people p, commutes c where id = '".mysql_real_escape_string($id)."' and route_no = '".mysql_real_escape_string($route)."' and p.id = c.p_id";

if($query_run = mysql_query($query)){

	$row = mysql_fetch_array($query_run);
	
	$name = $row['name'];
	$gender = $row['gender'];
	$address = $row['address'];
	$phone = $row['phone_no'];
	$email = $row['email'];
	$source = $row['source'];
	$destination = $row['destination'];
	$views = $row['views'];

	$views++;

	$query = "Update commutes Set views = '$views' where p_id = '".mysql_real_escape_string($id)."' and route_no = '".mysql_real_escape_string($route)."'";

	$query_run = mysql_query($query);

	if(file_exists("people_images/".$id.".jpg"))
		$img_scr = "people_images/".$id.".jpg";

	else
		$img_scr = "people_images/empty.png";

?>

<html>

<head>
	<title>OddEven - Commute</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/flexbox.css">
	<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    
</head>

<body>
	
	<div class="list2">
		<img src=<?php echo $img_scr; ?> class="list2-item dp">
		<ul class="list2-item list-item-data">
			<li class="name"><?php echo $name; ?></li>
			<li><?php echo $gender; ?></li>
			<li class="address"><?php echo $address; ?></li>
			<?php
			if(logged_in()){ ?>
			<li id="phone"><?php echo $phone; ?></li>
			<?php } ?>
			<li><?php echo $email; ?></li>
			<li class="from" id="source"><?php echo $source; ?></li>
			<li class="to" id="destination"><?php echo $destination; ?></li><br>
			<li class="static_map"><img src="https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyAq3k9MvDbfTDMsx6tOycIs0-HWtRDY0Rw&size=400x300&sensor=false&markers=<?php echo $destination; ?>" alt="pitampura"></li>
			
			<div id="map"></div>

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
		</ul>
	</div>
	<div class="back">
	<a href="index.php" class="button">Back</a>
	</div>

<?php
}
?>
	
	<script type="text/javascript" src="js/jquery.js"></script>
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAq3k9MvDbfTDMsx6tOycIs0-HWtRDY0Rw&sensor=false">
				</script>
				<script type="text/javascript">
				
				$(".static_map").remove();
				var map;
				var bounds;
				var geocoder;
				var center;
				function initialize() {
					var mapOptions = {
						center: new google.maps.LatLng(28.644800, 77.216721),
						zoom: 8,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					map = new google.maps.Map(document.getElementById("map"),
						mapOptions);
					geocoder = new google.maps.Geocoder();
					bounds = new google.maps.LatLngBounds();
				}
				function addMarkerToMap(location){
					var marker = new google.maps.Marker({map: map, position: location});
					bounds.extend(location);
					map.fitBounds(bounds);
				}
				initialize();

				$("#source").each(function(){
					var $address = $(this);
					geocoder.geocode({address: $address.text()}, function(results, status){
						if(status == google.maps.GeocoderStatus.OK) addMarkerToMap(results[0].geometry.location);
					});
				});


				$("#destination").each(function(){
					var $address = $(this);
					geocoder.geocode({address: $address.text()}, function(results, status){
						if(status == google.maps.GeocoderStatus.OK) addMarkerToMap(results[0].geometry.location);
					});
				});

				google.maps.event.addDomListener(map, "idle", function(){
					center = map.getCenter();
				});

				$(window).resize(function(){
					map.setCenter(center);
				});

				</script>
	

</body>
</html>