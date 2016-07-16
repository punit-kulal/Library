<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head 
         content must come *after* these tags -->
    
    <title>Welcome to Libraray Search</title>
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top nabar-static-top" role="navigation">
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
					<li class="active"><a href="#"><span
							class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
					<?php
					if(!isset($_SESSION['username'])){	
					echo '<li><a href="ad_search.php"><span
							class="fa fa-search" aria-hidden="true"></span>
							Advanced Search</a></li>
					<li class="dropdown"><a href="request.php" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-haspopup="true"
						aria-expanded="false"> <span
							class="fa fa-book" aria-hidden="true"></span>
							Request Books</a>';
					}
					else if(isset($_SESSION['username'])){
						echo '<li><a href="update_db.php"><span
							class="fa fa-refresh" aria-hidden="true"></span>
							Update Database</a></li>
							<li><a href="request_list.php"> <span
							class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
							Requested Books</a></li>';
					}
					if(!isset($_SESSION['user'])&&!isset($_SESSION['username']))
					{
					echo    '<li><a href="login.php"><i class="fa fa-sign-in"></i>
							Login</a></li>
							<li><a href="signup.html"><i class="icon-chevron-sign-up"></i>
							Sign Up</a></li>';
					}
					?>
				</ul>
				<form class="form-inline" action="search.php" method="post"> 
					<div class="nav navbar-nav navbar-right" style="margin-right:-80px;margin-top:-73px">
								<input type="text" class="form-control" name="name" placeholder="Search" required>
								<input type="submit" id="srch" class="btn btn-sm" value="Search">
				<?php
				if(isset($_SESSION['user'])||isset($_SESSION['username'])){
					echo '<a style="margin-left:30px;" class="btn btn-sm btn-default" href="logout.php" alt="Logout"> 
					<span class="glyphicon glyphicon-log-out"></span></a>';
				}
				?>
					</div>
				</form>

			</div>

	</nav>
	<?php
		if(isset($_SESSION['user'])){
		echo '<h4 class="col-sm-3 col-sm-offset-8" style=";margin-top:60px;color:floralwhite;text-align:center;margin-right:30px">Welcome '.$_SESSION['user'].'</h4>';
		}
		if(isset($_SESSION['username'])){
		echo '<h4 class="col-sm-3 col-sm-offset-8" style=";margin-top:60px;color:floralwhite;text-align:center;margin-right:30px">Welcome '.$_SESSION['username'].'</h4>';
		}
		?>
<header class="jumbotron">
	
	<div class="container">
		
		<div class="col-xs-12 col-sm-4">
		<img align="center"  src="img/library.png" alt="library" class="img img-responsive">	
		</div>
		<div class="col-xs-12 col-sm-8">
			<h1>Library Search System</h1></div>
	</div>
</header>
<div class="container">
	<div class="row row-content">
		<p style="padding:20px"></p>
		<div class="col-xs-12 col-sm-3">
			<h2 align="center">Our Collection</h2>
		</div>
		<div class="col-xs-12 col-sm-9">
			<div class="media">
				<div class="media-body">
					<h3 class="media-heading">Over 10,000 books</h3>
					<p>The VESIt library has collection of over 10,books across different streams including computer science,electronics,robotics Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sit amet posuere leo, id vestibulum neque. Sed pharetra est arcu, nec euismod velit scelerisque non. Nullam ullamcorper efficitur fermentum. Aenean in aliquam quam, eget tincidunt enim. Vestibulum efficitur enim leo, vel molestie enim fermentum sit amet. Sed nunc enim, ultricies sed ligula in</p>
				</div>
				<div class="media-left media-middle">
				<img class="row-img media-object img-thumbnail" src="img/collection.png" alt="collection">
				</div>
			</div>
		</div>

	</div>
	<div class="row row-content">
		<br><br><br>
		<div class="col-xs-12 col-sm-3">
			<h2 align="center">Latest Additons</h2>
		</div>
		<div class="col-xs-12 col-sm-2">
			<img src="img/cover1.png" class="row-img img-responsive">
		</div>
		<div class="col-xs-12 col-sm-5">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Sr.</th>
						<th>Computer</th>
						<th>Electronics</th>
						<th>GRE</th>
						<th>Communiction</th>
					</tr>
					<tr>
						<td>1</td>
						<td>something</td>
						<td>cfwec</td>
						<td>wvwr</td>
						<td>wvrevre</td>
					</tr>
					<tr>
						<td>2</td>
						<td>something</td>
						<td>cfwec</td>
						<td>wvwr</td>
						<td>wvrevre</td>
					</tr>
					<tr>
						<td>3</td>
						<td>something</td>
						<td>cfwec</td>
						<td>wvwr</td>
						<td>wvrevre</td>
					</tr>
					<tr>
						<td>4</td>
						<td>something</td>
						<td>cfwec</td>
						<td>wvwr</td>
						<td>wvrevre</td>
					</tr>
					
				</table>
			</div>
		</div>
		<div class="col-xs-12 col-sm-2">
			<img src="img/cover2.png" class="row-img img-responsive">
		</div>
			
	</div>
	<div class="row row-content">
		<div class="panel panel-primary">
			<div class="panel-heading"><h4>Notice</h4>
			</div>
			<div class="panel-body">
			<p>You need to login in to request a book or to issue a book.
			</p>
			</div>
			</div>
	</div>
</div>
<footer class="row-footer">
	<div class="container">
		<div class="col-xs-12 col-sm-4">
			
		</div>
		<div class="col-xs-12 col-sm-7 col-sm-offset-1">
			other contents
			Etiam lorem lacus, mollis condimentum orci ac, commodo posuere odio. Proin lorem est, accumsan non ultrices sed, rutrum porta neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi ut elit aliquam ipsum tempor tincidunt. Curabitur pulvinar eleifend diam, tincidunt lacinia diam commodo eget. Phasellus non consectetur libero. Suspendisse vehicula enim a massa consequat dapibus sed vitae risus. Aenean convallis vel ex eget pharetra. Vivamus et nibh non metus consequat condimentum quis ac tellus. Etiam sollicitudin iaculis dolor at vestibulum. Pellentesque pulvinar varius ex, sed hendrerit quam scelerisque sed. Aenean vulputate porttitor volutpat. Donec tempus, augue quis hendrerit pellentesque, mauris sem consectetur metus, eget egestas eros magna eget velit. Proin finibus turpis sed dignissim tempor. Etiam fringilla ornare nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
		</div>
	</div>
</footer>
</body>
    </html>