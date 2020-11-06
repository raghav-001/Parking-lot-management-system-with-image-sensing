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
    padding:10%;
    font-family: Georgia, serif;
  }
  .whitecard
  {
    display: none;
    position: sticky;
    align: center;
    width: 80%;
    font-size: 20px;
    font-weight: bold;
    height: min-content;
    background-color: rgba(209, 245, 255, 0.67);
    border-radius: 10px;
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
$res1=" "; $res2=" ";
if(isset($_POST["submit"]))
  {
    if(!empty($_POST['leaving']))
    {
      $leaving=$_POST['leaving'];
      $con=mysqli_connect('localhost','root','') or die(mysqli_error());
      mysqli_select_db($con,'parking_lot') or die("cannot select DB");
      $user_id=mysqli_query($con,"SELECT userid FROM login WHERE username='".$_SESSION['user']."'");
      $row = $user_id -> fetch_array(MYSQLI_ASSOC);		$x=$row['userid'];
      $vehicle_select=mysqli_query($con,"SELECT * from add_vehicles where userid='".$x."' and license_plate='".$leaving."'");
      $data_check=mysqli_num_rows($vehicle_select);
      if ($data_check==0)
      $res= "Entered vehicle not parked in the lot!";
      else
      {
        $chosen_vehicle=$vehicle_select -> fetch_array(MYSQLI_ASSOC);
        $rate_select=mysqli_query($con,"SELECT * FROM rate_per_hour where userid='".$x."'");
        $rate_count=mysqli_num_rows($rate_select);		if ($rate_count==0) $res= "Set rate first!";
        else
        {
          $rate_column=$rate_select -> fetch_array(MYSQLI_ASSOC);
          $rate=$rate_column['amount'];		date_default_timezone_set("Asia/Kolkata");
          $numrows=mysqli_num_rows($vehicle_select);
          if ($numrows==1)
          {
            $entry_time_sql=mysqli_query($con,"SELECT entry_time from add_vehicles where license_plate='".$leaving."' and userid='".$x."'");
            $entry_time_row_extract=$entry_time_sql -> fetch_array(MYSQLI_ASSOC);
            $entry_time=$entry_time_row_extract['entry_time'];
            $diff=round((strtotime(substr(date("H:i:sa"),0,-2)) - strtotime($entry_time))/3600, 0);
            if ($diff>1)
                  $res= "The bill for the vehicle is Rs. ". $rate*$diff;
            else
                  $res= "The bill for the vehicle is Rs.".$rate;
            $res1= "<br>"."Entry time: ".$entry_time."<br>"."Exit time: ".substr(date("H:i:sa"),0,-2)."<br>";
            $delete_vehicle=mysqli_query($con,"DELETE from add_vehicles where license_plate='".$leaving."' and userid='".$x."'");
            if ($delete_vehicle)
            {
                $res2= "<br>"."Vehicle ".$leaving." removed from parking lot"."<br>";
            }
          }
          else
          {
            $res= "Vehicle doesn't exist";
          }
        }
      }
    }
  }
?>
<center>
<div id="fade" class="blackcard" style="display:block"></div>
    <div class="whitecard" id="pop" style="display:block">
      <center>
        <br><br>
        <?php echo $res; echo $res1; echo $res2; ?>
        <br><br>
        <button class="btn" type="button" id="b" onclick="closepop()">Back to interface</button>
        <br><br>
      </center>
    </div>
</center>
</body>
</html>
