<?php
session_start();

$filename = $_POST['selected_file'];
$username = $_SESSION['currentUser'];

$sharedu = $_POST["shared-user"];
// Get the filename and make sure it is valid

$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}
// Get the username and make sure it is valid3
$username = $_SESSION['currentUser'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

//checks to see if username inputted by user is a valid one to share
//open text files with usernames
$h = fopen("users.txt", "r");
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
echo "Share Failed. Invalid Username Entered"


?>
