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
    
    <title>Advanced Search</title>
    
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
					<li class="active"><a href="#"><span
							class="fa fa-search" aria-hidden="true"></span>
							Advanced Search</a></li>
					<li><a href="request.php"><i class="fa fa-book"></i>
							Request Book</a></li>
					<?php
					if(!isset($_SESSION['user'])){		
					echo '<li><a href="login.php"><i class="fa fa-sign-in"></i>
							Login</a></li>
					<li><a href="signup.html"><i class="icon-chevron-sign-up"></i>
							Sign Up</a></li>';
						}
						?>
				</ul>	
			</div>
			<?php
				if(isset($_SESSION['user'])){
					echo '<div class="nav navbar-nav navbar-right">
						<div style="margin-top:30px">
						<a class="btn btn-sm btn-default" href="logout.php">Logout 
						<span class="glyphicon glyphicon-log-out"></span></a>
						</div>
						</div>';
					}
				?>
	</nav>
	<div class="container">
		
		<form id="search_student" method="POST" action="search.php">
			<div class="col-xs-12 col-sm-5">
			  <div class="form-group">
			  	<label class="control-label" for="bookname">Name of the Book*</label>
			  	<input type="text" class="form-control" id="bookname" name="name"  placeholder="ex:Introduction to C programming">
			  </div>
			  <div class="form-group">
			  	<label for="language" class="control-label">Language</label>
			  	<input type="text" class="form-control" id="language" name="language" placeholder="ex:English">
			  </div>
			  
			 <div class="form-group">
			  	<label class="control-label" for="dor">Publish Date</label>
			  	<input type="date" class="form-control" id="dor" name="dor" placeholder="ex:Introduction to C programming">
			 <div class="form-group">
			  <label for="dno" class="control-label">Domain</label>
			  <select id="dno" class="form-control" name="dno">
			  	<option value="2">Computer Science</option>
			  	<option value="3">Electronics</option>
			  	<option value="4">Telecommunication</option>
			  	<option value="5">English</option>
			  	<option value="7">GRE</option>
			  	<option value="8">GATE</option>
			  	<option value="6">Instrumentation</option>
			  	<option value="1">Other</option>
			  </select>
			  </div>
			  </div>
			</div>
			<div class="col-xs-12 col-sm-5 col-sm-offset-1">
				<div class="form-group">
			  	<label class="control-label" for="isbn">ISBN</label>
			  	<input type="text" class="form-control" id="isbn" name="isbn" placeholder="ex:86841651641">
			  	</div>
			  <div class="form-group">
			  	<label for="author" class="control-label">Author</label>
			  	<input type="text" id="author" class="form-control" name="author" placeholder="Author">
			  </div>
			  <div class="form-group">
			  	<label for="publication" class="control-label">Publication</label>
			  	<input type="text" id="publication" class="form-control" name="publication" placeholder="Publication">
			  </div>
			  </div>
			<div class="col-xs-12">
			 	<div class="form-group">
			  	<input type="submit" class="btn btn-success" id="send" value="Search">
				</div>
			</div>
		</form>
		<div style="margin-top: 80px" class="col-xs-12"><b>Fields with * are mandatory.</b></div>
		</div>
	</div>
</body>
<script src="js/jquery-2.2.0.js" type="text/javascript"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		var Student_validation = $("#search_student").bootstrapValidator({
			feedbackIcons:{
				valid:"glyphicon glyphicon-ok",
				invalid:"glyphicon glyphicon-remove",
				validating:"glyphicon glyphicon-refresh"
			},
			fields:{
				name :{
					message : "Name of the Book is required.",
					validators :{
						notEmpty:{
							message: "Name of the Book is required."
						}
					}
				},
				noc:{
					message:"Number of copies not selected.",
					validators:{
						integer:{
							message:"Number of copies should be an integer."
						}
					}
				},
				dor:{
					message:"Release date not selected.",
					validators:{
						date:{
							message:"Release date not selected."
						}
					}
				},

				isbn:{
					validators:{
						isbn :{
							message:"It is not a valid ISBN number."
						}
					}
				},
				language:{
					message:"incorrect",
				}
			}

		}); 
});
</script>
</html>