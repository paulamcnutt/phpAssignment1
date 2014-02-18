
<html>
        <head>
                <title>Student Data</title>
				<link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
                <?
					$courses=array("Physical Education 10","Accounting 11","Biology 11","Robotics 11","Digital Arts 11","French 11","English 12","History 12","Law 12","Communications 12");
					
						$first_section ="<form method=\"POST\" action=\"informationAdded.php\" ENCTYPE=\"multipart/form-data\">
								<span id=\"title\">
									Student Course Tracker
								</span>
								<div >
									<fieldset>
										<legend>
											Student Info
										</legend>
							
										<strong>First Name:</strong><input type=\"text\" id=\"txtFirstName\" name=\"first_name\" value=\"$_POST[first_name]\" size=30><br/>
										<strong>Last Name:</strong><input type=\"text\" id=\"txtLastName\" name=\"last_name\" value=\"$_POST[last_name]\" size=30><br/>
										<strong>Email:</strong><input type=\"text\" id=\"email\"  name=\"email\" value=\"$_POST[email]\" size=40><br/></fieldset></div>";
										
						$last_section="<div>
								<fieldset>
									<legend>
										Course Selection
									</legend>
									<input type=\"file\" name=\"uploadName\" value=\"Browse\" size=\"30\">
								</fieldset>
							</div>		
							<input type=\"hidden\" name=\"op\" value=\"ds\">
							<p><input type=\"submit\" name=\"submit\" class=\"buttons\" value=\"Submit\"></p>
						</form>	";
						
					if ($_POST['op'] != "ds") {
						// they need to see the form
						 echo "$first_section";?>
						 <!--Displays course dropdown menus-->
							<div><fieldset>
								<legend>
									Course Selection
								</legend>
								<?
									for($n=1; $n<=4; $n++){
								?>
								<strong>Course <? echo $n;?> </strong>
									<select name='selectCourse<? echo $n;?>' class="dropdowns" id='dropdowns<? echo $n;?>'>
										<? 
											for($i=0; $i<=9; $i++){
										?>
											<option value="<? echo $courses[$i];?>"><? echo $courses[$i];?></option>
										<?
										}
										?> 		
									</select><br/>
									<?
									}
									?>
							</fieldset></div>	
						<? echo $last_section ?>
							
					<?}
							
				?>
        </body>
</html>