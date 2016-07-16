<?php
session_start();
if ($_SESSION['username'] == 'Punit'){
	header("Location: update_db.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head 
         content must come *after* these tags -->
    
    <title>Login</title>
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <script src="js/jquery-2.2.0.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrapValidator.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="img/logo.png"
					height=30 width=41></a>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php"><span
							class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
					<li><a href="ad_search.php"><span
							class="fa fa-search" aria-hidden="true"></span>
							Advanced Search</a></li>
					<li><a href="request.php"> <span
							class="fa fa-book" aria-hidden="true"></span>
							Request a Book</a>
					<li class="active"><a href="#"><i class="fa fa-sign-in"></i>
							Login</a></li>
					<li ><a href="signup.html"><i class="icon-chevron-sign-up"></i>
							Sign Up</a></li>

				</ul>
			</div>
	</nav>
	<div class="container">
<?php
$error=''; // Variable To Store Error Message
require 'db_login.php';
function mysql_fix_string($conn, $string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return $conn->real_escape_string($string);
}
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) 
{
    die($conn->connect_errno);
}
if (isset($_POST['submit'])) 
{
	if (empty($_POST['username']) || empty($_POST['password'])) 
	{
	$error = "Username or Password is invalid";
	}
	else
	{
      // Define $username and $password
      $username=mysql_fix_string($conn,$_POST['username']);
      $password=mysql_fix_string($conn,$_POST['password']);
      // Establishing Connection with Server by passing server_name, user_id and password as a parameter
      // To protect MySQL injection for Security purpose

      // Selecting Database
      // SQL query to fetch information of registerd users and finds user match.
      $query = "SELECT * from users where password='$password' AND username='$username'";
      $result = $conn->query($query);
      $rows = $result->num_rows;
      if ($rows == 1) 
      {
      	$result->data_seek(0);
      	$row=$result->fetch_array(MYSQLI_ASSOC);
         $_SESSION['user']=$username;
         $_SESSION['email']=$row['email']; // Initializing Session
         header("location: index.php"); // Redirecting To Other Page
      } 
      else 
      {
         $error = "Username or Password is invalid";
      }
      $conn->close();// Closing Connection
    }			
	if ($_POST['username'] == 'punitk' && 
	   $_POST['password'] == 'mywp') 
	{
	   $_SESSION['valid'] = true;
	   $_SESSION['timeout'] = time();
	   $_SESSION['username'] = 'Punit';
	   
	   header("location: update_db.php");
	}
	  
}

?>
		
		<form id="Login" method="POST" >
			<div class="col-xs-6">
				<div class="form-group">
					<label for="username">Username
					</label>
					<input type="text" class="form-control" id="username" required name="username" minlength="4" maxlength="10">
				</div>
				<div class="form-group">
					<label for="password">Password
					</label>
					<input type="password" class="form-control" id="password" required name="password" minlength="4">
				</div>
				<div class=""form-control>
						<input type="submit" class="btn btn-sm btn-success" name="submit" value="Login">
				</div>
			</div>
		</form>
		
	</div>
</body>

</html>