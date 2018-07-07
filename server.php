<?php 
	session_start();

	$student_id = "";
	$studentName = "";
	$direction = "";
	$username = "";
	$email = "";
	$password = "";
	$username = lcfirst($username);
	$errors = array();
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'mini_app');

	// if the register button is clicked	

	/*
	if(isset($_POST['register'])){
		$direction = mysqli_real_escape_string($db, $_POST['direction']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// ensure that form fields are filled properly
		
		if (empty($direction)) {
			array_push($errors,"Direction is required");
		}
		if (empty($username)) {
			array_push($errors,"Username is required");
		}
		if (empty($email)) {
			array_push($errors,"Email is required");
		}
		if (empty($password_1)) {
			array_push($errors,"Password is required");
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// if there are no errors, save user to database
		if (count($errors) == 0) {
			$password = md5($password_1); // encrypt passwort before storing in database (security)
			$query = "INSERT INTO student (username, password) VALUES('$username', '$password')";
  			mysqli_query($db, $query);
  			$_SESSION['username'] = $username;
  			$_SESSION['success'] = "You are now logged in";
  			header('location: subjects.php'); // redirect to home page
		}
	}
	*/

	// log user in form login page
	if (isset($_POST['login'])) {
	  	$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

	  if (empty($username)) {
	  	array_push($errors, "Username is required");
	  }
	  if (empty($password)) {
	  	array_push($errors, "Password is required");
	  }

	  	if (count($errors) == 0) {
	  	//$password = md5($password);
	  	
	  	//$query = "SELECT * FROM student WHERE username='$username' AND password='$password'";
	  	//$results = mysqli_query($db, $query);
	  	/*if (mysqli_num_rows($results) == 1) {
			$_SESSION['username'] = $username;
			$_SESSION['id_student'] = $student_id;
			$_SESSION['type'] = $student_type;
			$_SESSION['success'] = "You are now logged in";
			if ($_SESSION["type"]=='user') {
				header('location: subjects.php');
			}else{
				header('location: alltogether.php');
			}			
	  	}else {
	  		array_push($errors, "Wrong username/password combination");
	  	}*/
	  	$query=mysqli_query($db,"SELECT username,password,type FROM student");
	    while($row=mysqli_fetch_array($query))
	    {
	        $username=$row["username"];
	        $password=$row["password"];
	        $student_type=$row["type"];
	        $username1 = $_POST['username'];
	        $password1 = $_POST['password'];

	        if($username1==$username && $password1==$password){
	            session_start();
	            $_SESSION["username"]=$username;
	            $_SESSION["type"]=$student_type;

	            if($_SESSION["type"]=='admin'){
	                header("Location:alltogether.php");
	            }
	            else if ($_SESSION["type"]=='user'){
	                header("Location:subjects.php");
	            }
	        }
		}
		}
	}

	// logout
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header('location: index.php');
	}

	

 ?>