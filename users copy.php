<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<title>Users</title>
  <!-- linking fontawesome -->
  <script src="https://use.fontawesome.com/89281ccf9c.js"></script>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
  <div class="center-text">
  <?php
  // begin the session for the username
  session_start();
  // if user does not enter anything, or returns to the page using "back", invalid
  if($_SESSION["currentUser"]==null){
  header("Location:  invalid.html");
  }
  //welcomes the user
  echo "Welcome,  " . htmlentities($_SESSION["currentUser"]) . "!";
  ?>
<!-- //upload form -->
   <form class="users" enctype="multipart/form-data" action="upload.php" method="POST">
	<p>
    <!-- defines file size -->
		<input class="users" type="hidden" name="MAX_FILE_SIZE" value="20000000" />
    <!-- browse computer for file to upload -->
		<label class="users" for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
	</p>
  <p>
    <!-- submit button to upload file -->
		<input class="users" name="upload" type="submit" value="Upload File" />
	</p>
  <p>
    <!-- input  for sharing button and username to be shared with -->
    <label class="users" for="shared-user">Insert Username:</label>
    <input class="users" name="shared-user" type="text" id="shared-user"/>
    <input class="users" name="share" type="submit" value="Share"/>
  </p>
</form>
Your current files:<br>
<?php
//find exact directory for current user
$dir = "/home/sorayamoss/userfiles/" . $_SESSION["currentUser"];
// takes in files as array and takes out first 2 elements . and ..
//$files = array_diff( scandir($dir), array(".", "..") );
$files = scandir($dir);
echo '<form class="users" name="input" enctype="multipart/form-data" action="view_delete.php" method= "POST">';
//loop through array
for($i=2; $i<count($files); $i++){
  // form to select file and to select to view or delete
    echo '<div class="files">';
    echo htmlentities("$files[$i]");
    echo ": ";
    echo '<input name="selected_file" type="radio" value="'.htmlentities($files[$i]).'"/>';
    echo '</div>';
}
echo '<input name="view_button" type="submit" value="View" />';
echo '<input name="delete_button" type="submit" value="Delete"/>';
echo '</form>';
// end of file selection form
?>

<!-- log out button -->
<form class="users" name="input" action="logout.php">
  <input name="logout" type="submit" value="Log out"/>
</form>
</div>
</body>
</html>
