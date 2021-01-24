<html>
<head>
<link rel="stylesheet" href="../main.css">
<style>
table{
    width: 85%;
    border-collapse: collapse;
	border: 4px solid black;
    padding: 5px;
	font-size: 20px;
}

th{
border: 1px solid black;
	background-color: #333;
    color: white;
	text-align: left;
}
tr,td{
	border: 1px solid black;
	background-color: white;
    color: black;
}
body,html{
	background-image:url(http://www.dreamtemplate.com/dreamcodes/bg_images/color/c4.jpg); 
	background-repeat: no-repeat; 
	background-attachment: fixed;
	background-size: cover;
	
}



</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head><?php include "../dbconfig.php"; ?>
<!--<body style="background-image:url(../images/cancelback.jpg)"> -->

<body>
<div class="header">
				<ul>
					<li style="float:left;border-right:none"><a href="ulogin.php" class="logo"><img src="../images/cal.png" width="30px" height="30px"><strong> Skylabs </strong>Appointment Booking System</a></li>
					
					<li><a name ="logout" href=../index.php>Logout</a></li>
					<li><a href="viewpatientappointments.php">Show/Cancel Appointment</a></li>
					<li><a href="book.php">Book Now</a></li>
					<li><a href="ulogin.php">Home</a></li>
				</ul>
</div>


	

	<!--ditambah baru-->
	<form action="viewpatientappointments.php" method="post">
	<!-- <div class="sucontainer"> -->
	<div class="sucontainer" style="background-color:white; border: 2px solid black; border-radius: 5px; padding: 12px 20px; left:20%; right:20%;">
		<center>
		<!-- <label style="font-size:30px; color:black" >Select Appointment to Cancel</label><br><br> -->
		
		<h2 style="text-align: center">Select Appointment to Cancel</h2>
		<hr><br>

		<select name="appointment" id="appointment-list" class="demoInputBox"  style="width:90%;height:35px;border-radius:9px">
		<option value="">Select Appointment</option>
		<?php
		session_start();
		$username=$_SESSION['username'];
		$date= date('Y-m-d');
		$sql1="SELECT * from book where username='".$username."'and status not like 'Cancelled by Patient' and DOV >='$date'";
         $results=$conn->query($sql1); 
		while($rs=$results->fetch_assoc()) {
			$sql2="select * from doctor where did=".$rs["DID"];
			$results2=$conn->query($sql2);
				while($rs2=$results2->fetch_assoc()) {
					$sql3="select * from clinic where cid=".$rs["CID"];
					$results3=$conn->query($sql3);
		while($rs3=$results3->fetch_assoc()) {
			
		?>
		<option value="<?php echo $rs["Timestamp"]; ?>"><?php echo "Patient: ".$rs["Fname"]." Date: ".$rs["DOV"]." -Dr.".$rs2["name"]." -Clinic: ".$rs3["name"]." -Town: ".$rs3["town"]." - Booked on:".$rs["Timestamp"]; ?></option>
		<?php
		}
		}
		}
		?>
		</select>
		

		<!--<button type="submit" style="position:center" name="submit" value="Submit">Submit</button>-->
		
			<div class="text-center">
			<button type="submit" style="position:center" name="submit" value="Submit">Submit</button>
		</div>
	
	</form>
	
<!--	<label style="font-size:30px" >Show Appointment: </label><br><br> -->
	<?php
	
if(isset($_POST['submit']))
{
		$username=$_SESSION['username'];
		$timestamp=$_POST['appointment'];
		$updatequery="update book set Status='Cancelled by Patient' where username='$username' and timestamp= '$timestamp'";
				if (mysqli_query($conn, $updatequery)) 
				{
					echo '<script>alert("Appointment Cancelled successfully!");
					window.location.href="ulogin.php";</script>';
					
							//echo"<label> Appointment cancelled successfully! </label><br> ";
						   // echo "Appointment Cancelled successfully..!!<br>"; 
						//	header( "Refresh:2; url=viewpatientappointments.php");

				} 
				else
				{
					echo "Error: " . $updatequery . "<br>" . mysqli_error($conn);
				}

}
if(isset($_POST['logout']))
{
	session_unset();
	session_destroy();
	header( "Refresh:1; url=../index.php"); 
}
?>
</center>
</div>

<br><br>




<div class="sucontainer" style="background-color:white; border: 2px solid black; border-radius: 5px; padding: 12px 20px; left:20%; right:20%; top: 50%">
<center>
<!-- <label style="font-size:30px; color: black" >Show Appointment </label><br><br> -->
<h2 style="text-align: center">Show Appointment</h2>
		<hr><br>
	
	<?php
	
	$username=$_SESSION['username'];
	$sql1 = "Select * from book where username ='".$username."' order by DOV desc";
			$result1=mysqli_query($conn, $sql1); 
			echo "<table >
					<tr>
					<th>Appointment-Date</th>
					<th>Name</th>
					<th>Clinic</th>
					<th>Doctor</th>
					<th>Status</th>
					<th>Booked-On</th>
					</tr>";
			while($row1 = mysqli_fetch_array($result1))
			{
				$sql2="SELECT * from doctor where did=".$row1['DID'];
				$result2= mysqli_query($conn,$sql2);
				while($row2= mysqli_fetch_array($result2))
				{
					$sql3="SELECT * from clinic where CID=".$row1['CID'];
						$result3= mysqli_query($conn,$sql3);
						while($row3= mysqli_fetch_array($result3))
						{
								echo "<tr>";
								echo "<td>" . $row1['DOV'] . "</td>";
								echo "<td>" . $row1['Fname'] . "</td>";
								echo "<td>" . $row3['name']."-".$row3['town'] . "</td>";
								echo "<td>" . $row2['name'] . "</td>";
								echo "<td>" . $row1['Status'] . "</td>";
								echo "<td>" . $row1['Timestamp'] . "</td>";
								echo "</tr>";
						}
				}
				
			}
	?>
</center>
</div>



</body>
</html>