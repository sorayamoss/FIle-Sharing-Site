<?php
//start session
session_start();
//declare username info
$user = $_GET["Username"];

// checks to see if username is valid, has only alphanumeric characters
if( !preg_match('/^[\w_\-]+$/', $user) ){
	echo "Invalid username";
	exit;
}
else{
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
  if($userInSys==$user){
    //sets up current user as inputted user
		$_SESSION["currentUser"] = $user;
    $link= $user . ".php";
    //redirect user to their page
    header("Location:  users.php");
    exit;
  }
}
// closes file being read
fclose($h);
//if user reaches this point, has entered not valid username
echo "Invalid Username";
}
?>
