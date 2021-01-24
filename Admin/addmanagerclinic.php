<html>
<head>
<script src="jquerypart.js" type="text/javascript"></script>
<link rel="stylesheet" href="../Admin/adminmain.css"> 
<title>Assign Manager to Clinic</title>
<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "getclinic.php",
	data:'city='+val,
	success: function(data){
		$("#clinic-list").html(data);
	}
	});
}
function getManagerRegion(val) {
	$.ajax({
	type: "POST",
	url: "getmanagerregion.php",
	data:'city='+val,
	success: function(data){
		$("#manager-list").html(data);
	}
	});
}

</script>
</head>
<body style="background-image:url(../images/doctordesk.jpg); height: 100%; background-repeat: no-repeat;">
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
<center><h1>ASSIGN MANAGER TO A CLINIC</h1><hr><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<label style="font-size:20px" >City:</label>
		<select name="city" id="city-list" class="demoInputBox"  onChange="getState(this.value);getManagerRegion(this.value);">
		<option value="">Select City</option>
		<?php
		include '../dbconfig.php';
		$sql1="SELECT distinct City FROM clinic";
         $results=$conn->query($sql1); 
		while($rs=$results->fetch_assoc()) { 
		?>
		<option value="<?php echo $rs["City"]; ?>"><?php echo $rs["City"]; ?></option>
		<?php
		}
		?>
		</select><br>
        
	
		<label style="font-size:20px" >Clinic:</label>
		<select id="clinic-list" name="clinic" >
		<option value="">Select Clinic</option>
		</select><br>
		
		<label style="font-size:20px" >Manager:</label>
		<select name="manager" id="manager-list">
		<option value="">Select Manager</option>
		</select><br>

		<button name="Submit" type="submit">Submit</button>
	</form>
	</div>
<?php
session_start();
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=../index.php"); 
	}
if(isset($_POST['Submit']))
{
		include '../dbconfig.php';
		$cid=$_POST['clinic'];
		$mid=$_POST['manager'];
		
				$sql = "INSERT INTO manager_clinic (CID, MID) VALUES ('$cid','$mid')";
				$sql1="update clinic set MID=$mid where CID=$cid";
				if (mysqli_query($conn, $sql)) 
				{
							echo "<h2>Record created successfully( CID=$cid MID=$mid )!!</h2>";
							echo "Please wait...Refreshing...";
							header( "Refresh:2; url=addmanagerclinic.php");

				} 
				else
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				if (mysqli_query($conn, $sql1)) 
				{
							echo "<h2>Record created successfully( CID=$cid MID=$mid )in CLINIC TABLE!!</h2>";
							echo "Please wait...Refreshing...";
							header( "Refresh:2; url=addmanagerclinic.php");

				} 
				else
				{
					echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
				}
				
}

?>

</body>
</html>