<?php

include 'header.inc.php';

$flag = false;
$user_flag = false;

$fname = NULL;
$lname = NULL;
$email = NULL;
$password = NULL;
$password_again = NULL;
$gender = NULL;
$adress = NULL;
$phone = NULL;
$plate = NULL;

if(logged_in()){
	header('Location: index.php');
}

else{
	
	if(isset($_POST['fname'])&&
		isset($_POST['lname'])&&
		isset($_POST['email'])&&
		isset($_POST['password'])&&
		isset($_POST['password_again'])&&
		isset($_POST['gender'])&&
		isset($_POST['address'])&&
		isset($_POST['phone'])&&
		isset($_POST['plate'])){

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_again = $_POST['password_again'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$plate = $_POST['plate'];

		if(!empty($fname)&&
			!empty($lname)&&
			!empty($email)&&
			!empty($password)&&
			!empty($password_again)&&
			!empty($gender)&&
			!empty($address)&&
			!empty($phone)&&
			!empty($plate)){

			$name = $fname.' '.$lname;

			if($password != $password_again)
				$flag = true;
			
			else{

				require 'db_connect.inc.php';

				$query = "Select email from people where email = '$email'";
				$query_run = mysql_query($query);

				if(mysql_num_rows($query_run)==1)
					$user_flag = true;
				
				else{
				
					$query = "Insert into people(name, email, password, gender, address, phone_no, numberplate) 
								values('".mysql_real_escape_string($name)."', '".mysql_real_escape_string($email)."', 
								'".mysql_real_escape_string($password)."', '".mysql_real_escape_string($gender)."', 
								'".mysql_real_escape_string($address)."', '".mysql_real_escape_string($phone)."', 
								'".mysql_real_escape_string($plate)."')";

					$query_run = mysql_query($query);

					if($query_run){

						$query = "Select id from people where email = '".mysql_real_escape_string($email)."'";
						
						if($query_run = mysql_query($query)){

							$row = mysql_num_rows($query_run);

							if($row != 0){
								$_SESSION['email'] = $email;
								header('Location: add_commute.php');
							}
						}
					
					}
					
					else
						echo 'You couldn\'t be registered at this moment. Please Try Again Later.';
					
				}
				
			}

		}

		else
			echo '<br><br>*All the fields are required';
	}
}

?>

<html>
	<head>
		<title>OddEven - Sign Up</title>
		<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css"> -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<h1>Sign Up to Offer a Ride</h1>

		<form method="post" action="register.php" name="register">
			<table>
				
				<tr>
					<td><label for="fname">First Name : </label></td>
					<td><input type="text" id="fname" name="fname" value="<?php if(isset($fname)){ echo $fname; } ?>"></td>
				</tr>

				<tr>
					<td><label for="lname">Last Name : </label></td>
					<td><input type="text" id="lname" name="lname" value="<?php if(isset($lname)){ echo $lname; } ?>"></td>
				</tr>

				<tr>
					<td><label for="email">Email ID : </label></td>
					<td><input type="email" id="email" name="email" value="<?php if(isset($email)){ echo $email; } ?>"></td>
					<td><?php if($user_flag) { echo '  *User already registered';} ?></td>
				</tr>

				<tr>
					<td><label for="password">Password : </label></td>
					<td><input type="password" id="password" name="password" value="<?php if(isset($password)){ echo $password; } ?>"></td>
				</tr>

				<tr>
					<td><label for="password_again">Re-Type Password : </label></td>
					<td><input type="password" id="password_again" name="password_again" value="<?php if(isset($password_again)){ echo $password_again; } ?>"></td>
					<td><?php if($flag) { echo '  *Passwords do not Match';} ?></td>
				</tr>

				<tr>
					<td><label for="gender">Gender : </label></td>
					<td><input type="text" id="gender" name="gender" value="<?php if(isset($gender)){ echo $gender; } ?>"></td>
				</tr>

				<tr>
					<td><label for="address">Address : </label></td>
					<td><input type="text" id="address" name="address" value="<?php if(isset($address)){ echo $address; } ?>"></td>
				</tr>

				<tr>
					<td><label for="phone">Phone Number : </label></td>
					<td><input type="text" id="phone" name="phone" value="<?php if(isset($phone)){ echo $phone; } ?>"></td>
				</tr>

				<tr>
					<td><label for="plate">Car Number Plate : </label></td>
					<td><input type="text" id="plate" name="plate" value="<?php if(isset($plate)){ echo $plate; } ?>"></td>
				</tr>
				
				<tr>
					<td></td>
					<td><br><input type="submit" value="Sign Up" class="button"></td>
				</tr>

			</table>
		</form>
	</body>
</html>

