<?php include('server.php');
$db = mysqli_connect('localhost', 'root', '', 'mini_app');
$query = "SELECT * FROM direction";
$result1 = mysqli_query($db, $query);

if (isset($_POST['submitdirection'])) {
	$directionId = mysqli_real_escape_string($db, $_POST['directionID']);
	$directionName = mysqli_real_escape_string($db, $_POST['directionname']);

	if (empty($directionId)) {
  	array_push($errors, "ID is required");
	}
	if (empty($directionName)) {
		array_push($errors, "Direction name is required");
	}
	if (count($errors) == 0) {
		$sql = "INSERT INTO direction (direction_id, direction_name) 
				VALUES ('$directionId', '$directionName')";
		$_SESSION['success1'] = "Successful entered datas";
		if(mysqli_query($db,$sql)){
		header('Location: adddirection.php');
		}else{
			array_push($errors, "Insert does not work!");
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Subjects</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="moj.css?version=1">
</head>
<body>
	<div class="container">
		<div class="menu">
			<a href="addsubject.php"><button class="addsubject">View or Add Subject</button></a>
			<a href="adddirection.php"><button class="adddirection">View or Add Direction</button></a>
			<a href="addstudent.php"><button class="addstudent">View or Add Student</button></a>
			<a href="alltogether.php"><button class="alltogether">Add Subject to Student</button></a>
			<a href="index.php?logout='1'"><button class="btnlogout" name="logout">Log out</button></a>
		</div>
		
		<div class="scrolltable">
			<table class="tables">
				<thead>
					<tr>
						<th>Direction ID</th>
						<th>Diraction Name</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row1 = mysqli_fetch_array($result1)):; ?>					
					<tr>					
						<td><?php echo $row1['direction_id']; ?></td>
						<td><?php echo $row1['direction_name']; ?></td>					
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		
		<div class="postdirection">
			<form action="adddirection.php" method="post">
				<?php include('errors.php'); ?>
				<div class="form-group">
					<label>Direction ID: </label>
					<input class="form-control" type="text" name="directionID">
				</div>
				<div class="form-group">
					<label>Direction Name</label>
					<input class="form-control" type="text" name="directionname">
				</div>
				<input type="submit" name="submitdirection" class="button btn btn-primary" value="Submit">
			</form>
		</div>
	</div>
</body>
</html>