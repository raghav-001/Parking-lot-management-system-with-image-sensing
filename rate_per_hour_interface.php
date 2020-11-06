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
  {
    color:teal;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function()
      {  $("#rate").validate({
        errorClass: "my-error-class",validClass: "my-valid-class",
        rules:
        {
          amount :
          {required: true, digits:true}
        },
        messages:
        {
          amount:
          {required: "<br>*Enter amount in Rs", digits:"<br>*Enter valid number"}
        }
      });
    });
  </script>
  <title>Fix the rate</title>
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
<br><br><br>  <center>
  <form id="rate" action="rate_fix.php" method="post">
  <table class="design-1">
    <tr>
      <td colspan=2 align=center><h1>Set the cost of parking per hour.</h1></td>
    </tr>
    <tr>
      <td width=40%>Enter the parking charge per hour
      </td>
      <td align=center><input type=text name="amount" id="amount" placeholder="Enter the amount"></td>
    </tr>
    <tr>
      <td colspan=2 align=center><input type="submit" name="submit" value="Set amount" class="button"/></td>
    </tr>
  </table>
 </form>
 </center>
</body>
 </html>
