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
    overflow: hidden;	margin:10%;	padding:10%; font-family: Georgia, serif;
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
  <?php
  session_start();
  if (!isset($_SESSION['uniqueid']))
  {	$res= "Invalid user";	session_destroy();	exit;}
  if(isset($_POST["submit"]))
  {
    if(!empty($_POST['amount']))
    {
      $amount=$_POST['amount'];
      $con=mysqli_connect('localhost','root','') or die(mysqli_error());
      mysqli_select_db($con,'parking_lot') or die("cannot select DB");
      $user_id=mysqli_query($con,"SELECT userid FROM login WHERE username='".$_SESSION['user']."'");
      $row = $user_id -> fetch_array(MYSQLI_ASSOC);
      $x=$row ['userid'];
      $rate_check=mysqli_query($con,"SELECT * from rate_per_hour where userid='".$x."'");
      $numrows=mysqli_num_rows($rate_check);
      if($numrows==0)
      {
        $sql="INSERT INTO rate_per_hour(userid,amount) VALUES('$x','$amount')";
        $result=mysqli_query($con,$sql);
        if($result)
        {
          $res=  "Rate successfully added";
        }
        else
        {
          $res=  "Failure!";
        }
      }
      else
      {
        $update_rate=mysqli_query($con,"DELETE FROM rate_per_hour where userid='".$x."'");
        $sql="INSERT INTO rate_per_hour(userid,amount) VALUES('$x','$amount')";
        $result=mysqli_query($con,$sql);
        if($result)
        {
          $res=  "Rate successfully updated!";
        }
        else
        {				$res=  "Failure!";			}
}
    }
    else
    {		$res= "All fields are required!";	}
  }
?>
  <center>
    <div id="fade" class="blackcard" style="display:block"></div>
    <div class="whitecard" id="pop" style="display:block">
      <center>
        <br><br>
        <?php echo $res; ?>
        <br><br>
        <button class="btn" type="button" id="b" onclick="closepop()">Close</button><br><br>
      </center></div>
    </center>
  </body>
  </html>
