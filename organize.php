<?php
session_start();
if (!isset($_SESSION['UserID'])) {
	echo"Your session expires!";
	exit;
}
?>

<html>
<body>

<?php
// Connecting, selecting database

// echo 'Connected successfully';
$conn = new mysqli("localhost", "root", "", "databaseproject");


$userID = $_SESSION['UserID'];

$queryName = "SELECT first_name FROM person WHERE p_id = $userID";
$result=mysqli_query($conn,$queryName);
$row=mysqli_fetch_assoc($result);

//$line = mysql_fetch_array($result, MYSQL_ASSOC);
echo"Hi! $row[first_name] , please enter start time(eg 2020-12-18 10:00:00), end time, description, location <br>";

?>
<form action='eventclick.php' method='get'>
	<input type="text"  name="starttime">
	<input type="text"  name="endtime">
	<input type="text"  name="description">
	<input type="text"  name="location">
	<input type="submit" value="Submit">
</form> 

<p><input type="button" value="logout" onClick="window.location.href='logout.html'"> 
</body>
</html>