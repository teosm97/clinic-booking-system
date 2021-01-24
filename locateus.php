<html>
<head>
<link rel="stylesheet" href="main.css">
<title>Locate Us</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head><?php include "dbconfig.php"; ?>
<script>
function getTown(val) {
	$.ajax({
	type: "POST",
	url: "get_town.php",
	data:'countryid='+val,
	success: function(data){
		$("#town-list").html(data);
	}
	});
}
function getClinic(val) {
	$.ajax({
	type: "POST",
	url: "getclinic.php",
	data:'townid='+val,
	success: function(data){
		$("#clinic-list").html(data);
	}
	});
}
function getDoctorday(val) {
	$.ajax({
	type: "POST",
	url: "getdoctordaybooking.php",
	data:'cid='+val,
	success: function(data){
		$("#doctor-list").html(data);
	}
	});
}
</script>
<body style="background-image:url(images/yellowpage.jpg);height: 110%; background-repeat: no-repeat;" >
	<div class="header">
		<ul>
			<li style="float:left;border-right:none"><a href="ulogin.php" class="logo"><img src="images/cal.png" width="30px" height="30px"><strong> Skylabs </strong>Appointment Booking System</a></li>
			<li><a href="index.php">Home</a></li>
		</ul>
	</div>
	<form action="locateus.php" method="post">
	<div class="sucontainer" style="background-color:white">
		<ul style="background-color:white">			
			<label style="margin-left:-30px;color:black"><b>Search Doctor</b></label>
			<input type="text" name="doctorname" placeholder="Enter Doctor Name" style="margin-left:-30px" class="form-control"></input>
			<div style="display:flex;justify-content:flex-end">
			<button type="submit" style="position:center;margin-left:-30px" name="subd" value="Submit" class="btn btn-dark">Submit</button>
			</div>
		</ul>
		<label style="font-size:20px;color:black" >City:</label><br>
		<select name="city" id="city-list" class="demoInputBox"  onChange="getTown(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">Select City</option>
		<?php
		$sql1="SELECT distinct(city) FROM clinic";
         $results=$conn->query($sql1); 
		while($rs=$results->fetch_assoc()) { 
		?>
		<option value="<?php echo $rs["city"]; ?>"><?php echo $rs["city"]; ?></option>
		<?php
		}
		?>
		</select>
        <br>
	
		<label style="font-size:20px;color:black" >Town:</label><br>
		<select id="town-list" name="Town" onChange="getClinic(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">Select Town</option>
		</select><br>
		
		<label style="font-size:20px;color:black" >Clinic:</label><br>
		<select id="clinic-list" name="Clinic" onChange="getDoctorday(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">Select Clinic</option>
		</select><br>
		<div class="container">
			<div style="display:flex;justify-content:flex-end">
			<button type="submit" style="position:center" name="submit" value="Submit" class="btn btn-dark">Submit</button>
			</div>
		</div>
<?php
session_start();
if(isset($_POST['subd']))
{
		include 'dbconfig.php';
		if(!empty($_POST['doctorname']))
		{
			$doctor=$_POST['doctorname'];
			$sql1 = "Select * from doctor where UPPER(name) like UPPER('%".$doctor."%')";
			$result1=mysqli_query($conn, $sql1);  
			while($row1 = mysqli_fetch_array($result1))
			{
			//echo "<hr>";
			echo "<h4>Dr. ".$row1['name']."</h4>Gender: ".$row1['gender']."<br>Specialization: ".$row1['specialization']."<br><br>";
			$sql2="select * from doctor_availability where did=".$row1["did"];
			//$sql2 = "Select name,address,contact from clinic where cid in (select cid from doctor_availability where did in(Select did from doctor where did=".$row1['did']."));";
			$result2=mysqli_query($conn, $sql2); 
			echo "<table class='table'><thead><tr>"; 
			echo "<th>Day</th><th>Time</th><th>Place</th></tr></thead><tbody>";
			while($row2 = mysqli_fetch_array($result2))
			{
			//echo "<b>Clinic Name:".$row2['name']."</b><br><b>Address:<b>".$row2['address']."<br><b>Contact:<b>".$row2['contact'];
			
			echo "<tr><td>".$row2["day"]."</td><td>".$row2["starttime"]." to ".$row2["endtime"]."</td>";
			
			$sql3="Select * from clinic where cid = ".$row2["cid"];
			$result3 = mysqli_query($conn , $sql3);
			while($row3 = mysqli_fetch_array($result3))
			{
				echo"<td>".$row3["name"]." ".$row3["town"]." ".$row3["city"]."</td></tr>";
			}
			
			}
			echo "</tbody></table>";
			}
		}
		else
		{
			echo '<script>alert("Enter a valid name!")</script>';
		}
}
if(isset($_POST['submit']))
{
		include 'dbconfig.php';
		$cid=$_POST['Clinic'];
		$sql1 = "Select * from clinic where cid=$cid";
		$result1=mysqli_query($conn, $sql1);  
		$row1 = mysqli_fetch_array($result1);
		$sql2 = "Select name,gender,specialization,contact from doctor where did in (select did from doctor_availability where cid=$cid);";
		$result2=mysqli_query($conn, $sql2);  
		$row2 = mysqli_fetch_array($result2);
		echo "<div class='card'>";
		echo "<h5 class='card-header'>".$row1['name']."</h5>";
		echo "<div class='card-body'><p class='card-text'>Address: ".$row1['address']."</p>";
		echo "<p class='card-text'>Contact: ".$row1['contact']."</p>";
		echo "<p class='card-text'>Doctor Name: ".$row2['name']."</p>";
		echo "<p class='card-text'>Specialization: ".$row2['specialization']."</p>";
		echo "<p class='card-text'>Doctor Contact: ".$row2['contact']."</p>"; 
}		echo "<div>";
?>
	</form>
</body>
</html>