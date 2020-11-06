<?php
session_start();
if (!isset($_SESSION['uniqueid']))
{	echo "Invalid user";	session_destroy();	exit;}
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
  {    color:teal;  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function()
{
  jQuery.validator.addMethod("alphanumeric", function(value, element)
  {    return this.optional(element) || /^[\w. ]+$/i.test(value);    });
  $("#searchform").validate(
    {
          errorClass: "my-error-class",validClass: "my-valid-class",
          rules:
          {
            search :      {required: true, alphanumeric:true}
          },
          messages:
          {
            search:
            {required: "<br>*Please provide license plate no", alphanumeric:"<br>*Enter valid licence plate no."}
          }
        });
    });
  </script>
  <title>Search for a vehicle</title>
  <link rel="stylesheet" type="text/css" href="stylesheet_parkingLot.css">
  <style>
  body
  {
    background-image: url("https://cdn4.vectorstock.com/i/1000x1000/13/38/geometric-blue-green-texture-background-vector-21931338.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    }
  </style>
</head>
<body>
  <br>
  <br>
  <br>
  <center>
    <form id="searchform" action="search_lot_vehicle.php" method="post">
      <table class="design">
        <tr>
          <td colspan=2 align=center><h1>Search for a vehicle in the lot!<h1></td>
        </tr>
        <tr>
           <td width=40%>Enter the license plate of the vehicle to search</td>
            <td align=center><input type=text name="search" id="search" placeholder="Enter the license plate number here"/></td>
        </tr>
        <tr>
          <td align=center colspan=2><input type="submit" name="submit" value="Search" class="button"></td>
        </tr>
      </table>
    </form>
    <center>
    </body>
    </html>
