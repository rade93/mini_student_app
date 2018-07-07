<?php include('server.php');
$db = mysqli_connect('localhost', 'root', '', 'mini_app');
$query = "SELECT * FROM register 
		JOIN student ON student.student_id=register.student_id 
		JOIN subject ON subject.subject_id=register.subject_id 
		JOIN direction ON direction.direction_id=register.direction_id";
$result1 = mysqli_query($db, $query);

if (isset($_POST['alltogether'])) {
	$directionId = mysqli_real_escape_string($db, $_POST['directionID']);
	$subjectId = mysqli_real_escape_string($db, $_POST['subjectID']);
	$studentId = mysqli_real_escape_string($db, $_POST['studentID']);

	if (empty($directionId)) {
  	array_push($errors, "Direction ID is required");
	}
	if (empty($subjectId)) {
		array_push($errors, "Subject ID is required");
	}
	if (empty($studentId)) {
		array_push($errors, "Student ID name is required");
	}
	if (count($errors) == 0) {
		$sql = "INSERT INTO register (direction_id, subject_id, student_id) 
				VALUES ('$directionId', '$subjectId', '$studentId')";
		$_SESSION['success1'] = "Successful entered datas";
		if(mysqli_query($db,$sql)){
		header('Location: alltogether.php');
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
						<th>Student Name</th>
						<th>Subject Name</th>
						<th>Direction Name</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row1 = mysqli_fetch_array($result1)):; ?>					
					<tr>					
						<td><?php echo $row1['username']; ?></td>
						<td><?php echo $row1['subject_name']; ?></td>
						<td><?php echo $row1['direction_name']; ?></td>				
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		<div class="postall">
			<form action="alltogether.php" method="post">
				<?php include('errors.php'); ?>
				<div class="form-group">
					<label>Direction ID: </label>
					<input class="form-control" type="text" name="directionID">
				</div>				
				<div class="form-group">
					<label>Subject ID: </label>
					<input class="form-control" type="text" name="subjectID">
				</div>
				<div class="form-group">
					<label>Student ID: </label>
					<input class="form-control" type="text" name="studentID">
				</div>				
				<input type="submit" name="alltogether" class="button btn btn-primary" value="Submit">
			</form>
		</div>
	</div>
</body>
</html>