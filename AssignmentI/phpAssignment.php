
<html>
        <head>
                <title>Student Data</title>
				<link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
                <?
					if (!isset($_POST['first_name'])){
						$_POST['first_name']="";
					}
					if (!isset($_POST['last_name'])){
						$_POST['last_name']="";
					}
					if (!isset($_POST['email'])){
						$_POST['email']="";
					}
					if (!isset($_POST['op'])){
						$_POST['op']="";
					}

					
					$courses=array("Physical Education 10","Accounting 11","Biology 11","Robotics 11","Digital Arts 11","French 11","English 12","History 12","Law 12","Communications 12");
					
						$first_section ="<form method=\"POST\" action=\"$_SERVER[PHP_SELF]\">
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
							
					<?}else{
														
							$firstNameErr="";
							$lastNameErr="";
							$emailErr="";
							if (!preg_match("/^[a-zA-Z'-]/",$_POST["first_name"])){
									$firstNameErr = "Only letters and white space allowed in first name <br/>"; 
									echo $firstNameErr;
							}
							if(!preg_match("/^[a-zA-Z'-]/",$_POST["last_name"])){
									$lastNameErr = "Only letters and white space allowed in last name <br/>";
									echo $lastNameErr;
							}
							if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
									$emailErr = "Invalid email format"; 
									echo $emailErr;
							} 
							
							if($firstNameErr=="" && $lastNameErr=="" && $emailErr==""){
								if ($_FILES['uploadName'] != "") {
									echo "point 2";
									$ftp_server = "php.nscctruro.ca";
									$ftp_username = "w0245232";
									$ftp_password = "w0245232";
									
									$conn_id = ftp_connect($ftp_server) or die("could not connect to $ftp_server");
									echo"point 3";
									if(@ftp_login($conn_id, $ftp_username, $ftp_password)){
									  ftp_put($conn_id, "../files/courses/".$_FILES['uploadName']['name'], $_FILES['uploadName']['tmp_name'],FTP_ASCII);
									  ftp_close($conn_id);
									}else {
									  echo "No connection";
									}
								}  else {
										die("No input file specified");
								}
							}
						}
							
				?>
        </body>
</html>