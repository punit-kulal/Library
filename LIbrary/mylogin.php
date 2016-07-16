
 <?php
session_start(); // Starting Session
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
      $query = "SELECT * from user where password='$password' AND username='$username'";
      $result = $conn->query($query);
      $rows = $result->num_rows;
      if ($rows == 1) 
      {
         $_SESSION['user']=$username; // Initializing Session
         header("location: library_index.html"); // Redirecting To Other Page
      } 
      else 
      {
         $error = "Username or Password is invalid";
      }
      $conn->close();// Closing Connection
   }
}				
if ($_POST['username'] == 'punitk' && 
   $_POST['password'] == 'mywp') 
{
   $_SESSION['valid'] = true;
   $_SESSION['timeout'] = time();
   $_SESSION['username'] = 'Punit';
   
   header("location: update_db.php");
}
else 
{
   echo '<script>
   alert("Login unsuccessful.");
   var myWindow = window.open("login.php", "_self");
   </script>';
}
?>