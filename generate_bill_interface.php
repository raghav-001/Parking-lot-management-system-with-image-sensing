<?php
session_start();
if (!isset($_SESSION['uniqueid']))
{	echo "Invalid user";  session_destroy();  exit;}
?>
<html>
<style>
.my-error-class
{
  color:darkred;
  font-size: 14px;
  font-weight: bold;
}
.my-valid-class
{  color:teal;}
input{width:70%}
</style>
<script src='https://unpkg.com/tesseract.js@v2.0.2/dist/tesseract.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
function read_text()
{
  var fullPath = document.getElementById('myfile').value;
  if (fullPath)
  {
    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') :
    fullPath.lastIndexOf('/'));
    var filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0)
    {
      filename = filename.substring(1);
    }
  }
  Tesseract.recognize	(filename,'eng',{ logger: m => console.log(m) }).then(({ data: { text } }) =>
  {		console.log(text);document.getElementById("leaving").value=text;
  })
  }
  $(document).ready(function()
  {
      jQuery.validator.addMethod("alphanumeric", function(value, element)
      {  return this.optional(element) || /^[\w. ]+$/i.test(value);  });
      $("#generate").validate(
        {
          errorClass: "my-error-class",validClass: "my-valid-class",
          rules:
          {
            leaving :
            {required: true, alphanumeric:true}
            },
            messages:
            {
              leaving:
              {
                required: "<br>*Please provide license plate no",
                alphanumeric: "<br>*enter valid license plate number"
              }
            }
        });
});
    </script>
  <head>
    <title>Generate bill</title><head>
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
      <form id="generate" action="bill_generate.php" method="post">
        <table class="design-1">
          <tr>
            <td align=center colspan=2><h1>Generate bill as a vehicle leaves the lot</h1></td>
          </tr>
          <tr>
            <td width=40%>Enter the license plate of the leaving vehicle</td>
            <td align=center> <input type=text name="leaving" id="leaving" placeholder="Vehicle's license plate"/><br>
            <input type="file" id="myfile" onchange="read_text()"></td>
          </tr>
          <tr>
            <td colspan=2 align=center><input type="submit" name="submit" id="submit" value="Generate bill" class="button"></td>
</tr>
      </table>
    </form>
  </center>
</body>
</html>
