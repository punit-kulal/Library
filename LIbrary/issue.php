<?php
session_start();
if($_SESSION['user']){
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
if(isset($_POST['issue']))
{
  $user=$_SESSION['user'];
  $issue=mysql_fix_string($conn,$_POST['issue']);
  
  $statement = "SELECT noc from books where isbn = '$issue'";
  $result = $conn->query($statement);
  $result->data_seek(0);
  $row=$result->fetch_array(MYSQLI_ASSOC);
  $statement2 ="UPDATE books SET noc = noc - 1 where isbn = '$issue'";
  if($row['noc']>0&&$result = $conn->query($statement2))
  {
      $stmt="INSERT INTO issue_record VALUES('$user','$issue')";
      if($conn->query($stmt)){    
        echo '<script>
      alert("Your book has been issued.Collect it from the library within 3 days");
      var myWindow = window.open("index.php", "_self");
      </script>'; 
    }
    else{
      echo '<script>
      alert("Issue failed.");
      </script>
      var myWindow = window.open("index.php", "_self")';
  
    }
  }
  else{
    echo '<script>
      alert("Issue failed.");
      </script>';
  }
}
}
?>