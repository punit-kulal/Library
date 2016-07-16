<?php
   session_start();
	if ($_SESSION['username'] == 'Punit')
	{
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
							class="fa fa-refresh" aria-hidden="true"></span>
							Update Database</a></li>
					<li><a href="request_list.php"> <span
							class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
							Requested Books</a></li>
				</ul>				
			</div>
			<div class="nav navbar-nav navbar-right">
				<div style="margin-top:29px">
				<a class="btn btn-sm btn-default" href="logout.php">Logout <span class="glyphicon glyphicon-log-out"></span></a>
				</div>
			</div>
			
	</nav>
	<div class="container">
		
		
			<form id="updb" method="POST" action="update_books.php" enctype="multipart/form-data">
			<div class="col-xs-12 col-sm-5">
			  <div class="form-group">
			  	<label class="control-label" for="bookname">Name of the Book*</label>
			  	<input type="text" class="form-control" id="bookname" name="name" required placeholder="ex:Introduction to C programming">
			  </div>
			  <div class="form-group">
			  	<label for="language" class="control-label">Language</label>
			  	<input type="text" class="form-control" id="language" name="language" placeholder="ex:English" required>
			  </div>
			 <div class="form-group">
			  	<label class="control-label" for="dor">Publish Date</label>
			  	<input type="date" class="form-control" id="dor" name="dor" placeholder="ex:Introduction to C programming" required>
			  </div>
			  <div class="form-group">
			  	<label class="control-label" for="noc">Number of copies</label>
			  	<input type="number" class="form-control" id="noc" name="noc" required>
			  </div>
			  <div class="form-group">
			  	<label class="control-label" for="bimg">Image of the book</label>
			  	<input type="file" class="form-control" id="bimg" name="bimg" required>
			  </div>
			 
			</div>
			<div class="col-xs-12 col-sm-5 col-sm-offset-1">
				<div class="form-group">
			  	<label class="control-label" for="isbn">ISBN</label>
			  	<input type="text" class="form-control" id="isbn" name="isbn" placeholder="ex:86841651641" required>
			  	</div>
			  <div class="form-group">
			  	<label for="author" class="control-label">Author</label>
			  	<input type="text" id="author" class="form-control" name="author" placeholder="Default:Anonymous" required>
			  </div>
			  <div class="form-group">
			  	<label for="publication" class="control-label">Publication</label>
			  	<input type="text" id="publication" class="form-control" name="publication" placeholder="Publication" required>
			  </div>
			  <div class="form-group">
			  <label for="domain" class="control-label">Domain</label>
			  <select id="domain" class="form-control" name="dno">
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
			<div class="col-xs-12">
			 	<div class="form-group">
			  	<button type="submit" class="btn btn-success" id="send">Update</button>
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
<script>
$(document).ready(function(){
		var Student_validation = $("#updb").bootstrapValidator({
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
				language:{
					message:"Incorrect language selected",
					notEmpty:{
						message:"Please enter language."
					}
				},
				publication:{
					message:"Publication not selected.",
					notEmpty:{
						message:"Publication not selected."
					}
				},
				noc:{
					message:"Number of copies not selected.",
					notEmpty:{
						message:"Release date not selected."
					},
					integer:{
						message:"Number of copies should be an integer."
					}
				},
				dor:{
					message:"Release date not selected.",
					notEmpty:{
						message:"Release date not selected."
					},
					date:{
						message:"Release date not selected."
					}
				},

				isbn:{
					validators:{
						isbn :{
							message:"It is not a valid ISBN number."
						}
					}
				},
				bimg: {
            		validators: {
                		file: {
		                    extension: "jpeg,jpg,png",
		                    type: "image/jpeg,image/png",
		                    message: "Please choose a proper image file."
                }
            }
        }
			}

		}); 
});
</script>
</html>'
;
	}
	else{
	echo 'Session expired';
	header("Location: login.php");
	}
	
