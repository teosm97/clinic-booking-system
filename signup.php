<html>
<head>
	<link rel="stylesheet" href="main.css">
</head>
<body style="background-image:url(images/signup.jpg); height: 180%; background-repeat: no-repeat;">
<div class="header">
				<ul>
					<li style="float:left;border-right:none"><a href="index.php" class="logo"><img src="images/cal.png" width="30px" height="30px"><strong> Skylabs </strong>Appointment Booking System</a></li>
					<li><a href="locateus.php">Locate Us</a></li>
					<li><a href="index.php">Home</a></li>
				</ul>
</div>
<form action="signup.php" method="post">
	<div class="sucontainer" style="background-color:white; border: 2px solid black; border-radius: 5px; padding: 12px 20px; left:25%; right:25%;">
		<h2 style="text-align: center">Sign Up Form</h2>
		<hr><br>

		<label style="color:black"><b>Name:</b></label><br>
		<input type="text" placeholder="Enter Full Name" name="fname" minlength="10" maxlength="45" pattern="[A-Za-z\s]{10,45}" required><br><br>

		<label style="color:black"><b>Date of Birth:</b></label><br>
		<input type="date" name="dob" required><br><br>
	
		<label style="color:black"><b>Gender:</b></label><br>
		<input type="radio" name="gender" value="male">Male
		<input type="radio" name="gender" value="female">Female
		<br><br>
		
		<label style="color:black"><b>Contact No:</b></label><br>
		<input type="text" placeholder="Contact Number (e.g. 019*******)" name="contact" minlength="9" maxlength="12" pattern="[0-9]{9,12}" required><br><br>
		
		<label style="color:black"><b>Username:</b></label><br>
		<input type="text" placeholder="Create Username" name="username" minlength="4" maxlength="10" required><br><br>
		
		<label style="color:black"><b>Email:</b></label><br>
		<input type="email" placeholder="Enter Email" name="email" required><br><br>

		<label style="color:black"><b>Password:</b></label><br>
		<input type="password" placeholder="Enter Password" name="pwd" id="p1" minlength="4" maxlength="12" required><br><br>

		<label style="color:black"><b>Repeat Password:</b></label><br>
		<input type="password" placeholder="Repeat Password" name="pwdr" id="p2" required><br>
		<p style="color:black">* By creating an account, you agree to our <a href="#" style="color:blue">Terms & Conditions</a>.</p><br>

		<div class="container" style="background-color:white">
			<button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn"><a href="index.php">Cancel</a></button>
			<button type="submit" name="signup" style="float:right">Sign Up</button>
		</div>
  </div>
<?php

function newUser()
{
		include 'dbconfig.php';
		$name=$_POST['fname'];
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$contact=$_POST['contact'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$password=$_POST['pwd'];
		$prepeat=$_POST['pwdr'];
		$hash = password_hash($password,PASSWORD_DEFAULT); 
		$sql = "INSERT INTO patient (Name, Gender, DOB,Contact,Email,Username,Password) VALUES ('$name','$gender','$dob','$contact','$email','$username','$hash'); INSERT INTO user (Username, Password, Role) VALUES ('$username','$hash',1)";

	if (mysqli_multi_query($conn, $sql)) 
	{
		echo '<script>alert("Record created successfully!! Redirecting to login page....");
		window.location.href="index.php";</script>';
	} 
	else
	{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
function checkusername()
{
	include 'dbconfig.php';
	$username=$_POST['username'];
	$sql= "SELECT * FROM patient WHERE username = '$username'";

	$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)!=0)
		{
			echo '<script>alert("Username already exists!")</script>';
		}
		else if($_POST['pwd']!=$_POST['pwdr'])
		{
			echo '<script>alert("Passwords dont match!")</script>';
		}
		else if(isset($_POST['signup']))
		{ 
			newUser();
		}

	
}
if(isset($_POST['signup']))
{
	if(!empty($_POST['username']) && !empty($_POST['pwd']) &&!empty($_POST['fname']) &&!empty($_POST['dob'])&& !empty($_POST['gender']) &&!empty($_POST['email']) && !empty($_POST['contact']))
			checkusername();
}
?>

</form>
</body>
</html>