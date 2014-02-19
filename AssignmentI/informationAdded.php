	<?	
		//set errors equal to nothing
		$firstNameErr="";
		$lastNameErr="";
		$emailErr="";
		$birthErr="";
		$imageErr="";
		$msg="";
		//check to see if all input for first name is valid, echo any errors
		if (!preg_match("/^[a-zA-Z'-]/",$_POST["first_name"])){
				$firstNameErr = "Only letters and white space allowed in first name.  <br/>"; 
				echo $firstNameErr;
		}
		//check to see if all input for the last name is valid, echo any errors
		if(!preg_match("/^[a-zA-Z'-]/",$_POST["last_name"])){
				$lastNameErr = "Only letters and white space allowed in last name.  <br/>";
				echo $lastNameErr;
		}
		//check to see that birth date is formatted correctly
		if(!preg_match("/^\d{2}\/\d{2}\/\d{2}$/",$_POST["birth"])){
			$birthErr="Invalid birthdate input. Must be in the format mm/dd/yy. <br/>";
			echo $birthErr;
		}
		//check to see if email is in correct format, echo any errors
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format. "; 
				echo $emailErr;
		} 
		//check to make sure valid image was inputted
		$file_parts = pathinfo($_FILES['uploadName']['name']);
		if ($_FILES['uploadName']== "") {
			$imageErr = "Must add an image to submit Course Information. "; 
			echo $imageErr;
		}elseif (($file_parts['extension']=="jpg") || ($file_parts['extension']=="png")||($file_parts['extension']=="gif")){
			//right format
		}else{
			$imageErr = "Incorrect upload format, make sure to submit an image. Course Information has not been submitted.";
			echo $imageErr;
		}
		
		$path= "../files/img/".$_FILES['uploadName']['name'] ;
		//if there are no errors in any of the input then....
		if($firstNameErr=="" && $lastNameErr=="" && $emailErr=="" && $imageErr=="" && $birthErr=="" ){
					$ftp_server = "php.nscctruro.ca";
					$ftp_username   = "w0245232";
					$ftp_password   =  "w0245232";
					
				$conn_id = ftp_connect($ftp_server) or die("could not connect to $ftp_server");
				//connected
				if(@ftp_login($conn_id, $ftp_username, $ftp_password)){
						//upload image
						ftp_put($conn_id, "../files/img/".$_FILES['uploadName']['name'], $_FILES['uploadName']['tmp_name'],FTP_ASCII);
							//confirmation details
						echo "<html><head><title>Student Course Tracker</title>
							<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\"></head><body>
							<h3>Course Information Confirmation:</h3> 
							<form method=\"POST\" action=\"finalPage.php\" ENCTYPE=\"multipart/form-data\">
							<b>Student First Name: </b>". $_POST['first_name'] ."<br/>
							<b>Student Last Name: </b>". $_POST['last_name'] . "<br/>
							<b>Student Email: </b>". $_POST['email']. "<br/>
							<b>Student Birthdate: </b>". $_POST['birth']. "<br/>
							<b>Course #1 : </b>". $_POST['selectCourse1']. "<br/>
							<b>Course #2 : </b>". $_POST['selectCourse2']. "<br/>
							<b>Course #3 : </b>". $_POST['selectCourse3']. "<br/>
							<b>Course #4 : </b>". $_POST['selectCourse4']. "<br/>
							<img src=../files/img/".$_FILES['uploadName']['name']."><br/>
							<input type=\"hidden\" name=\"first_name\" value='". $_POST['first_name'] ."'>
							<input type=\"hidden\" name=\"last_name\" value='". $_POST['last_name'] ."'>
							<input type=\"hidden\" name=\"email\" value='". $_POST['email'] ."'>
							<input type=\"hidden\" name=\"birth\" value='". $_POST['birth'] ."'>
							<input type=\"hidden\" name=\"selectCourse1\" value='". $_POST['selectCourse1'] ."'>
							<input type=\"hidden\" name=\"selectCourse2\" value='". $_POST['selectCourse2'] ."'>
							<input type=\"hidden\" name=\"selectCourse3\" value='". $_POST['selectCourse3'] ."'>
							<input type=\"hidden\" name=\"selectCourse4\" value='". $_POST['selectCourse4'] ."'>
							<input type=\"hidden\" name=\"uploadName\" value='". $path ."'>			
								<p><input type=\"submit\" name=\"submit\" class=\"buttons\" value=\"Confirm\"></p></body></html>";		
				}else {
					  //echo error message for no connection
					  echo "Could not connect as $ftp_username\n";
					  
					  }
				}
?>