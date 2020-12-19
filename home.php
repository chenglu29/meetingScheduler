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

$queryName = "SELECT first_name FROM person WHERE p_id = $userID";
$result=mysqli_query($conn,$queryName);
$row=mysqli_fetch_assoc($result);

//$line = mysql_fetch_array($result, MYSQL_ASSOC);
echo"Hi! $row[first_name]";
//mysql_free_result($result);

// Performing SQL query
$query = "SELECT start,end,description,location FROM invitation,events";
$query .= " WHERE p_id =$userID AND status=3 AND events.e_id= invitation.e_id";
//echo "query: $query \n"; //For debugging

$result2 = mysqli_query($conn,$query);
//$row2=mysqli_fetch_assoc($result2); 
if($result2->num_rows>0){
	echo "\nMy pending inviations: ";
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
<p align="left">
<table>
 <style>   
  input.a1   {   width:200; height:30;  text-align:   center;   }   
  input.a2   {   width:200; height:30;  text-align:   center;   }   
  input.a3   {   width:200; height:30;  text-align:   center;   }   
  input.a4   {   width:200; height:30;  text-align:   center;   }   
  input.a5   {   width:200; height:30;  text-align:   center;   }
  input.a6   {   width:200; height:30;  text-align:   center;   }   
  input.a7   {   width:200; height:30;  text-align:   center;   }   
  input.a8   {   width:200; height:30;  text-align:   center;   }  
  </style>   
  <p><input   class="a1"   type="button"   value="View schedule" onClick=
 "window.location.href='view.php'">
  <p><input   class="a2"   type="button"   value="Answer Invitations" onClick=
 "window.location.href='answer.php'">  
  <p><input   class="a3"   type="button"   value="Organize a Event" onClick=
 "window.location.href='organize.php'">   
  <p><input   class="a4"   type="button"   value="Issue Invitation" onClick=
 "window.location.href='issueInvitation.php'">    
 
</table>
<p><input type="button" value="logout" onClick="window.location.href='logout.php'"> 
</form>
</body>
</html>