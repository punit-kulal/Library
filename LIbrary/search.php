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
    
    <title>Display</title>
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
    form {
        position: relative;
        margin-top: -80px;
    }
    </style>
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
                    <li ><a href="index.php"><span
                            class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
                    <li><a href="ad_search.php"><span
                            class="fa fa fa-search" aria-hidden="true"></span>
                           Advanced Search</a></li>
                    <li class="dropdown"><a href="request.php" class="dropdown-toggle"
                        data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"> <span
                            class="fa fa-book" aria-hidden="true"></span>
                            Request Book</a>
                    <li class="active"><a href="#"><i class="glyphicon glyphicon-th-list"></i>
                            Display</a></li>
                    <?php
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
                    <div class="nav navbar-nav navbar-right">
                                <input type="text" class="form-control" name="name"  required placeholder="Search">
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
    <div class="container" style="margin-top:100px">
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
if(isset($_POST['name'])&&
    isset($_POST['isbn'])&&
    isset($_POST['dor'])&&
    isset($_POST['language'])&&
    isset($_POST['publication'])&&
    isset($_POST['dno'])&&
    isset($_POST['author']))
{
    echo '<h3>You Searched For : '.$_POST['name'].'</h3>';
    $name=mysql_fix_string($conn,$_POST['name']);
    $isbn=mysql_fix_string($conn,$_POST['isbn']);
    $dor=mysql_fix_string($conn,$_POST['dor']);
    $language=mysql_fix_string($conn,$_POST['language']);
    $publication=mysql_fix_string($conn,$_POST['publication']);
    $dno=mysql_fix_string($conn,$_POST['dno']);
    $author=mysql_fix_string($conn,$_POST['author']);
    $query="SELECT * from books,domain WHERE UPPER(name) LIKE UPPER('%$name%') AND isbn LIKE '%$isbn%' AND dor LIKE '%$dor%' AND UPPER(language) LIKE UPPER('%$language%') AND UPPER(publication) LIKE UPPER('%$publication%') AND dno LIKE '%$dno%' AND UPPER(author) LIKE UPPER('%$author%') AND  dno=d_number";
    $result = $conn->query($query);
    if ($result->num_rows > 0)
    {
        $rows=$result->num_rows;
        for($j=0;$j<$rows;$j++)
        {
            $result->data_seek($j);
            $row=$result->fetch_array(MYSQLI_ASSOC);
        echo'<div class="media">
              <div class="media-left media-middle">
                <a href="#">
                  <img style="height:140px;" class="media-object" src="'.$row["img"].'" alt="project_logo">
                </a>
              </div>
              <div class="media-body" style="padding-top:10px">
                <h2 class="media-heading">'.$row["name"].'</h2>
                <div class="col-xs-4 col-sm-3">
              <p class="myfont"><b>Domain:</b>
            ';
            echo $row["domain_name"];
            echo '<br> 
                 <b>Language:</b>';
                 echo $row["language"];
                 echo '<br>
                    <b>Date of Publishing: </b>';
                echo $row["dor"]; 
                echo '<b>ISBN: </b>'.$row['isbn'].'</div>
                <div class="col-xs-4 col-sm-3 col-sm-offset-2">';
                echo ' <b>Number of copies : </b>'.$row["noc"].
                '<br>
                    <b>By-</b>'.$row["author"].'</p>';
                if(isset($_SESSION['user']))
                {
                echo '
                    <form method="POST" action="issue.php">
                    <input type="hidden" name="issue" value="'.$row['isbn'].'">
                    <button type="submit" class="btn btn-success">Issue</button>
                    </form>'; 
                }
                    
                echo    '</div>
              </div>          
            </div> ';
        }
    }
    else
    {
    echo '<h4>0 results</h4>
    <a class="btn btn-sm btn-primary" href="request.html">Request a book</a>';
    }
}
else if(!empty($_POST['name']))
{
    echo '<h3>You Searched For : '.$_POST['name'].'</h3>';
    $name=$_POST['name'];
    $sql = "SELECT * FROM books,domain WHERE UPPER(name) LIKE UPPER('%$name%') AND dno=d_number ";
    $result=$conn->query($sql);
    if ($result->num_rows > 0)
    {
        $rows=$result->num_rows;
        $rows=$result->num_rows;
        for($j=0;$j<$rows;$j++)
        {
            $result->data_seek($j);
            $row=$result->fetch_array(MYSQLI_ASSOC);
        echo'<div class="media">
              <div class="media-left media-middle">
                <a href="#">
                  <img style="height:140px;" class="media-object" src="'.$row["img"].'" alt="project_logo">
                </a>
              </div>
              <div class="media-body" style="padding-top:10px;al">
                <h2 class="media-heading">'.$row["name"].'</h2>
                <div class="col-xs-4 col-sm-3">
              <p class="myfont"><b>Domain:</b>
            ';
            echo $row["domain_name"];
            echo '<br> 
                 <b>Language:</b>';
                 echo $row["language"];
                 echo '<br>
                    <b>Date of Publishing: </b>';
                echo $row["dor"]; 
                echo '<br><b>ISBN: </b>'.$row['isbn'].'</div>
                <div class="col-xs-4 col-sm-3 col-sm-offset-2">';
                echo ' <b>Number of copies : </b>'.$row["noc"].
                '<br>
                    <b>By-</b>'.$row["author"].'</p>';
                if(isset($_SESSION['user']))
                {
                echo '
                    <form method="POST" action="issue.php">
                    <input type="hidden" name="issue" value="'.$row['isbn'].'">
                    <button type="submit" class="btn btn-success">Issue</button>
                    </form>'; 
                }
                    
                echo    '</div>
              </div>          
            </div> '
        ;    
        }
    }
    else 
    {
        echo '<h4>0 results</h4>
        <a class="btn btn-sm btn-primary" href="request.php">Request a book</a>';
    }
}
else 
{
    echo '<h4>0 results</h4>
    <a class="btn btn-sm btn-primary" href="request.html">Request a book</a>';
}
$conn->close();
?>
</div>
        </body>
    </html>   