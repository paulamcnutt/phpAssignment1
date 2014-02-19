<html>
        <head>
                <title>Student Data</title>
				<link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
                <?
				if (!isset($_POST['first_name'])){
					$_POST['first_name']='';
				}
				if (!isset($_POST['last_name'])){
					$_POST['last_name']='';
				}
				if (!isset($_POST['email'])){
					$_POST['email']='';
				}
				if (!isset($_POST['birth'])){
					$_POST['birth']='';
				}
					$courses=array("Physical Education 10","Accounting 11","Biology 11","Robotics 11","Digital Arts 11","French 11","English 12","History 12","Law 12","Communications 12");
						echo "<form method=\"POST\" action=\"informationAdded.php\" ENCTYPE=\"multipart/form-data\">
								<span id=\"title\">Student Course Tracker</span>
								<div ><fieldset>
										<legend>Student Info</legend>
										<strong>First Name:</strong><input type=\"text\" id=\"txtFirstName\" name=\"first_name\" value=\"$_POST[first_name]\" size=30><br/>
										<strong>Last Name:</strong><input type=\"text\" id=\"txtLastName\" name=\"last_name\" value=\"$_POST[last_name]\" size=30><br/>
										<strong>Email:</strong><input type=\"text\" id=\"email\"  name=\"email\" value=\"$_POST[email]\" size=40><br/>
										<strong>Birthdate:</strong><input type=\"text\" id=\"birth\"  name=\"birth\" value=\"$_POST[birth]\" size=10><br/>
										<strong>(MM/DD/YY)</strong>
									</fieldset></div>";
				?>
						 <!--Displays course dropdown menus-->
							<div><fieldset>
								<legend>Course Selection</legend>
								<? for($n=1; $n<=4; $n++){ ?>
								<strong>Course <? echo $n;?> </strong>
									<select name='selectCourse<? echo $n;?>' class="dropdowns" id='dropdowns<? echo $n;?>'>
										<?  for($i=0; $i<=9; $i++){ ?>
											<option value="<? echo $courses[$i];?>"><? echo $courses[$i];?></option>
										<? } ?> 		
									</select><br/>
									<? } ?>
							</fieldset></div>	
					<?	echo "<div>
								<fieldset>
									<legend>Course Selection</legend>
									<input type=\"file\" name=\"uploadName\" value=\"Browse\" size=\"30\">
								</fieldset>
							</div>		
							<p><input type=\"submit\" name=\"submit\" class=\"buttons\" value=\"Submit\"></p>
						</form>	";
					 ?>	
        </body>
</html>