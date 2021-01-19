<!DOCTYPE html>
<html>
<body style="background-color:white">
<link rel="stylesheet" href="main.css">
			<div class="header">
				<ul>
					<li style="float:left;border-right:none"><a href="index.php" class="logo"><img src="images/cal.png" width="30px" height="30px"><strong> Skylabs </strong>Appointment Booking System</a></li>
					<li><a href="locateus.php">Locate Us</a></li>
					<li><a onclick="document.getElementById('id01').style.display='block'">Login</a></li>
				</ul>
			</div>
			<div style="margin-top:10%;text-align:center" class="center">
				<img style="width:400px;height:230px" src="images/skylabs.png">
				<p>Book Your Clinic Appointment Now!</p>
			</div>	

<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post" action="index.php">
    <div class="imgcontainer">
		<span><h2 style ="text-align:center">Log In</h2></span>
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
	
    <div class="container">
      <input type="text" placeholder="Enter Username" name="uname" required>
      <input type="password" placeholder="Enter Password" name="psw" required>
	  <text>Role : </text>
	  <select style ="margin-top:10px;height:30px" name="role" id="role">
			<option value="1">Patient</option>
			<option value="2">Manager</option>
			<option value="3">Admin</option>
	  </select>

		<div style ="text-align: center;margin-top:15px">
			<button style="background-color: #4CAF50;width:100%;border-radius: 2px" type="submit" name="login">Login</button>
			Not registered? <a style="color:blue;font-size:17px" onclick="document.getElementById('id02').style.display='block';document.getElementById('id01').style.display='none'">Create an account</a>
		</div>
    </div> 
  </form>
</div>

<div id="id02" class="modal">
  
  <form class="modal-content animate" action="signup.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span><br>
    </div>

	<div class="imgcontainer">
      <img src="images/steps.png" alt="Avatar" class="avatar">
    </div>
	
    <div class="container">
		<p style="text-align:center;font-size:18px;"><b>Sign Up -> Choose your Dates -> Book your visit</b></p>
      	<p style="text-align:center"><b>Booking an appointment has never been easier!</b></p>
      	<p style="text-align:center"><b>The 3 steps for an easier and healthy life</b></p>
	  	<button style="background-color: #4CAF50;width:100%;border-radius: 2px" type="submit" name="signup">Sign Up</button>
    </div>
  </form>
</div>


<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}

</script>
<?php
	session_start();
	if (isset($_POST['login'])) {
	if (empty($_POST['uname']) || empty($_POST['psw'])) {
		echo '<script>alert("Please enter all fields to login!")</script>';
	}
	else{
		include 'dbconfig.php';
		$username=$_POST['uname'];
		$password=$_POST['psw'];
		$role = $_POST['role'];
		$hash = password_hash($password,PASSWORD_DEFAULT); 

		$query = mysqli_query($conn,"SELECT * from user WHERE username='$username' AND role='$role'");
		$rows = mysqli_fetch_assoc($query);
		$num=mysqli_num_rows($query);
		if (($num == 1) && password_verify($password, $rows['password'])) {
			$_SESSION['username']=$rows['username'];
			if($role == 1){
				header( "Refresh:1; url=patient/ulogin.php"); 
			}
			elseif($role == 2){		
				$_SESSION['mgrid']=1;
				header( "Refresh:1; url=manager/mgrmenu.php"); 
			}
			else{
				header( "Refresh:1; url=admin/mainpage.php"); 
			}
		} 
		else{
			echo '<script>alert("Please enter a valid credentials to login!")</script>';
		}
		mysqli_close($conn); 
	}}
?>
</body>
</html>