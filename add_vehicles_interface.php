<?php
session_start();
if (!isset($_SESSION['uniqueid']))
{	echo "Invalid user";	session_destroy();	exit;}
?>
<html>
<head>
  <style>
  body
  {
    background-image: url("https://cdn4.vectorstock.com/i/1000x1000/13/38/geometric-blue-green-texture-background-vector-21931338.jpg");
    background-repeat: no-repeat;
    background-size: cover;
  }
  .my-error-class
  {
    color:darkred;
    font-size: 14px;
    font-weight: bold;
  }
  .my-valid-class
  {    color:teal;  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src='https://unpkg.com/tesseract.js@v2.0.2/dist/tesseract.min.js'></script>
<script>
function read_text()
{
  var fullPath = document.getElementById('myfile').value;
  if (fullPath)
  {
    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    var filename = fullPath.substring(startIndex);		if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0)
    {
      filename = filename.substring(1);
    }
  }
  Tesseract.recognize(filename,'eng',{ logger: m => console.log(m) }).then(({ data: { text } }) =>
  {		console.log(text);document.getElementById("license").value=text;	}) }
  $(document).ready(function()
  {
    jQuery.validator.addMethod("alphanumeric", function(value, element)
    {
      return this.optional(element) || /^[\w. ]+$/i.test(value);
});
  $("#adding").validate(
    {
    errorClass: "my-error-class",validClass: "my-valid-class",
    rules:
    {
      license :{required: true, alphanumeric:true},
      phone: { required: true, digits:true, minlength: 10, maxlength:10 }
    },
    messages:
    {
      license: {
        required: "<br>*Please provide license plate no",
        alphanumeric: "<br>*Enter valid license plate number"
      },
      phone:
      {
        required:"<br>*Please enter the owner's contact no.",
        digits:"<br>*Enter valid number ",
        minlength:"<br>*Contact no must be 10 digits",
        maxlength: "<br>*Contact no must be 10 digits"
      }
    }
  });
});
</script>
<title>Add vehicles</title>
<link rel="stylesheet" type="text/css" href="stylesheet_parkingLot.css">
</head><body>
  <br><br><br><center>
    <form id="adding" action="vehicle_adding.php" method="post">
      <table class="design">
        <tr>
          <td colspan=3 align=center><h1>Add vehicles to the lot</h1></td>
        </tr>
        <tr>
          <td width=30%>Enter the vehicle's license plate number</td>
          <td align=center>
            <input type=text name="license" id="license" placeholder="License plate"/>
          </td>        <td><input type="file" id="myfile" onchange="read_text()"></td>
        </tr>
        <tr>
          <td>Enter the phone number of driver/owner<br>(for emergency purposes)</td>
          <td align=center ><input type=text name="phone" id="phone" placeholder="Phone number"/></td>
<td></td>
        </tr>
        <tr>
          <td colspan=3 align=center><input type="submit" name="submit" id="submit" value="Add vehicle" class="button">
        </td>
      </tr>
    </table>
  </form>
</center>
</body>
</html>
