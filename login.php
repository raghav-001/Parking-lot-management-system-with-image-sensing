<html>

<head>

<script>

				function closepop()

				{

					document.getElementById("pop").style.display="none";

					window.location.href="login_parkinglot.html";

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
					font-weight: bold;
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

    $host = "localhost";

    $user = "root";

    $password = '';

    $db_name = "parking_lot";



    $con = mysqli_connect($host, $user, $password, $db_name);

    if(mysqli_connect_errno())

	{

        die("Failed to connect with MySQL: ". mysqli_connect_error());

    }

		$username = $_POST['user'];

    $password = $_POST['pass'];



        $username = mysqli_real_escape_string($con, $username);

        $password = mysqli_real_escape_string($con, $password);



        $sql = "select *from login where username = '$username' and password = '$password'";

        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);

				$randomid=rand(1000,10000);



        if($count == 1)

		{

					$_SESSION['uniqueid']=$username."-".$randomid."-".date("l");

					$_SESSION['user']=$username;

					echo "<script>window.open('main_interface.php','_self')</script>";

        }

        else

		{

				 	$res= "Invalid login";

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
