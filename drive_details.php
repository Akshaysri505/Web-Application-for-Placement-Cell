<?php
session_start();
if(!empty($_POST['cname'])  && isset($_POST['submit']) && isset($_FILES['file']) && !empty($_SESSION['user2']) ){

   /*error_reporting(E_ERROR | E_PARSE);*/
   $fileName=$_FILES['file']['name'];
   /*$fileName2=substr($fileName,0,10);
   $pattern="/[0-9A-Z]{10}/";
   echo preg_match($pattern,$fileName2);
   if(preg_match($pattern,$fileName2)){*/
   $fileTmpName=$_FILES['file']['tmp_name'];
   $fileSize=$_FILES['file']['size'];
   $fileError=$_FILES['file']['error'];
   $fileType=$_FILES['file']['type'];


   $fileExt=explode('.', $fileName);
   $fileActualExt=strtolower(end($fileExt));


   $allowed=array('pdf');

   if(in_array($fileActualExt, $allowed)){

    if($fileError === 0){

       if($fileSize< 80000000 )/* it is specified in bytes */
       {
           $fileNameNew=$_POST['cname'].' '.$fileName;
           $fileDestination='notice-board/'.$fileName;
           move_uploaded_file($fileTmpName,$fileDestination);
           echo '<script type ="text/JavaScript">';
           echo 'alert("successfully submitted");';
           echo 'window.location="";';
           echo '</script>';
           /*header('Location:#');*/

       }
       else
       {
       	echo '<script type ="text/JavaScript">';
       	echo 'alert("your file is too big!")';
       	echo '</script>';  
       }
    }
    else
    {
    	echo '<script type ="text/JavaScript">';
    	echo 'alert("there was an error in uploading file!")';
    	echo '</script>';  
    }

   }
   else
   {
   	echo '<script type ="text/JavaScript">';
   	echo 'alert("you cannot upload files of this type!")';
   	echo '</script>';  
   }
  /*}
  else
  {
    echo '<script type ="text/JavaScript">';
    	echo 'alert("Make sure the file name as per the guidelines!")';
    	echo '</script>';	
  }*/

}
else
{
  if(!empty($_SESSION['user2']))
  {
  echo "<html>";
  echo "<head>";
  echo '<link rel="stylesheet" href="css/bootstrap.css">';
  echo "<style> #m3{   background-color:#EAC8AF;  border-radius:8px;  } </style></head>";
echo '<body style="background-color: #F5F3EE;overflow-x:hidden;>'; 
  include'Header1.html';
   echo '<div class="row" style="margin-bottom:4px;"><div class="col-md-4"></div><div class="col-md-4" style="box-shadow:3px 3px 3px 3px gray;padding:35px;margin:35px"><form class="form-sign-in" action="#" method="post" enctype="multipart/form-data"> <h3 class="form-signin-heading" style="text-align:center;">Upload Drive Details</h3></br><input type="text" class="form-control" name="cname" placeholder="Company Name" required autofocus></br><input type="file"   name="file" placeholder="Resume " required>file should be in pdf format of maximum size 5MB<br> &nbsp<input type="submit" class="btn btn-info  btn-block" value="Submit" name="submit"></br><br>&nbsp<div class="row"><div class="col-md-6"><a href="logout.php" style="color:blue">Logout</a></div><div class="col-md-6"><a href="get_data.php" style="color:blue">Student details</a></div></div></form> </div>
       <div class="col-md-4"></div></div>';
   include'footer.html' ;
   echo '</body></html>;';
 }
 else
 {
  header('Location:index.php');
 }
}
?>
