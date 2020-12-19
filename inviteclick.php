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
$eid=$_GET['eid'];
echo "!!!!!!!!!!!!!!!".$eid;

$queryName = "SELECT first_name FROM person WHERE p_id = $userID";
$result=mysqli_query($conn,$queryName);
$row=mysqli_fetch_assoc($result);

//$line = mysql_fetch_array($result, MYSQL_ASSOC);
echo"Hi! $row[first_name]<br>";
//mysql_free_result($result);

// Performing SQL query
//$query = "SELECT start,end,description,location FROM invitation,events";
//$query .= " WHERE p_id =$userID AND status=3 AND events.e_id= invitation.e_id";
//echo "query: $query \n"; //For debugging
$query="select * from events where organizer=$userID and e_id=$eid";
//$result2 = mysqli_query($conn,$query);
//$row2=mysqli_fetch_assoc($result2); 

$result2=$conn->query($query);
$row2=$result2->fetch_assoc();
echo $row2["e_id"]."    ".$row2["start"]."  ".$row2["end"]."   ".$row2["description"]."    ".$row2["location"]."</br>";
$query3 = "SELECT p_id, first_name FROM person WHERE p_id != $userID";
$result3=$conn->query($query3);
while($row3=$result3->fetch_assoc()){
	echo $row3["p_id"]."  ".$row3["first_name"]."</br>";
	?>
	<form action="inviteclick2.php" method="get">
			<input name="pid" type="hidden" value="<?php echo $row3["p_id"] ?>">
			<input name="eid" type="hidden" value="<?php echo $eid ?>">
			<input type="submit" name="button2" value="inveite person <?php echo $row3["p_id"] ?>">
		</form>
	<?php
}

/*if ($row2){
	// Printing pending inviations in HTML
	echo "\nMy pending inviations: ";
	echo"</br>";
	echo "start time,end time,description,location";
	print_r($row2);
}*/

// Free resultset
//mysql_free_result($result);

// Closing connection
//mysql_close($connection);
?> 

<p><input type="button" value="logout" onClick="window.location.href='logout.html'"> 
</body>
</html>