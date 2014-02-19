<?		

		//confirmation details
		$msg= "<html>
		<head>
				<title>Student Course Tracker</title>
				<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\">
		</head>
		<body>
		<h3>Course Information Added!</h3> 
		</form>
			  <b>Student First Name: </b>". $_POST['first_name'] ."<br/>
			  <b>Student Last Name: </b>". $_POST['last_name'] . "<br/>
			  <b>Student Email: </b>". $_POST['email']. "<br/>
			  <b>Student Birthdate: </b>". $_POST['birth']. "<br/>
			  <b>Course #1 : </b>". $_POST['selectCourse1']. "<br/>
			  <b>Course #2 : </b>". $_POST['selectCourse2']. "<br/>
			  <b>Course #3 : </b>". $_POST['selectCourse3']. "<br/>
			  <b>Course #4 : </b>". $_POST['selectCourse4']. "<br/>
			  <img src=". $_POST['uploadName']. "><br/>
		</body>
		</html>";
			
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
							fclose($myfile);
							$n=4;
						}
					}
				}
				
							//email student course details
							$to = "mcnuttpaulaj@gmail.com";
							$subject = "Student Course Tracker Information- $_POST[first_name]  $_POST[last_name]";
							$mailheaders = "From:it.nscctruro.ca <webmaster@nscctruro.ca>\n";
							$mailheaders .= "Cc: $_POST[email]\n";
							$mailheaders .= "Reply-To: $_POST[email]\n";
							$mailheaders .= "MIME-Version: 1.0\r\n";
							$mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							//send the mail
							mail($to, $subject, $msg, $mailheaders);
		

  echo"<a href=\"phpAssignment.php\">Add Another Student's Information</a>";

  echo "$msg";

?>