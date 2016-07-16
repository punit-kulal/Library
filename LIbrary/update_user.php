<?php
require_once 'db_login.php';
function mysql_fix_string($conn, $string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return $conn->real_escape_string($string);
}
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die($conn->connect_errno);
}
if(isset($_POST['username'])&&isset($_POST['password']))
{
	$username=mysql_fix_string($conn,$_POST['username']);
	$password=mysql_fix_string($conn,$_POST['password']);
	$email=mysql_fix_string($conn,$_POST['email']);
	$stmt="SELECT username from users WHERE username ='$username'";
	$result = $conn->query($stmt);
	if($result->num_rows<=0)
	{
		$query="INSERT into users VALUES ('$username','$password','$email')";
		if($conn->query($query))
		{
		   echo '<script>
		   alert("Sign up successful.");
		   var myWindow = window.open("login.php", "_self");
		   </script>';
		}
		else{
			echo '<script>
		   alert("Sign up unsuccessful.");
		   var myWindow = window.open("signup.html", "_self");
		   </script>';
		}
	}
	else
	{
		echo '<script>
		   alert("Username already taken.Please try a different username.");
		   var myWindow = window.open("signup.html", "_self");
		   </script>';
	}
}
$conn->close();
?>