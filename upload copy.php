<?php
session_start();
// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
$sharedu = $_POST['shared-user'];
//if upload is pressed
if (isset($_POST['upload'])){
	// Get the username and make sure it is valid
	$username = $_SESSION['currentUser'];
	if( !preg_match('/^[\w_\-]+$/', $username) ){
		echo "Invalid username";
		exit;
	}
	// $full_path = sprintf("/home/sorayamoss/userfiles/", $username, $filename);
	$full_path = "/home/sorayamoss/userfiles/" . $username . "/" . $filename;
	if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
		header("Location: users.php");
		exit;
	}else{
		exit;
	}
}



//if share is pressed
else{
	//checks to see if shared username is valid
	if( !preg_match('/^[\w_\-]+$/', $sharedu) ){
		echo "Invalid username";
		exit;
	}
	//checks to see if username inputted by user is a valid one to share
	//open text files with usernames
	$h = fopen("/home/sorayamoss/text/users.txt", "r");
	//start at line 1
	$linenum = 1;
	//go untill end
	while( !feof($h) ){
	//increment line number
			$linenum++;
			//add next user to user in
			$userInSys= trim(fgets($h));
		if($userInSys==$sharedu){

			// $full_path = sprintf("/home/sorayamoss/userfiles/", $username, $filename);
			$full_path = "/home/sorayamoss/userfiles/" . $sharedu . "/" . $filename;
			if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
				header("Location: users.php");
				exit;
			}
			exit;
		}
	}
	fclose($h);
	echo "Share Failed. Invalid Username Entered";
}

?>
