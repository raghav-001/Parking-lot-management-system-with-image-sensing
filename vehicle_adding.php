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
    width: 90%;
    font-weight: bold;
    height: min-content;
    border-radius: 10px;
    background-color: rgba(209, 245, 255, 0.67);
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
  <?php
  session_start();
  if (!isset($_SESSION['uniqueid']))
  {
    echo "Invalid user";
    session_destroy();
    exit;
  }
  if(isset($_POST["submit"]))
  {
    if(!empty($_POST['license']) && !empty($_POST['phone']))
    {
      date_default_timezone_set("Asia/Kolkata");
      $license_plate=$_POST['license'];
      $phone_number=$_POST['phone'];
      $entry_hour=+date("H")*60+(+date("i"));
    	$entrytime=substr(date("H:i:sa"),0,-2);
      $con=mysqli_connect('localhost','root','') or die(mysqli_error());
      mysqli_select_db($con,'parking_lot') or die("cannot select DB");
      $query=mysqli_query($con,"SELECT * FROM add_vehicles WHERE license_plate='".$license_plate."'");
      $numrows=mysqli_num_rows($query);
      $user_id=mysqli_query($con,"SELECT userid FROM login WHERE username='".$_SESSION['user']."'");
      $row = $user_id -> fetch_array(MYSQLI_ASSOC);
      $x=$row ['userid'];
      $slot_fill_check_query=mysqli_query($con,"SELECT * FROM fix_slots where userid='".$x."'");
      $slot_fill_column= $slot_fill_check_query -> fetch_array(MYSQLI_ASSOC);
      $check_slot_entered=mysqli_num_rows($slot_fill_check_query);
      if ($check_slot_entered==0){ $res= "Please fill the number of slots"; goto end; }
      $available_slots=$slot_fill_column['slots'];
      $vehicle_count_query=mysqli_query($con,"SELECT * from add_vehicles where userid='".$x."'");
      $vehicle_count=mysqli_num_rows($vehicle_count_query);
      $slot_number=$vehicle_count+1;
      if ($vehicle_count<$available_slots)
      {
        if($numrows==0)
        {
          $sql="INSERT INTO add_vehicles(userid,slot_number,license_plate,phone_number,entry_time) VALUES('$x','$slot_number','$license_plate','$phone_number','$entrytime')";
          $result=mysqli_query($con,$sql);
          if($result)
          {
            $res= "Vehicle successfully added";
          }
          else
          {
            $res= "Failure!";
          }
        }
        else
        {
          $res= "That vehicle already exists in the parking lot!";
        }
      }
      else
      {
        $res= "Slots full! Vehicle cannot be added! Increase the slots to add more ";
      }
    }
  }
  end:
  ?>
  <center>
    <div id="fade" class="blackcard" style="display:block"></div>
    <div class="whitecard" id="pop" style="display:block">
      <center>
        <br><br>		  <?php echo $res; ?>			<br><br>
        <button class="btn" type="button" id="b" onclick="closepop()">Close</button>
        <br><br>
      </center>
    </div>
</center>
</body>
</html>
