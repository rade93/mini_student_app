<?php include('server.php');
$db = mysqli_connect('localhost', 'root', '', 'mini_app');
$query = "SELECT * FROM student";
$result1 = mysqli_query($db, $query);

if (isset($_POST['submitstudent'])) {
	$studentId = mysqli_real_escape_string($db, $_POST['studentID']);
	$studentName = mysqli_real_escape_string($db, $_POST['student']);
	$studentPassword = mysqli_real_escape_string($db, $_POST['password']);

	if (empty($studentId)) {
  	array_push($errors, "ID is required");
	}
	if (empty($studentName)) {
		array_push($errors, "Studentname is required");
	}
	if (count($errors) == 0) {
		$sql = "INSERT INTO student (student_id, username, password) 
				VALUES ('$studentId', '$studentName', '$studentPassword')";
		$_SESSION['success1'] = "Successful entered datas";
		if(mysqli_query($db,$sql)){
		header('Location: addstudent.php');
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
						<th>Student ID</th>
						<th>Student Name</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row1 = mysqli_fetch_array($result1)):; ?>					
					<tr>					
						<td><?php echo $row1['student_id']; ?></td>
						<td><?php echo $row1['username']; ?></td>					
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		
		<div class="poststudent">
			<form action="addstudent.php" method="post">
				<?php include('errors.php'); ?>
				<div class="form-group">
					<label>Student ID: </label>
					<input class="form-control" type="text" name="studentID">
				</div>
				<div class="form-group">
					<label>Username</label>
					<input class="form-control" type="text" name="student">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" name="password">
				</div>
				<input type="submit" name="submitstudent" class="button btn btn-primary" value="Submit">
			</form>
		</div>
	</div>
</body>
</html>