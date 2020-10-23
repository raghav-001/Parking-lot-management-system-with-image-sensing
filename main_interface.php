<?phpsession_start();if (!isset($_SESSION['uniqueid'])){	echo "Invalid user";	session_destroy();	exit;}?><html>
<head>
  <title>Main interface</title>
  <style>
  .interfaceTable
  {
    width:85%;
    height:85%;
  }
  .txt
  {
    font-size: 19px;
    text-align: left;
    vertical-align: middle;
    padding-left: 10px;
    font-weight: 400;
    font: georgia;
    font-family: monospace;
    color: black;
  }
  .navbar
  {
    top:0px;
    height:115px !important;
  }
  .navbar-nav > li > a {padding-top:10px !important; padding-bottom:15px !important; height:40px;}
  .navbar:not(.navbar_collapse)
  {
      background:#000014!important;
      color:snow;	  
  }
  .navbutton:hover
  {
    color:#000!important;background-color:#f2f3f4!important;
  }
  button
  {
    width:100%; height:100%;
    color:snow;
    background-color: #000014;
    font-size: 18px;
  }
  .col-45 {
    width: 25%;
    font-size: 18px;
  }

  .col-55 {
    width: 55%;
  }
  .mainbg
  {
        background-image: url("https://cdn1.vectorstock.com/i/1000x1000/75/00/blue-mosaic-glass-wallpaper-vector-21617500.jpg");
        background-repeat: no-repeat;
        background-size: cover;
  }
  </style>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="stylesheet_parkingLot.css">
</head>
<body class="mainbg">

  <section>
      <nav>
      <div class="navbar bar">
          <div class="h_padding bar" id="navbarTogglerDemo02">
            <h3>Welcome back <?php echo $_SESSION['user']; ?>!</h3>
            <form action="logout.php" method="post"><input type="submit" name="submit" class="bar-item  navbutton" value="LOGOUT"/> </form>
            <form action="view_profile.php" method="post"><input type="submit" name="submit" class="bar-item  navbutton" value="VIEW PROFILE"/></form>			
          </div>
      </div>
     </nav>
  </section>
  <center>
    <br><br>
  <table class="interfaceTable">
    <tr>
      <td class="col-45 txt" align=center><a href="search_vehicle_interface.php"><button>Search for vehicle</button></a></td>
      <td class="col-55 txt" align=center><b>Search for any vehicle in the parking lot to contact the driver in case of any emergency
        /to just view the slot number of the parked vehicle</b></td>
    </tr>
    <tr>
      <td class="col-45 txt" align=center><a href="fix_slots_interface.php"><button>Fix number of slots</button></a></td>
      <td class="col-55 txt" align=center><b>Set the number of slots available in your parking lot</b></td>
    </tr>
    <tr>
      <td class="col-45 txt" align=center><a href="view_vehicles_interface.php"><button>View vehicles in the lot</button></a></td>
      <td class="col-55 txt" align=center><b>Click here to view the vehicles parked in your parking lot</b></td>
    </tr>
    <tr>
      <td class="col-45 txt" align=center><a href="add_vehicles_interface.php"><button>Add a vehicle</button></a></td>
      <td class="col-55 txt" align=center><b>Add vehicles to your parking lot if there are enough available slots</b></td>
    </tr>
    <tr>
      <td class="col-45 txt" align=center><a href="generate_bill_interface.php"><button>Generate bill</button></a></td>
      <td class="col-55 txt" align=center><b>Generate the bill for parking once the vehicle leaves the lot</b></td>
    </tr>
    <tr>
      <td class="col-45 txt" align=center><a href="rate_per_hour_interface.php"><button>Rate per hour</button></a></td>
      <td class="col-55 txt" align=center><b>Set and modify the rate you charge per hour of parking of the vehicle</b></td>
    </tr>
  </table>
</center>
<br><br>
</body>
</html>
