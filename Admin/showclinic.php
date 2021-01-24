<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../Admin/adminmain.css"> 
<title>List of Clinics</title>
<style>
table{
    width: 75%;
    border-collapse: collapse;
	border: 4px solid black;
    padding: 5px;
	font-size: 25px;
}

th{
border: 4px solid black;
	background-color: #4CAF50;
    color: white;
	text-align: left;
}
tr,td{
	border: 4px solid black;
	background-color: white;
    color: black;
}
</style>

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
<center><h1>SHOW CLINIC</h1><hr>
<?php
include '../dbconfig.php';
session_start();
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=../index.php"); 
	}
$sql="SELECT * FROM clinic order by City,Town,CID ASC";
$result = mysqli_query($conn,$sql);
echo "<br><h2>TOTAL CLINICS: <b>".mysqli_num_rows($result)."</b></h2><br>";
echo "<table>
<tr>
<th>CID</th>
<th>Name</th>
<th>Address</th>
<th>Town</th>
<th>City</th>
<th>Contact</th>
<th>MID</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
	echo "<td>" . $row['cid'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . $row['town'] . "</td>";
    echo "<td>" . $row['city'] . "</td>";
	echo "<td>" . $row['contact'] . "</td>";
	echo "<td>" . $row['mid'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
?>
</center>
</div>
</body>
</html>