	<?	
		//set errors equal to nothing
		$firstNameErr="";
		$lastNameErr="";
		$emailErr="";
		
		//check to see if all input for first name is valid, echo any errors
		if (!preg_match("/^[a-zA-Z'-]/",$_POST["first_name"])){
				$firstNameErr = "Only letters and white space allowed in first name. Course Information not submitted. <br/>"; 
				echo $firstNameErr;
		}
		
		//check to see if all input for the last name is valid, echo any errors
		if(!preg_match("/^[a-zA-Z'-]/",$_POST["last_name"])){
				$lastNameErr = "Only letters and white space allowed in last name. Course Information not submitted. <br/>";
				echo $lastNameErr;
		}
		
		//check to see if email is in correct format, echo any errors
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format. Course Information not submitted."; 
				echo $emailErr;
		} 
		
		//if there are no errors in text input then.....
		if($firstNameErr=="" && $lastNameErr=="" && $emailErr==""){
	
					$ftp_server = "php.nscctruro.ca";
					$ftp_username   = "w0245232";
					$ftp_password   =  "w0245232";
					
				$conn_id = ftp_connect($ftp_server) or die("could not connect to $ftp_server");

				if(@ftp_login($conn_id, $ftp_username, $ftp_password)){
				  //connected
				if ($_FILES['uploadName'] != "") {
				//echo confirmation details
				echo "Course Information Confirmation: <br/>
					  Student First Name: ". $_POST['first_name'] ."<br/>
					  Student Last Name: ". $_POST['last_name'] . "<br/>
					  Student Email: ". $_POST['email']. "<br/>
					  Course #1 : ". $_POST['selectCourse1']. "<br/>
					  Course #2 : ". $_POST['selectCourse2']. "<br/>
					  Course #3 : ". $_POST['selectCourse3']. "<br/>
					  Course #4 : ". $_POST['selectCourse4']. "<br/>
					  <img src=../files/img/".$_FILES['uploadName']['name'].">";
						$file_parts = pathinfo($_FILES['uploadName']['name']);
						switch($file_parts['extension']){
						case "jpg"|| "png" ||"gif":
						ftp_put($conn_id, "../files/img/".$_FILES['uploadName']['name'], $_FILES['uploadName']['tmp_name'],FTP_ASCII);
						break;
						}
						
						//loop through and check which courses were selected and add student name to corresponding course files
						$courses=array("Physical Education 10","Accounting 11","Biology 11","Robotics 11","Digital Arts 11","French 11","English 12","History 12","Law 12","Communications 12");
						$files=array("physicaleducation10","accounting11","biology11","robotics11","digitalarts11","french11","english12","history12","law12","communications12");
						$i=0;
						$n=0;
						for($i=0; $i<=9; $i++){
							for($n=1; $n<=4; $n++){
								if ($_POST['selectCourse'.$n]==$courses[$i]){
									$fileName="../files/courses/$files[$i]";
									$newstring=(($_POST["first_name"])." ".(substr($_POST["last_name"], 0, 1))."\n");
									$myfile=@fopen($fileName, "a+") or die("Couldn't open file.");
									@fwrite($myfile, $newstring) or die ("Couldn't write to file.");
									$msg="<p></p>";
									fclose($myfile);
								}
							}
						}
				}  else {
						die("No input file specified");
				}
			}else {
			  //echo error message
			  echo "Could not connect as $ftp_username\n";
			}
	}
?>