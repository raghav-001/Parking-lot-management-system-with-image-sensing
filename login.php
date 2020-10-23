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
            echo "<h1><center> Login successful </center></h1>"; 
			echo "<script>window.open('main_interface.php','_self')</script>";
        }  
        else
		{  
           
			echo "<script>alert('Invalid login')</script>";
			echo "<script>window.open('login_parkinglot.html','_self')</script>";
			
        }     
?>