<html>
<head>
  <script>
  function closepop()
  {
    document.getElementById("pop").style.display="none";
    window.location.href="signup_parkinglot.html";
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
    height: min-content;
    background-color: rgba(209, 245, 255, 0.67);
    font-weight: bold;
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
        if(isset($_POST["submit"]))
          {
            if(!empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['address']) && !empty($_POST['contact']) && !empty($_POST['email']) && !empty($_POST['lot_name']))
            {
              $user=$_POST['user'];
              $pass=$_POST['pass'];
              $address=$_POST['address'];
              $contact=$_POST['contact'];
              $email=$_POST['email'];
              $lot_name=$_POST['lot_name'];
              $con=mysqli_connect('localhost','root','') or die(mysqli_error());
              mysqli_select_db($con,'parking_lot') or die("cannot select DB");
              $query=mysqli_query($con,"SELECT * FROM login WHERE username='".$user."'");
              $numrows=mysqli_num_rows($query);
              if($numrows==0)
              {
                $sql="INSERT INTO login(username,password,address,contact,email,lot_name) VALUES('$user','$pass','$address','$contact','$email','$lot_name')";
                $result=mysqli_query($con,$sql);
                if($result)
                {
                  $res= "Account Successfully Created";
                }
                else
                {
                  $res= "Failure!";
                }
              }
              else
              {
                $res= "That username already exists! Please try again with another.";
              }
            }
          }
          ?>
          <center>
            <div id="fade" class="blackcard" style="display:block"></div>
            <div class="whitecard" id="pop" style="display:block">
              <center>
                <br><br>
                <?php echo $res; ?>
                <br><br>
                <button class="btn" type="button" id="b" onclick="closepop()">Close</button>
                <br><br>
              </center>
            </div>
          </center>
</body>
        </html>
