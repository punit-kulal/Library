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
if(isset($_POST['name'])&&
    isset($_POST['isbn'])&&
    isset($_POST['dor'])&&
    isset($_POST['language'])&&
    isset($_POST['publication'])&&
    isset($_POST['dno'])&&
    isset($_POST['noc'])&&
    isset($_POST['author'])&&isset($_FILES['bimg']['name']))
{
    
    $iname=$_FILES['bimg']['name'];
    $tmp_name=$_FILES['bimg']['tmp_name'];
    $target_file='uploads/'.$iname;
    $name=mysql_fix_string($conn,$_POST['name']);
    $isbn=mysql_fix_string($conn,$_POST['isbn']);
    $dor=mysql_fix_string($conn,$_POST['dor']);
    $language=mysql_fix_string($conn,$_POST['language']);
    $publication=mysql_fix_string($conn,$_POST['publication']);
    $dno=mysql_fix_string($conn,$_POST['dno']);
    $noc=mysql_fix_string($conn,$_POST['noc']);
    $author=mysql_fix_string($conn,$_POST['author']);
    $query="INSERT into books VALUES ('$name','$isbn','$dor','$language','$publication','$dno','$noc','$author','$target_file')";
    if (move_uploaded_file($_FILES['bimg']['tmp_name'], $target_file)) {
        if($conn->query($query))
        {
      echo '<script>
      alert("Books has been successfully updated.");
      var myWindow = window.open("update_db.php", "_self");
      </script>';
        }
    else 
        {
      echo 'Error'. $query . "<br>" . $conn->error;   
        }
    } 
    else {
        echo "Sorry, there was an error uploading your file.";
    }
}   

$conn->close();
?>


    
