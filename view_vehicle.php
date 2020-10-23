<?php
	session_start();
if (!isset($_SESSION['uniqueid']))
{
	echo "Invalid user";
	session_destroy();
	exit;
}

	$host = "localhost";  
    $user = "root";  
    $password = '';  
    $db_name = "parking_lot";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) 
	{  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    } 
	$user_id=mysqli_query($con,"SELECT userid FROM login where username='".$_SESSION['user']."'");
	$row = $user_id -> fetch_array(MYSQLI_ASSOC);
	$var = $row['userid'];
	$sql = "SELECT * FROM add_vehicles where userid='".$var."'";
	$result=mysqli_query($con,$sql);
	$slot_filled=1;
	$sql_slots=mysqli_query($con,"SELECT slots from fix_slots where userid='".$var."'");
	$extract_slots=$sql_slots -> fetch_array(MYSQLI_ASSOC);
	if ($extract_slots==NULL) { echo "No vehicles at the moment"; return;}
	$slots_fixed=$extract_slots['slots'];
	echo "Slots remaining: ";
	echo $slots_fixed-mysqli_num_rows($result)."<br>";

if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {
    echo "Slot number: " .$slot_filled. " License plate: " . $row["license_plate"]. " - Phone: " . $row["phone_number"]. " -Entry time: " .$row['entry_time']. "<br>";
	$slot_filled=$slot_filled+1;
  }
} else {
  echo "No vehicles currently in the parking lot";
}
?>