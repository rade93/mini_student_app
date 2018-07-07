<?php include('server.php');
$db = mysqli_connect('localhost', 'root', '', 'mini_app');
$query = "SELECT * FROM subject";
$result1 = mysqli_query($db, $query);

/*function load_direction()
{
	$db = mysqli_connect('localhost', 'root', '', 'mini_app');
	$output = '';
	$query = "SELECT * FROM subject";
	$result1 = mysqli_query($db, $query);
	while ($row = mysqli_fetch_array($result1))
	{
		$output .= '<option value="'.$row["subject_id"].'">'.$row["subject_name"].'</option>';
	}
	return $output;
}
*/

if (isset($_POST['submitsubject'])) {
	$subjectId = mysqli_real_escape_string($db, $_POST['subjectID']);
	$directionId = mysqli_real_escape_string($db, $_POST['subjectselection']);
	$subjectName = mysqli_real_escape_string($db, $_POST['subjectname']);

	if (empty($subjectId)) {
  	array_push($errors, "ID is required");
	}
	if (empty($directionId)) {
		array_push($errors, "Direction is required");
	}
	if (empty($subjectName)) {
		array_push($errors, "Subject name is required");
	}
	if (count($errors) == 0) {
		$sql = "INSERT INTO subject (subject_id, direction_id, subject_name) 
				VALUES ('$subjectId', '$directionId', '$subjectName')";
		$_SESSION['success1'] = "Successful entered datas";
		if(mysqli_query($db,$sql)){
		header('Location: addsubject.php');
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
	<link rel="stylesheet" type="text/css" href="moj.css">
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
						<th>Subject ID</th>
						<th>Subject Name</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sel_sql = "SELECT * FROM subject";
						$run_sql = mysqli_query($db,$sel_sql);
						while($rows = mysqli_fetch_assoc($run_sql)){?>				
					<tr>					
						<td><?php echo $rows['subject_id']; ?></td>
						<td><?php echo $rows['subject_name']; ?></td>					
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		
		<div class="postsubjects">

			<form action="addsubject.php" method="post">
				<?php include('errors.php'); ?>
				<div class="form-group">
					<label>Subject ID: </label>
					<input class="form-control" type="text" name="subjectID">
				</div>
				<div class="form-group">
					<label>Direction of Subject</label>
					<select class="form-control" name="subjectselection">
						<option value="">Select Direction</option>
						<?php
						$sel_sql = "SELECT * FROM direction";
						$run_sql = mysqli_query($db,$sel_sql);
						while($rows = mysqli_fetch_assoc($run_sql)){?>
							<option value="<?php echo $rows['direction_id']; ?>"><?php echo $rows['direction_name']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Subject Name</label>
					<input class="form-control" type="text" name="subjectname">
				</div>				
				<input type="submit" name="submitsubject" class="button btn btn-primary" value="Submit">
			</form>
		</div>
	</div>
</body>
</html>