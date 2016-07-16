<?php
   session_start();
	if ($_SESSION['username'] == 'Punit')
	{	
		require_once "db_login.php";
		function mysql_fix_string($conn, $string)
	{
	if (get_magic_quotes_gpc()) $string = stripslashes($string);
	return $conn->real_escape_string($string);
	}
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) {
    die($conn->connect_errno);
}
		
		if(isset($_POST['req'])){
			$req_isbn= mysql_fix_string($conn,$_POST['req_del']);
			$stmt2="DELETE FROM requested WHERE isbn = '$req_isbn'";
			if($conn->query($stmt2)){
				header("Location: request_list.php");
			}
		}
	echo 
	'<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head 
         content must come *after* these tags -->
    
    <title>Update Books</title>
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <script src="js/jquery-2.2.0.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrapValidator.min.js"></script>
	<style>
	form {
		margin-top:-83px;
	}
	</style>
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
					<li><a href="update_db.php"><span
							class="fa fa-refresh" aria-hidden="true"></span>
							Update Database</a></li>
					<li class="active"><a href="request_list.php"> <span
							class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
							Requested Books</a></li>

				</ul>				
			</div>
			<div class="nav navbar-nav navbar-right">
				<div style="margin-top:29px;margin-right:13px">
				<a class="btn btn-sm btn-default" href="logout.php">Logout <span class="glyphicon glyphicon-log-out"></span></a>
				</div>
			</div>
			
	</nav>
	<div class="container" style="margin-top:70px;">
		<table class="table table-hover">
 			<tr><th>No.</th><th>Name</th><th>Email</th><th>Name of the Book</th><th>ISBN</th><th>Requested by</th><th>Delete</th></tr>';


$query = "SELECT * from requested ORDER BY count DESC";
$result = $conn->query($query);
$rows= $result->num_rows;
    for($j=0;$j<$rows;$j++)
    {
    	$k = $j +1;
        $result->data_seek($j);
        $row=$result->fetch_array(MYSQLI_ASSOC);
echo '<tr><td>'.$k.'</td><td>'.$row['name1'].'</td><td>'.$row['email'].'</td><td>'.$row['name'].'</td><td>'.$row['isbn'].'</td><td>'.$row['count'].' visitors</td><td><form method="post">
	<input type="hidden" name="req_del" value="'.$row['isbn'].'">
	<button type="submit" class="btn btn-xs btn-danger" name="req"><span class="glyphicon glyphicon-remove"></span></button>
	</form></td></tr>';
	}
echo '
		</table>
	</div>
</body>
</html>'
;
	}
	else{
	echo 'Session expired';
	header("Location: login.php");
	}
