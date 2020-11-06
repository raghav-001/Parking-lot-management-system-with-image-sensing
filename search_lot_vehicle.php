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
            width: 90%;
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
<?php	session_start();
    if (!isset($_SESSION['uniqueid']))
    {		echo "Invalid user";		session_destroy();		exit;	}
    if(isset($_POST["submit"]))
    {
      $host = "localhost";
      $user = "root";
      $password = '';
      $db_name = "parking_lot";
      $con = mysqli_connect($host, $user, $password, $db_name);
      if(mysqli_connect_errno())
      {        die("Failed to connect with MySQL: ". mysqli_connect_error());    }
      $user_id=mysqli_query($con,"SELECT userid FROM login where username='".$_SESSION['user']."'");
      $row = $user_id -> fetch_array(MYSQLI_ASSOC);	$var = $row['userid'];
      $search_required=$_POST['search'];
      $sql = "SELECT * FROM add_vehicles where userid='".$var."' and license_plate='".$search_required."'";
      $result=mysqli_query($con,$sql);
      if ($result-> num_rows > 0)
      {
        while($row = $result->fetch_assoc())
        {
          $res= " Slot number:  " .$row['slot_number']. "  License plate:  " . $row["license_plate"]. "  - Phone:  " . $row["phone_number"]. "  -Entry time:  " .$row['entry_time'];
        }
      }
      else
      {
        if ($search_required==NULL)
        $res= " All fields required! ";
        else $res= " Entered vehicle not available in the parking lot ";
      }
    }
    ?>
    <center>
    <div id="fade" class="blackcard" style="display:block"></div>
      <div class="whitecard" id="pop" style="display:block">
      <center>
          <br><br>		<?php echo $res; ?>		<br><br>
          <button class="btn" type="button" id="b" onclick="closepop()">Close</button>
          <br><br>
        </center>
</div>
</center>
</body>
</html>
