<?php 
session_start();

if(!empty($_POST['user'])&&!empty($_POST['Mobile']) &&!empty($_POST['cgpa']) && !empty($_POST['email']) && !empty($_POST['program']) && !empty($_POST['branch']) && !empty($_POST['gender']) && !empty($_POST['passing'])  && !empty($_SESSION['user']))
{
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="placement";
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
    if($conn->connect_error)
    {
    die("connection failed: %s\n".$conn->connect_error);
    }
    if(!empty($_POST['file']))
    {
    $file=$_FILES['file'];
    
   $fileName=$_FILES['file']['name'];
   $fileName2=substr($fileName,0,10);
   $pattern=$_POST['roll_no'];
   /*echo preg_match($pattern,$fileName2);*/
   if(preg_match($pattern,$fileName2)){
   $fileTmpName=$_FILES['file']['tmp_name'];
   $fileSize=$_FILES['file']['size'];
   $fileError=$_FILES['file']['error'];
   $fileType=$_FILES['file']['type'];


   $fileExt=explode('.', $fileName);
   $fileActualExt=strtolower(end($fileExt));


   $allowed=array('pdf');

   if(in_array($fileActualExt, $allowed)){

    if($fileError === 0){

       if($fileSize< 500000)
       {
           $fileNameNew=$fileName.".".$fileActualExt;
           $fileDestination='upload/'.$fileNameNew;
           move_uploaded_file($fileTmpName,$fileDestination);
           header('Location:#');

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
  }
  else
  {
    echo '<script type ="text/JavaScript">';
      echo 'alert("Make sure the file name as per the guidelines!")';
      echo '</script>'; 
  }
}
$sql = "UPDATE present_year_students SET Username = '".$_POST['user']."' , Mobile_no = '".$_POST['Mobile']."', Cgpa='".$_POST['cgpa']."' , email_id='".$_POST['email']."' , Program='".$_POST['program']."' , Branch='".$_POST['branch']."',Gender='".$_POST['gender']."', Passing_year='".$_POST['passing']."' WHERE Roll_no='".$_POST['id']."' ";
if ($conn->query($sql) === TRUE) {
  echo '<script type="text/javascript">';
    echo 'alert("Details updated successfully");';
    echo 'window.location="student_details.php";';
    echo '</script>' ; 
    /*header('Location:student_details.php');*/
} else {
    echo "Error updating record: " . $conn->error;
}   
}


else
{

if(!empty($_SESSION['user']))
{

  echo '
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
    #m2{
      background-color:#EAC8AF;
      border-radius:8px;
    }
	</style>
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">';
  include'Header1.html';
    echo '<div class="row">
       <div class="col-md-4">
       </div>
       <div class="col-md-4">
       	<form class="form-sign-in" action="#" method="post" enctype="multipart/form-data">
       		<h3 class="form-signin-heading" style="text-align:center;">Edit Details</h3></br>';
       		echo '<input type="text" class="form-control" name="id" value='; echo $_SESSION['Roll_no']; echo ' readonly ></br>';
          echo  '<input type="text" class="form-control" name="user" value='; echo $_SESSION['user']; echo '></br>';
          echo  '<input type="text" class="form-control" name="Mobile" value='; echo $_SESSION['Mobile_no']; echo '></br>';
          echo  '<input type="text" class="form-control" name="cgpa" value='; echo $_SESSION['Cgpa']; echo '></br>';
          echo  '<input type="text" class="form-control" name="email" value='; echo $_SESSION['email_id']; echo '></br>';
          echo  '<input type="text" class="form-control" name="program" value='; echo $_SESSION['Program']; echo '></br>';
          echo  '<input type="text" class="form-control" name="branch" value='; echo $_SESSION['Branch']; echo '></br>';
          echo  '<input type="text" class="form-control" name="gender" value='; echo $_SESSION['Gender']; echo '></br>';
          echo  '<input type="text" class="form-control" name="passing" value='; echo $_SESSION['Passing_year']; echo '></br>';
          echo  "Resume : <a href='upload/$_SESSION[Roll_no].pdf'>"; echo $_SESSION["Roll_no"]."<br><br>"; echo"</a>";
          echo  '<input type="file" name="file" placeholder="Resume " value="new" >Upload new resume(if needed)<br>';
          echo '&nbsp
       		<input type="submit" class="btn btn-primary btn-block" value="submit"></br>
       	</form>
                <br> <a href="logout.php"><button style="background-color:#33b5e5;color:#fff;border:none;padding:10px 10px;border-radius:5px;"">Logout</button></a>
       </div>
       <div class="col=md=4">
       </div>
    </div>';
    include'footer.html';
echo '</body>
</html>';
}

else
{
  header('Location:index.php');
}

}


?>