<html>
<head>
<link rel="stylesheet" href="../Admin/adminmain.css"> 
<title>Add Clinic</title>
</head>
<body style="background-image:url(../images/doctordesk.jpg); height: 135%; background-repeat: no-repeat;">
<div class="header">
				<ul>
					<li style="float:left;border-right:none;margin-bottom:5px"><a href="mainpage.php" class="logo"><img src="../images/cal.png" width="30px" height="30px"><strong> Skylabs </strong>Appointment Booking System</a></li>
					<li class="dropdown" style="margin-top:13px">    
              <a href="javascript:void(0)" class="dropbtn">Doctor</a>
              <div class="dropdown-content">
                <a href="adddoctor.php">Add Doctor</a>
                <a href="deletedoctor.php">Delete Doctor</a>
                <a href="showdoctor.php">Show Doctor</a>
              <a href="showdoctorschedule.php">Show Doctor Schedule</a>
              </div>
          </li>
            <li class="dropdown" style="margin-top:13px">
                <a href="javascript:void(0)" class="dropbtn">Clinic</a>
                  <div class="dropdown-content">
                    <a href="addclinic.php">Add Clinic</a>
                    <a href="deleteclinic.php">Delete Clinic</a>
                    <a href="adddoctorclinic.php">Assign Doctor to Clinic</a>
                  <a href="addmanagerclinic.php">Assign Manager to Clinic</a>
                  <a href="deletedoctorclinic.php">Delete Doctor from Clinic</a>
                  <a href="deletemanagerclinic.php">Delete Manager from Clinic</a>
                  <a href="showclinic.php">Show Clinic</a>
                  </div>
          </li>
          <li class="dropdown" style="margin-top:13px">    
                <a href="javascript:void(0)" class="dropbtn">Manager</a>
                  <div class="dropdown-content">
                    <a href="addmanager.php">Add Manager</a>
                    <a href="deletemanager.php">Delete Manager</a>
                  <a href="showmanager.php">Show Manager</a>
                  </div>
          </li>
          <li  style="float:right; border-right:none; margin-top:13px"><a name="logout" href=../index.php>Logout</a></li>
				</ul>
</div>

<div class="container">
<center><h1>ADD CLINIC</h1><hr><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

	<label style="color:black"><b>Name: </b></label><br>
    	<input type="text" placeholder="Enter Clinic Name" name="name" minlength="5" maxlength="45" required><br>
  
	<label style="color:black"><b>Address: </b></label><br>
  		<input type="text" placeholder="Enter Address" name="address" required><br>

	<label style="color:black"><b>Town: </b></label><br>
  		<input type="text" placeholder="Enter Town" name="town" required><br>
		  
	<label style="color:black"><b>City: </b></label><br>
		<select name="city" required>
			<option selected disabled>Choose City</option>
			<option value="Johor">Johor</option>
			<option value="Kedah">Kedah</option>
			<option value="Kelantan">Kelantan</option>
			<option value="Malacca">Malacca</option>
			<option value="Negeri Sembilan">Negeri Sembilan</option>
			<option value="Pahang">Pahang</option>
			<option value="Penang">Penang</option>
			<option value="Perak">Perak</option>
			<option value="Perlis">Perlis</option>
			<option value="Sabah">Sabah</option>
			<option value="Sarawak">Sarawak</option>
			<option value="Selangor">Selangor</option>
			<option value="Terengganu">Terengganu</option>
			<option value="Kuala Lumpur">Kuala Lumpur</option>
			<option value="Labuan">Labuan</option>
			<option value="Putrajaya">Putrajaya</option>
		</select><br>

	<label style="color:black"><b>Contact No: </b></label><br>
		<input type="text" placeholder="Contact Number (e.g. 019*******)" name="contact" minlength="9" maxlength="12" pattern="[0-9]{9,12}" required><br>

  	<button type="submit" name="Submit">REGISTER</button>
</form>
</font></b>
</center>
</div>
<?php
session_start();
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=../index.php"); 
	}
	function newclinic()
	{
		include '../dbconfig.php';
			
			$name=$_POST['name'];
			$town=$_POST['town'];
			$city=$_POST['city'];
			$contact=$_POST['contact'];
			$address=$_POST['address'];
			$sql = "INSERT INTO clinic (Name, Address, Town, City, Contact, mid) VALUES ('$name','$address','$town','$city','$contact','')";
	
		if (mysqli_query($conn, $sql)) 
		{
			echo '<script>alert("Record created successfully!! Refreshing....");
			window.location.href="addclinic.php";</script>';
		} 
		else
		{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	function checkClinicName()
	{
		include '../dbconfig.php';
		$cname=$_POST['name'];
		$sql= "SELECT * FROM clinic WHERE Name = '$name'";
	
		$result=mysqli_query($conn,$sql);
	
			if(mysqli_num_rows($result)!=0)
		   {
			echo '<script>alert("Clinic already exists!")</script>';
		   }
		else 
			if(isset($_POST['Submit']))
		{ 
			newclinic();
		}
	
		
	}
	if(isset($_POST['Submit']))
	{
		if(!empty($_POST['name'])&&!empty($_POST['address'])&&!empty($_POST['town'])&&!empty($_POST['city']) && !empty($_POST['contact'])){
				checkClinicName();
		} else {
			echo '<script>alert("Please fill in all the columns!")</script>';
		}
	}
	
	?>

</body>
</html>
