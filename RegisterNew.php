<?php 
function load_directory()
{
	$connect = mysqli_connect('localhost', 'root', '', 'mini_app');
	$output = '';
	$sql = 'SELECT * FROM direction ORDER BY direction_name';
	$result = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($result))
	{
		$output .= '<option value="'.$row["direction_id"].'">'.$row["direction_name"].'</option>';
	}
	return $output;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Register New Student with Subject and Direction</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
	<label>Select Direction</label>
	<select name="direction" id="direction">
		<option value="">Select Direction</option>
		<?php echo load_directory(); ?>
	</select>
	<br>
	<label>Select Subject</label>
	<select name="subject" id="subject">
		<option value="">Select Subject</option>
	</select>
</body>
</html>

<script>
$(document).ready(function(){
	$('#direction').change(function(){
		var direction_id = $(this).val();
		$.ajax({
			url:"fetch_state.php",
			method:"POST",
			data:{directionId:direction_id},
			dataType:"text",
			success:function(data)
			{
				$('#subject').html(data);
			}
		});
	});
});
</script>