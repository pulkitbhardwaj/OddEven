<?php

ob_start();

include 'core.inc.php';

$page = $_SERVER['SCRIPT_NAME'];

$_SESSION['target_page'] = $page;

?>

<html>

<head>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/flexbox.css">
  
</head>

<body>

<header class="main-header">
  <ul class="main-nav">
    <li class="main-logo"><h1><a href="index.php"><img alt="Brand" src="images/aakriti.jpg"></a></h1></li>
    <li class="main-search"><form action="index.php" method="get">
      <input type="text" id="src" name="search_src" placeholder="Enter Source">   
      <input type="text" id="dest" name="search_dest" placeholder="Enter Destination">      
      <input type="submit" value="Search" id="search" class="button"> 
    </form></li>
    


<?php
if(!logged_in()){
?>

    <li><a href="index.php" data-icon="&#xe602;">Home</a></li>
    <li><a href="#" data-icon="&#xe601;" data-toggle="modal" data-target="#login">Log In/Sign Up</a></li>

<?php
}

else{
?>

    <li><a href="index.php">Home</a></li>
    <li><a href="commutes.php">My Commutes</a></li>
    <li><a href="logout.php">Log Out</a></li>

<?php
}
?>

  </ul>
</header>


<div id="login" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <label class="modal-title">Log In to Book a Ride</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>

      <form action="login.php" method="post">

      <div class="modal-body" style="width:60%;margin:40px auto;">
        

          <input type="text" placeholder="Email" name="email" id="email" style="width:100%;padding:10px;margin:10px 0px;">
          <input type="password" placeholder="Password" name="password" style="width:100%;padding:10px;margin:10px 0px;"> 

        
      </div>

      <div class="modal-footer">
        <input type="submit" value="Log In" class="button" style="margin:4px;display:inline-block;">
        <a href="register.php" class="button btn btn-block">Register</a>
      </div>

      </form>

    </div>
  </div>  
</div>



</body>

</html>