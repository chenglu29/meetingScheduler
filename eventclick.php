<?php
session_start();
if (!isset($_SESSION['UserID'])) {
	echo"Your session expires!";
	exit;
}
?>

<html>
<body>

<form >
<?php
// Connecting, selecting database

// echo 'Connected successfully';
$conn = new mysqli("localhost", "root", "", "databaseproject");


$userID = $_SESSION['UserID'];
//$eventID=$_SESSION['eventID'];

$queryName = "SELECT first_name FROM person WHERE p_id = $userID";
$result=mysqli_query($conn,$queryName);
$row=mysqli_fetch_assoc($result);

//$line = mysql_fetch_array($result, MYSQL_ASSOC);
echo"Hi! $row[first_name]";
//mysql_free_result($result);

$starttime=$_GET['starttime'];
//echo $starttime;
$endtime=$_GET['endtime'];
$description=$_GET['description'];
$location=$_GET['location'];

$query="INSERT INTO `events`( `start`, `end`, `description`, `location`, `organizer`, `organizedtime`) VALUES ('$starttime','$endtime','$description','$location','$userID',NOW())";

$result2=mysqli_query($conn,$query);
//echo $query;
echo "insert event successfully";

?> 

<p><input type="button" value="logout" onClick="window.location.href='logout.html'"> 
</form>
</body>
</html>