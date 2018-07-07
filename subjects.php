<?php include('server.php');
$db = mysqli_connect('localhost', 'root', '', 'mini_app');
$query = "SELECT student.username, subject.subject_name 
		FROM register 
		JOIN subject ON subject.subject_id=register.subject_id 
		JOIN student ON student.student_id=register.student_id 
		WHERE student.username='".$_SESSION['username']."'";
$username = $_SESSION['username'];
$result1 = mysqli_query($db, $query);

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
		<div class="menu1">
			<a href="subjects.php"><button class="alltogether">Welcome <b><?php echo $username; ?></b></button></a>
			<a href="index.php?logout='1'"><button class="btnlogout" name="logout">Log out</button></a>
		</div>
		<div class="scrolltable">
			<table class="tables">
			<thead>
				<tr>
					<th>STUDENT</th>
					<th>SUBJECT</th>
				</tr>
			</thead>
			<tbody>
				<?php while($row1 = mysqli_fetch_array($result1)):; ?>					
				<tr>					
					<td><?php echo $row1[0]; ?></td>
					<td><?php echo $row1[1]; ?></td>					
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
		</div>
	</div>
</body>
</html>