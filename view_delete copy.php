<?php
session_start();
$filename = $_POST['selected_file'];
$username = $_SESSION['currentUser'];
//$filename = basename($_FILES['selected']['name']);

if (isset($_POST['view_button'])){

// Get the username and make sure that it is alphanumeric with limited other characters.
// You shouldn't allow usernames with unusual characters anyway, but it's always best to perform a sanity check
// since we will be concatenating the string to load files from the filesystem.
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}
$full_path = "/home/sorayamoss/userfiles/" . $username . "/" . $filename;
// Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);
//if content is not a txt file, image, or pdf
echo $mime;
// Finally, set the Content-Type header to the MIME type of the file, and display the file.
header("Content-Type: ".$mime);
readfile($full_path);
}




// sets up delete button
if (isset($_POST['delete_button'])){
  $path = "/home/sorayamoss/userfiles/" . $username . "/" . $filename;
  if (unlink($path)){
    header("Location: users.php");
  }
  else{
    echo "fail";
  }
}
?>
