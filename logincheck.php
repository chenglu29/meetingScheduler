<?php


session_start();
$loginUserID=$_POST["loginUserID"];
$loginPassword=$_POST["loginPassword"];

echo $loginUserID;
echo $loginPassword;


// Authenticate the user
//if (authenticateUser($connection, $loginUserID, $loginPassword))
//{
  // Register the loginUserID
  $_SESSION['UserID'] = $loginUserID;

  // Create connection
$conn = new mysqli("localhost", "root", "", "databaseproject");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$sql="select * from person where p_id=".$loginUserID." and password=".$loginPassword;
$result=$conn->query($sql);
if($result->num_rows>0){
  echo "login successful";
  header("Location: home.php");
}
else{
  echo "login failed, wrong id/password";
}


?>
