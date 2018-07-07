<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Student</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="moj.css">
</head>
<body>
	<div class="loginbox">
		<img src="stud.png" class="avatar">		
			<h1>LOGIN HERE</h1>
			<?php include('errors.php'); ?>
			<form method="post" action="index.php">
				<div class="form-group">
					<label>Username</label>
					<input class="form-control" type="text" name="username" id="username" placeholder="Enter Username">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" name="password" placeholder="Enter Password">
				</div>
				<input class="button btn btn-primary" type="submit" name="login" value="Login"><br>
				<a href="#">Lost your password?</a><br>
			</form>
	</div>
</body>
</html>