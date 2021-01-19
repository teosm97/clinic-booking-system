<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="adminmain.css"> 
</head>
<body style="background-image:url(../images/doctordesk.jpg); height: 100%; background-repeat: no-repeat;">
<ul>
<li class="dropdown"><font color="yellow" size="10">ADMIN MODE</font></li>
<br>
<h2>
  <li class="dropdown">    
  <a href="javascript:void(0)" class="dropbtn">Doctor</a>
    <div class="dropdown-content">
      <a href="adddoctor.php">Add Doctor</a>
      <a href="deletedoctor.php">Delete Doctor</a>
      <a href="showdoctor.php">Show Doctor</a>
	  <a href="showdoctorschedule.php">Show Doctor Schedule</a>
    </div>
  </li>
  
  <li class="dropdown">
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
  <li class="dropdown">    
  <a href="javascript:void(0)" class="dropbtn">Manager</a>
    <div class="dropdown-content">
      <a href="addmanager.php">Add Manager</a>
      <a href="deletemanager.php">Delete Manager</a>
	  <a href="showmanager.php">Show Manager</a>
    </div>
  </li>
  <li>  
	<form method="post" action="mainpage.php">	
	<button type="submit" class="cancelbtn" name="logout" style="float:right;font-size:22px"><b>Log Out</b></button>
	</form>
  </li>
	
</ul>
</h2>
<div class="container">
<center><h1>DELETE MANAGER</h1><hr><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

Select Name:<br><?php
				require_once('../dbconfig.php');
				$manager_result = $conn->query('select * from manager order by MID ASC');
				?>
				<center>
				<select name="managername">
				<option value="">---Select Name---</option>
				<?php
				if ($manager_result->num_rows > 0) {
				while($row = $manager_result->fetch_assoc()) {
				?>
				<option value="<?php echo $row["mid"]; ?>"><?php echo "(mid=".$row["mid"].") ".$row["name"]; ?></option>
				<?php
					}
					}
				?>
				</select></center>
				
				<button type="submit" name="Submit2">Delete by Name</button>
</form>		
</div>	
<?php
session_start();
include '../dbconfig.php';

if(isset($_POST['Submit2']))
{
	$mid=$_POST['managername'];
	$sql = "DELETE FROM manager WHERE mid = $mid;UPDATE clinic set mid=0 where mid=$mid";
	//$sql1="update clinic set MID=0 where MID=$mid";
	if (mysqli_multi_query($conn, $sql))
		{
		echo "Record deleted successfully.Refreshing....";
		header( "Refresh:3; url=deletemanager.php");
		}
	else
		{
			echo "Error deleting record: " . mysqli_error($conn);
		}
				

}	
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=../index.php"); 
	}
?>			
</body>
</html>