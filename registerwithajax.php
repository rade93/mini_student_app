<?php include('server.php'); 
$db = mysqli_connect('localhost', 'root', '', 'mini_app');

$query = "SELECT * FROM direction GROUP BY direction_id";
$result1 = mysqli_query($db, $query);
?>
<html>  
      <head>  
           <title>Dynamically Add or Remove input fields in PHP with JQuery</title>
           <link rel="stylesheet" type="text/css" href="moj.css">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      </head>  
      <body>  
           <div class="container">  
                <br />  
                <br />  
                <h2 align="center">Enter New Direction</h2>  
                <div class="form-group">  
                     <form action="register.php" name="add_name" id="add_name">  
                          <div class="table-responsive">
                          	<a href="index.php"><input type="button" class="btn btn-info" id="btnback" value="Back"></a>
                               <table class="table table-bordered" id="dynamic_field">  
                                    <tr>  
                                         <td><input type="text" name="direction[]" placeholder="Enter Direction" class="form-control name_list" /></td>  
                                         <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                    </tr>  
                               </table>  
                               <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                          </div>  
                     </form>  
                     <hr>
                     <!--<form action="register.php" name="add_subject" id="add_subject">                          	
                          <div class="table-responsive">
                               <table class="table table-bordered" id="subject_field">
                                    <tr>
                                    	<td>
                                    		<select id="idsubject">
                                    			<?php while($row1 = mysqli_fetch_array($result1)):; ?>
                                    				<option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                                    			<?php endwhile; ?> 
                                    		</select>
                                    	</td>
                                        <td><input type="text" name="subject[]" placeholder="Enter Subject" class="form-control name_list" /></td>  
                                        <td><button type="button" name="add1" id="add1" class="btn btn-success">Add More</button></td>  
                                    </tr>  
                               </table>  
                               <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                          </div>  
                     </form> -->
                     <hr>
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="direction[]" placeholder="Enter New Direction" class="form-control direction_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 
      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>