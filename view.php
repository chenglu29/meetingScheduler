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

$queryName = "SELECT first_name FROM person WHERE p_id = $userID";
$result=mysqli_query($conn,$queryName);
$row=mysqli_fetch_assoc($result);

//$line = mysql_fetch_array($result, MYSQL_ASSOC);
echo"Hi! $row[first_name]";
//mysql_free_result($result);

// Performing SQL query
$query = "SELECT start,end,description,location FROM invitation,events";
$query .= " WHERE p_id =$userID AND status=1 AND events.e_id= invitation.e_id";
//echo "query: $query \n"; //For debugging

$result2 = mysqli_query($conn,$query);
//$row2=mysqli_fetch_assoc($result2); 
if($result2->num_rows>0){
	echo "\nMy accept inviations: ";
	echo"</br>";
	echo "start time,end time,description,location</br>";
	while($row2=$result2->fetch_assoc()){
		echo $row2["start"]."  ".$row2["end"]."   ".$row2["description"]."    ".$row2["location"]."</br>";
	}
}

/*if ($row2){
	// Printing pending inviations in HTML
	echo "\nMy pending inviations: ";
	echo"</br>";
	echo "start time,end time,description,location";
	print_r($row2);
}*/
else{
	echo"</br>";
	echo "No pending inviation!";
}
// Free resultset
//mysql_free_result($result);

// Closing connection
//mysql_close($connection);
?> 

<p><input type="button" value="logout" onClick="window.location.href='logout.html'"> 
</form>
</body>
</html>