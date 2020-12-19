<?php
session_start();
if (!isset($_SESSION['UserID'])) {
	echo"Your session expires!";
	exit;
}
?>

<html>
<body>
<h1>
Homepage
</h1>
<form >
<?php
// Connecting, selecting database

// echo 'Connected successfully';
$conn = new mysqli("localhost", "root", "", "databaseproject");


$userID = $_SESSION['UserID'];
$eventID=$_SESSION['eventID'];

$queryName = "SELECT first_name FROM person WHERE p_id = $userID";
$result=mysqli_query($conn,$queryName);
$row=mysqli_fetch_assoc($result);

//$line = mysql_fetch_array($result, MYSQL_ASSOC);
echo"Hi! $row[first_name]";
//mysql_free_result($result);

// Performing SQL query
//$query = "SELECT start,end,description,location FROM invitation,events";
//$query .= " WHERE p_id =$userID AND status=3 AND events.e_id= invitation.e_id";
//echo "query: $query \n"; //For debugging
$query="UPDATE `invitation` SET `status` = '1' WHERE `invitation`.`p_id` = $userID AND `invitation`.`e_id` = $eventID ";
//$result2 = mysqli_query($conn,$query);
//$row2=mysqli_fetch_assoc($result2); 
if(mysqli_query($conn,$query)){
	echo "accept successfully";
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
	echo "Error updating record";
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