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
$eventID = $_SESSION['eventID'];
$pid=$_GET['pid'];
$eid=$_GET['eid'];
echo "!!!!!!!!!!!!!!!".$pid;

$queryName = "SELECT first_name FROM person WHERE p_id = $userID";
$result=mysqli_query($conn,$queryName);
$row=mysqli_fetch_assoc($result);

//$line = mysql_fetch_array($result, MYSQL_ASSOC);
echo"Hi! $row[first_name]<br>";
//mysql_free_result($result);
$query="INSERT INTO `invitation`(`p_id`, `e_id`, `time`, `status`) VALUES ('$pid','$eid','NOW()','3')";

$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
echo "person invited successfully!"
// Performing SQL query
//$query = "SELECT start,end,description,location FROM invitation,events";
//$query .= " WHERE p_id =$userID AND status=3 AND events.e_id= invitation.e_id";
//echo "query: $query \n"; //For debugging

?> 

<p><input type="button" value="logout" onClick="window.location.href='logout.html'"> 
</body>
</html>