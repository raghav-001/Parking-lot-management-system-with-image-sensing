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
  padding:5%;
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
<?php
  session_start();
  if (!isset($_SESSION['uniqueid']))
  {	echo "Invalid user";	session_destroy();	exit;}

    $con=mysqli_connect('localhost','root','') or die(mysqli_error());
    mysqli_select_db($con,'parking_lot') or die("cannot select DB");
    $user_id=mysqli_query($con,"SELECT * FROM login WHERE username='".$_SESSION['user']."'");
    $row = $user_id -> fetch_array(MYSQLI_ASSOC);
    $res= "Name:   ".$row['username']." <br> "."Address: ".$row['address']." <br> "."Email: ".$row['email']." <br> "."Contact: ".$row['contact']." <br> "."Lot name: ".$row['lot_name']." <br> ";
  
  ?>
<center>
  <div id="fade" class="blackcard" style="display:block">
  </div>
  <div class="whitecard" id="pop" style="display:block">
<center>
<br><br>
  <?php echo $res; ?>
<br><br>
  <button class="btn" type="button" id="b" onclick="closepop()">Back to interface</button>
<br><br>
</center>
</div>
</center>
</body>
</html>
