<?php  
//fetch_state.php

$connect = mysqli_connect('localhost', 'root', '', 'mini_app');
$output = '';
$sql = 'SELECT subject_name 
		FROM `subject` 
		JOIN direction ON direction.direction_id=subject.direction_id 
		WHERE direction.direction_id= '.$_POST['directionId'].'';
$result = mysqli_query($connect, $sql);
$output = '<option value="">Select Subject</option>';
while ($row = mysqli_fetch_array($result))
{
	$output .= '<option value="'.$row["subject_id"].'">'.$row["subject_name"].'</option>';
}
echo $output;
?>