<html>
<head>
	<link rel="stylesheet" href="../main.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Balsamiq+Sans:wght@700&display=swap" rel="stylesheet">
</head>
<body style="background-image:url(../images/mgrchange.jpg)">
<div class="header">
				<ul>
					<li style="float:left;border-right:none"><a class="logo"><img src="../images/cal.png" width="30px" height="30px"><strong> Skylabs </strong>Appointment Booking System</a></li>
					<form method="post">	
					<button type="submit" name="logout" style="float:right;"><b>Log Out</b></button>
					</form>
				</ul>
</div>

	<h1 class="titlefont">Welcome, <?php session_start(); echo $_SESSION['username']; ?></h1>
	<div class="container2">   
       <div class="manager-container">
        <img src="../images/change.png" alt="" />
        <br>
        <a href="changebookingstatus.php">Change Booking Status</a>
      </div>    
    </div>
<?php
if(isset($_POST['check']))
{
		include '../dbconfig.php';
		$name=$_SESSION['user'];
		$sql = "Select * from book where name='$name'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($rows = mysqli_fetch_assoc($result)) 
			{
				echo "Username:".$rows["username"]."Name:".$rows["name"]."Date of Visit:".$rows["dov"]."Town:".$rows["town"]."<br>";
			}
		} 
		else 
		{
			echo "0 results";
		}
}
if(isset($_POST['logout']))
{
	session_unset();
	session_destroy();
	header( "Refresh:1; url=../index.php"); 
}
?>
</body>
</html>