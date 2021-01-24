<html>
<head>
	<link rel="stylesheet" href="../main.css">
	<title>Home</title>
</head>
<body style ="background-image:url(http://www.dreamtemplate.com/dreamcodes/bg_images/color/c4.jpg);">
<div class="header">
				<ul>
				<li style="float:left;border-right:none"><a href="ulogin.php" class="logo"><img src="../images/cal.png" width="30px" height="30px"><strong> Skylabs </strong>Appointment Booking System</a></li>
					
					<li><a name ="logout" type="submit" href=../index.php>Logout</a></li>
					
					<li><a href="viewpatientappointments.php">Show/Cancel Appointment</a></li>
					<li><a href="book.php">Book Now</a></li>
					<li><a href="ulogin.php">Home</a></li>
				</ul>
</div>
<div class="container" >
	<div class="sucontainer" style="background-color:white; border: 2px solid black; border-radius: 5px; padding: 12px 20px; left:25%; right:25%;">
	<center>
	<h2>Welcome <?php session_start(); echo $_SESSION['username']; ?></h2><br>
	<p> Book an appointment with your doctor and cancel anytime you want before the date! </p><br>
	<p>Click the button below to see our locations!</p>
	<button type="button" onclick="window.location.href='ulocateus.php'" style="background-color:#2B4F76">Locate Us</button>
	<!--<form method="post">
      <button type="button" onclick="window.location.href='book.php'" style="background-color:#2B4F76">Book Appointment</button>
	  <button type="button" onclick="window.location.href='viewpatientappointments.php'" style="background-color:#2B4F76">Show Appointments</button>
	  <button type="submit" name="cancel" style="float:center;background-color:#2B4F76">Cancel Booking</button>
	  <button type="submit" name="logout" style="float:right;background-color:#2B4F76">Log Out</button>
	</form> -->
	<center>
    </div>
</div>
<?php
if(isset($_POST['check']))
{
		include 'dbconfig.php';
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
if(isset($_POST['cancel']))
{
	header( "Refresh:1; url=cancelbookingpatient.php"); 
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