	<?	
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
						
										$ftp_server = "php.nscctruro.ca";
										$ftp_username   = "w0245232";
										$ftp_password   =  "w0245232";
										
									$conn_id = ftp_connect($ftp_server) or die("could not connect to $ftp_server");

									if(@ftp_login($conn_id, $ftp_username, $ftp_password)){
									  
									}else {
									  echo "Could not connect as $ftp_username\n";
									}
										if ($_FILES['uploadName'] != "") {
												$file_parts = pathinfo($_FILES['uploadName']['name']);
													switch($file_parts['extension']){
													case "jpg"|| "png" ||"gif":
													ftp_put($conn_id, "../files/img/".$_FILES['uploadName']['name'], $_FILES['uploadName']['tmp_name'],FTP_ASCII);
													break;
													}
													if (($_POST['selectCourse1']=="Physical Education 10")||($_POST['selectCourse2']=="Physical Education 10")||($_POST['selectCourse3']=="Physical Education 10")||($_POST['selectCourse3']=="Physical Education 10")){
														$fileName="../files/courses/physicaleducation10";
													}
													$newstring=(($_POST["first_name"])." ".(substr($_POST["last_name"], 0, 1)));
													$myfile=@fopen($fileName, "w+") or die("Couldn't open file.");
													@fwrite($myfile, $newstring) or die ("Couldn't write to file.");
													$msg="<p></p>";
													fclose($myfile);
													
												
										}
								}  else {
										die("No input file specified");
								}
							
							
							?>