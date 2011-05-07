<html>
<head>
<?php
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);

include("CalToDb.php");

if (isset($_POST["buttonClicked"]))
{
 $target = "upload/"; 
 $target = $target . uniqid(); 
 $ok=1; 
 
 $uploaded_size = $_FILES['uploaded']['size'];
 //This is our size condition 
 if ($uploaded_size > 350000) 
 { 
 $msg = "Your file is too large.<br>"; 
 $ok=0; 
 } 
 
 $uploaded_type = $_FILES['uploaded']['type'];
 //This is our limit file type condition 
 if ($uploaded_type !="text/calendar") 
 { 
 $msg = "Only ics files allowed!<br>"; 
 $ok=0; 
 } 
 
 //Here we check that $ok was not set to 0 by an error 
 if ($ok==0) 
 { 
 $msg = "Sorry your file was not uploaded"; 
 } 
 
 //If everything is ok we try to upload it 
 else 
 { 
 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
 { 
 $msg = "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded"; 
 
 //Success!
 insertIntoDb($target);
 
 unlink($target);
 
 } 
 else 
 { 
 $msg = "Sorry, there was a problem uploading your file."; 
 } 
 } 
}

?>

</head>
<body>
 <form enctype="multipart/form-data" action="uploadCal.php" method="POST">
 Please choose a file: <input name="uploaded" type="file" /><br />
 <input type="submit" name="buttonClicked" value="Upload" />
 </form> 
 <?php
 	//echo $uploaded_size;
 	//echo $uploaded_type;
 	echo $target;
 	echo $msg;
 ?>
</body>
</html>