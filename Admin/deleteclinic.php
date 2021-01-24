<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../Admin/adminmain.css"> 
<title>Delete Clinic</title>
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
<h1>
<div class="container">
<center><h1>DELETE CLINIC</h1><hr><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

Select Name:<br><?php
				require_once('../dbconfig.php');
				$clinic_result = $conn->query('select * from clinic order by City,Town,CID ASC');
				?>
				<center>
				<select name="clinicname">
				<option value="">---Select Name---</option>
				<?php
				if ($clinic_result->num_rows > 0) {
				while($row = $clinic_result->fetch_assoc()) {
				?>
				<option value="<?php echo $row["cid"]; ?>"><?php echo $row["name"].", ".$row["town"].", ".$row["city"].",(".$row["address"].")"."(cid=".$row["cid"].")"; ?></option>
				<?php
					}
					}
				?>
				</select></center>
				
				<button type="submit" name="Submit2">Delete by Name</button>
</form>	
</div>		
<?php

include '../dbconfig.php';

if(isset($_POST['Submit2']))
{
	$cid=$_POST['clinicname'];
	$sql = "DELETE FROM clinic WHERE cid = $cid ";

	if (mysqli_query($conn, $sql))
		{
			echo '<script>alert("Record deleted successfully.Refreshing....");
			window.location.href="deleteclinic.php";</script>';
		}
	else
		{
			echo '<script>alert("Error deleting record!")</script>';
		}

}	
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=/index.php"); 
	}
?>			
</body>
</html>