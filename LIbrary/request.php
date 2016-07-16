<?php
session_start();
if(isset($_SESSION['user'])){

echo
'<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head 
         content must come *after* these tags -->
    
    <title>Request a Book</title>
    
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
					<li class="active"><a href="request.html"><i class="fa fa-book"></i>
							Request a Book</a></li>					
				</ul>
				<form class="form-inline" action="search.php" method="post"> 
					<div class="nav navbar-nav navbar-right">
						<input type="text" class="form-control" name="name" placeholder="Search" required>
						<input type="submit" id="srch" class="btn btn-sm" value="Search">
						<a style="margin-left:30px;" class="btn btn-sm btn-default" href="logout.php" alt="Logout"> 
						<span class="glyphicon glyphicon-log-out"></span></a>
					</div>
				</form>
			</div>

	</nav>
	<div class="container">
     <h2 style="padding-top:90px;">Request Form</h2>';
 if(isset($_POST['request'])){
     require_once 'db_login.php';
     $set = true;
function mysql_fix_string($conn, $string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return $conn->real_escape_string($string);
}
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die($conn->connect_errno);
}
if(isset($_POST['isbn']))
{
  $isbn=mysql_fix_string($conn,$_POST['isbn']);
  $statement2 = "SELECT * from books where isbn='$isbn'";
  $resultset = $conn->query($statement2);
  if($resultset->num_rows>0)
  {
    $set = false;
      echo '<script>
    alert("Your requested book is already in the library catalogue.");
    var myWindow = window.open("request.php", "_self");
    </script>';
  }
  if($set)
  {
    $statement = "SELECT count from requested where isbn='$isbn'";
    $rslt = $conn->query($statement);
    if($rslt->num_rows)
    {
      $rslt->data_seek(0);
      $row = $rslt->fetch_array(MYSQLI_ASSOC);
      $update_count = $row['count'] + 1;
      $stmt2 ="UPDATE `requested` SET `count` = '$update_count' WHERE `requested`.`isbn` = '$isbn'";
      if($conn->query($stmt2)){
        $set = false;
        echo '<script>
      alert("Your request has been recorded.");
      var myWindow = window.open("request.php", "_self");
      </script>';
      } 
    }
  } 
}
// if(isset($_POST['name']))
// {
    // $name=$_POST['name'];
    // $sql = "SELECT * FROM books,domain WHERE name LIKE '%$name%' AND dno=d_number ";
    // $result=$conn->query($sql);
    // $rows=$result->num_rows;
    // for($j=0;$j<$rows;$j++)
    // {
    //     $result->data_seek($j);
    //     $row=$result->fetch_array(MYSQLI_ASSOC);

if($set)
{
    if(isset($_POST['isbn'])&&
    isset($_POST['name']))
  {
    $fname=mysql_fix_string($conn,$_SESSION['user']);
      $email=mysql_fix_string($conn,$_SESSION['email']);
      $name=mysql_fix_string($conn,$_POST['name']);
      $isbn=mysql_fix_string($conn,$_POST['isbn']);
      $query="INSERT into requested(name1,email,name,isbn) VALUES ('$fname','$email','$name','$isbn')";
      if($conn->query($query)){
        echo '<script>
        alert("Your request has been recorded.");
        var myWindow = window.open("request.php", "_self");
        </script>';
      }
      else 
      {
        echo 'Error'. $query . "<br>" . $conn->error;   
      }
  }
}
$conn->close();
}
    echo '<form id="req" method="post" >
     	<div class="col-xs-12 col-sm-5">
	     	
	     	<div class="form-group">
				  	<label class="control-label" for="bookname">Name of the Book*</label>
				  	<input type="text" class="form-control" id="bookname" name="name"  placeholder="ex:Introduction to C programming">
			</div>
			<div class="form-group">
			  	<label class="control-label" for="isbn">ISBN</label>
			  	<input type="text" class="form-control" id="isbn" name="isbn" >
			</div>
			<div class="form-group">
			  	<input type="submit" name="request" class="btn btn-primary" value="Request">
			</div>
		</div>
     </form>
	</div>
</body>
<script src="js/jquery-2.2.0.js" type="text/javascript"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		var Student_validation = $("#req").bootstrapValidator({
			feedbackIcons:{
				valid:"glyphicon glyphicon-ok",
				invalid:"glyphicon glyphicon-remove",
				validating:"glyphicon glyphicon-refresh"
			},
			fields :{
				name :{
					message : "Name of the Book is required.",
					validators :{
						notEmpty:{
							message: "Name of the Book is required."
						}
					}
				},
				isbn:{
					validators:{
						message:"ISBN is incorrect",
						notEmpty:{
							message: "Name of the Book is required."
						},
						isbn :{
							message:"It is not a valid ISBN number."
						}
					}
				}
			}

		}); 
});
</script>
</html>';
}
else if(isset($_SESSION['username']))
{
	header("Location: update_db.php");
}
else{
	echo '<script>
	   alert("You need to login to request a book.");
	   var myWindow = window.open("login.php", "_self");
	   </script>';
	   
}
?>
