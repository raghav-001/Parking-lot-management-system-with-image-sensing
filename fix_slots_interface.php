<?php
session_start();
if (!isset($_SESSION['uniqueid']))
{	echo "Invalid user";  session_destroy();  exit;}
?>
<html>
<head>
  <style>
  .my-error-class
  {
    color:darkred;
    font-size: 14px;
    font-weight: bold;
  }
  .my-valid-class
  {      color:teal;    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script>
  $(document).ready(function()
  {
    $("#slotsset").validate(
      {
        errorClass: "my-error-class",validClass: "my-valid-class",
        rules:
        {
          slots :
          {required: true, digits:true}
        },
        messages:
        {
          slots: {required: "<br>*Enter number of slots", digits:"<br>*Enter valid number"}
        }
      });
    });
  </script>
  <title>Slots-fixing</title>
  <link rel="stylesheet" type="text/css" href="stylesheet_parkingLot.css">
  <style>
  body
  {
background-image: url("https://www.muralswallpaper.co.uk/app/uploads/mint-green-geometric-wallpaper-mural-Room-1024x664.jpg");
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>
</head>
<body>
  <br><br><br>
  <center>
    <form id="slotsset" action="set_slots.php" method="post">
      <table class="design-1">
        <tr>
          <td colspan=2 align=center><h1>Fix the number of slots!</h1></td>
        </tr>
        <tr>
          <td width=40%>We'll keep the vehicles in place for you! Just tell us the amount of space we can allocate for the incoming vehicles.</td>
          <td align=center><input type=text name="slots" id="slots" placeholder="Number of available slots in your parking lot"/></td>
        </tr>
        <tr>
          <td align=center colspan=2><input type="submit" name="submit" value=" Fix the slots " class="button"/></td>      
        </tr>
      </table>
    </form>
  </center>
</body>
</html>
