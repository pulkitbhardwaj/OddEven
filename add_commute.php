<?php

include 'header.inc.php';

if(!logged_in())
	header('Location: login.php');

else{
	if(isset($_POST['source1'])&&isset($_POST['destination1'])){
		
		require 'db_connect.inc.php';

		$query = "Select MAX(route_no) from commutes where p_id = '".mysql_real_escape_string($id)."'";

		if($query_run = mysql_query($query)){

			$row = mysql_fetch_array($query_run);
			$r_no = $row['MAX(route_no)'];

			if(empty($r_no))
				$r_no = 0;

			$r_no++;

			if($r_no < 11){
				for($count=1;$count<11;$count++){

					$source = $_POST['source'.$count];
					$destination = $_POST['destination'.$count];

					if (!empty($source)&&!empty($destination)) {
						$query = "Insert into commutes(p_id, route_no, source, destination, time) values('".mysql_real_escape_string($id)."', 
									'".mysql_real_escape_string($r_no)."', '".mysql_real_escape_string($source)."', 
									'$destination', 'strtotime(\'9:50:00\')')";

						mysql_query($query);
						$r_no++;
					}

					else
						break;
				}
			}
		}
		header('Location: commutes.php');
	}
}


?>

<html>

<head>
	<title>Add Your Daily Commutes</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css"> -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>

<body>

	<form action="add_commute.php" method="post">

		<div class="all_commutes">

			<input type="text" id="s1" name="source1" class="add-commute" placeholder="Source">
			<input type="text" id="d1" name="destination1" class="add-commute" placeholder="Destination">
			
			<div class="commutes2">
				<input type="text" id="s2" name="source2" class="add-commute" placeholder="Source">
				<input type="text" id="d2" name="destination2" class="add-commute" placeholder="Destination">
			</div>

			<div class="commutes3">
				<input type="text" id="s3" name="source3" class="add-commute" placeholder="Source">
				<input type="text" id="d3" name="destination3" class="add-commute" placeholder="Destination">
			</div>

			<div class="commutes4">
				<input type="text" id="s4" name="source4" class="add-commute" placeholder="Source">
				<input type="text" id="d4" name="destination4" class="add-commute" placeholder="Destination">
			</div>

			<div class="commutes5">
				<input type="text" id="s5" name="source5" class="add-commute" placeholder="Source">
				<input type="text" id="d5" name="destination5" class="add-commute" placeholder="Destination">
			</div>

			<div class="commutes6">
				<input type="text" id="s6" name="source6" class="add-commute" placeholder="Source">
				<input type="text" id="d6" name="destination6" class="add-commute" placeholder="Destination">
			</div>

			<div class="commutes7">
				<input type="text" id="s7" name="source7" class="add-commute" placeholder="Source">
				<input type="text" id="d7" name="destination7" class="add-commute" placeholder="Destination">
			</div>

			<div class="commutes8">
				<input type="text" id="s8" name="source8" class="add-commute" placeholder="Source">
				<input type="text" id="d8" name="destination8" class="add-commute" placeholder="Destination">
			</div>

			<div class="commutes9">
				<input type="text" id="s9" name="source9" class="add-commute" placeholder="Source">
				<input type="text" id="d9" name="destination9" class="add-commute" placeholder="Destination">
			</div>

			<div class="commutes10">
				<input type="text" id="s10" name="source10" class="add-commute" placeholder="Source">
				<input type="text" id="d10" name="destination10" class="add-commute" placeholder="Destination">
			</div>
			<br><br>
			<a href='#' class="add_com">Add More</a>

		</div>

		
		<br>
		<a href="commutes.php" class="button"> Add Later</a>
		<input type="submit" value="Add Commutes" class="button">
	
	<form>

	<script type="text/javascript">

		var $count = 2;

		$(".commutes2").hide();
		$(".commutes3").hide();
		$(".commutes4").hide();
		$(".commutes5").hide();
		$(".commutes6").hide();
		$(".commutes7").hide();
		$(".commutes8").hide();
		$(".commutes9").hide();
		$(".commutes10").hide();
		
		$(".add_com").click(function(){

			if($count<11){
				$(".commutes"+$count).show("slow");
				
				if($count == 10){
					$link = $(this);
					$link.remove();
				}

				$count++;
			}
			return false;
		});



		var placeSearch, autocomplete;

		function initAutocomplete() {
		  
		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('s1')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('d1')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('s2')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('d2')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('s3')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('d3')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('s4')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('d4')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('s5')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('d5')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('s6')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('d6')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('s7')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('d7')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('s8')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('d8')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('s9')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('d9')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('s10')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);

		  autocomplete = new google.maps.places.Autocomplete((document.getElementById('d10')), {types: ['geocode']});
		  autocomplete.addListener('place_changed', fillInAddress);
		}


		function fillInAddress() {

		var place = autocomplete.getPlace();


		  for (var i = 0; i < place.address_components.length; i++) {
		    var addressType = place.address_components[i].types[0];
		    if (componentForm[addressType]) {
		      var val = place.address_components[i][componentForm[addressType]];
		      document.getElementById(addressType).value = val;
		    }
		  }
		}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAq3k9MvDbfTDMsx6tOycIs0-HWtRDY0Rw&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
</body>

</html>