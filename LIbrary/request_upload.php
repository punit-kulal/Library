<?php
session_start();
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
?>