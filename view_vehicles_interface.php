<html>
<head>
  <script>
  function closepop()
  {
    document.getElementById("pop").style.display="none";
    window.location.href="main_interface.php";
  }
</script>
  <link rel="stylesheet" type="text/css" href="stylesheet_parkingLot.css">
  <style>
  .popup
  {
    background:url("bg.png");
    overflow: hidden;
    margin:10%;
    padding:8%;
    font-family: Georgia, serif;
  }
  .whitecard
  {
    display: none;
    position: sticky;
    align: center;
    width: 100%;
    font-size: 20px;
    font-weight: bold;
    height: min-content;
    border-radius: 10px;
    background-color: rgba(209, 245, 255, 0.67);
    color:black;
    z-index: 1002;
  }
  .blackcard
  {
    display: none;
    position:absolute;
    top:0%; left:0%;
    width: 100%;
    height: 200%;
    background-color: black;
    overflow: auto;
    z-index: 1;
    opacity: 0.5;
    }
  </style>
</head>
<body class="popup">
  <?php	session_start();
  if (!isset($_SESSION['uniqueid']))
  {	$rese= "Invalid user";	session_destroy();	exit;}
  $host = "localhost";
  $user = "root";    $password = '';    $db_name = "parking_lot";		$res1=" ";		$rese=" ";
  $res=array();
  $con = mysqli_connect($host, $user, $password, $db_name);
  if(mysqli_connect_errno())
  {
    die("Failed to connect with MySQL: ". mysqli_connect_error());
  }
  $user_id=mysqli_query($con,"SELECT userid FROM login where username='".$_SESSION['user']."'");
  $row = $user_id -> fetch_array(MYSQLI_ASSOC);	$var = $row['userid'];
  $sql = "SELECT * FROM add_vehicles where userid='".$var."'";
  $result=mysqli_query($con,$sql);	$slot_filled=1;
  $sql_slots=mysqli_query($con,"SELECT slots from fix_slots where userid='".$var."'");
  $extract_slots=$sql_slots -> fetch_array(MYSQLI_ASSOC);
  if ($extract_slots==NULL) { $rese= "No vehicles at the moment"; goto end;}
  $slots_fixed=$extract_slots['slots'];	$sl=$slots_fixed-mysqli_num_rows($result);
  $res1= "Slots remaining:	 ".$sl."<br>";
  $i=0;
  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
      $res[$i++]= "Slot number: " .$slot_filled. " License plate: " . $row["license_plate"]. " - Phone: " . $row["phone_number"]. " -Entry time: " .$row['entry_time']. "<br>";
      $slot_filled=$slot_filled+1;
    }
  }
  else
  {  	$rese= "No vehicles currently in the parking lot";	}
  end:
  ?>
  <center>
    <div id="fade" class="blackcard" style="display:block"></div>
    <div class="whitecard" id="pop" style="display:block">
      <center>
        <br><br>
        <?php
        echo $res1;echo $rese;
        foreach( $res as $value )
        echo $value;
        ?>
        <br><br>
        <button class="btn" type="button" id="b" onclick="closepop()">Back to interface</button>
        <br><br>
      </center>
    </div>
  </center>
</body>
</html>
