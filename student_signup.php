<?php
session_start();
if(!empty($_POST['roll_no']) && !empty($_POST['user']) && !empty($_POST['pass'])  && !empty($_POST['Mobile_no'])  && !empty($_POST['cgpa']) && !empty($_POST['email']) && !empty($_POST['gender']) && !empty($_POST['year']) && !empty($_POST['program']) &&  !empty($_POST['branch']) && !empty($_FILES['file']) && !empty($_SESSION['h']) && $_POST['hide'] == $_SESSION['h'] ) { 

    $_SESSION['h']=25; 
    $roll_no=$_POST['roll_no'];
    $user=$_POST['user'];  
    $pass=$_POST['pass']; 
    $Mobile_no=($_POST['Mobile_no']);
    $cgpa=$_POST['cgpa'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $year=$_POST['year'];
    $program=$_POST['program'];
    $branch=$_POST['branch'];
     $dbhost="localhost";
     $dbuser="root";
     $dbpass="";
     $db="placement";
    

   $fileName=$_FILES['file']['name'];
   $fileName2=substr($fileName,0,10);
   $pattern=$roll_no;
   /*echo preg_match($pattern,$fileName2);*/
   if(strcmp($pattern,$fileName2)==0){
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
           $fileDestination='upload/'.$fileName;
           move_uploaded_file($fileTmpName,$fileDestination);
           /*echo "<script type='text/javascript'> alert('succcessfully updated');window.location="";</script>";
          header('Location:#');*/

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
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
   if($conn->connect_error)
   {
    die("connection failed: %s\n".$conn->connect_error);
   }
   $sql = "SELECT Username FROM present_year_students where Username='".$user."' ";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {

   $sql= "INSERT INTO present_year_students (Roll_no,Username,Password,Mobile_no,Cgpa,email_id,Program,Branch,Gender,Passing_year)  VALUES('$roll_no','$user','$pass','$Mobile_no','$cgpa','$email','$program','$branch','$gender','$year')";
   if($conn->query($sql)==true)
   {
     
    $_SESSION['user3']=$_POST['user'];
    $_SESSION['user3']="";
    echo '<script type="text/javascript">';
    echo 'alert("Account created successfully");';
    echo 'window.location="student_login.php";';
    echo '</script>' ;  
     /*header("Location:student_login.php");*/
    }
    else {  
      echo "hai";
    /*echo "Failure!";*/  
    }  
  
    } 
    else {  
       echo '<script type="text/javascript">';
    echo 'alert("That username already exists! Please try again with another.")';
    echo '</script>' ;   
    }  
  
}

?>  
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    /*input:invalid {
  color: red;
}*/
#m2{
      background-color:#EAC8AF;
      border-radius:8px;
    }
</style>
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">
   <?php include'Header1.html' ?>
    <div class="row">
       <div class="col-md-4"></div>
       <div class="col-md-4" style="box-shadow:4px 4px 3px 4px gray;padding:35px;margin:35px">
       	<form class="form-sign-in" action="#" method="post" enctype="multipart/form-data">
       		<h3 class="form-signin-heading" style="text-align:center;">Student Signup</h3></br>
          <input type="text" class="form-control" name="roll_no" placeholder="Roll number" oninvalid="alert('Please enter exact roll number of yours in capital letters');" pattern="^\d{2}.[00][1|5]['A'|'D'|'E'|'F'][00|01|02|03|04|05|06|07|08|10|11|12|13|15|19|21|22|23|38|57|58].\d{2}$"  maxlength="10"  required></br><!-- alert~= setCustomValidity -->
       		<input type="text" class="form-control" name="user" placeholder="username" required></br>
       		<input type="password" class="form-control" name="pass" placeholder="Enter passsord" required></br>
          <input type="number" class="form-control" name="Mobile_no" placeholder="Phone number" pattern="\d{10}" required> </br>
          <input type="number" class="form-control" name="cgpa" placeholder="CGPA" min="0.00" max="10.00" maxlength="4" step="0.01" required></br>
          <input type="email" class="form-control" name="email" placeholder="Email id" required></br>
          <select class="form-control" name="gender" required><option>Male</option><option>Female</option></select></br>
          <select class="form-control" name="year" required><option value="" disabled selected hidden>Passed_Out_Year</option><option>2022</option></select></br>
          <select class="form-control" name="program" required><option>BTech</option><option>MTech</option><option>BPharm</option><option>MPharm</option><option>MSIT</option><option>MCA</option><option>MBA</option></select></br>
          <select class="form-control" name="branch" required><option>CSE</option><option>EEE</option><option>ECE</option><option>MECH</option><option>CIVIL</option><option>CHE</option><option>PA</option><option>DS</option><option>CS</option><option>ICE</option><option>AMS</option><option>IT</option><option>AI</option><option>CAD(CSE)</option><option>CSM</option><option>EAM</option><option>ES</option><option>NT</option><option>PED</option><option>PS</option><option>PD</option><option>RAC</option><option>RE</option><option>DECS</option><option>PID</option><option>SE(CIVIL)</option><option>VLSI</option><option>SE</option><option>DSCE</option><option>Null</option></select></br>
          <input type="hidden" name="hide" id="hide" value="<?php  $_SESSION['h']=rand(1,100); echo $_SESSION['h']; ?>" ></br>
          <input type="file" name="file" required>(Resume should be saved with your rollnumber in capitals and file should be in pdf format of maximum size 5MB )<br>
          &nbsp
       		<input type="submit" class="btn btn-info  btn-block" value="Register"></br><br>
          <p style="text-align:left;color:blue">Already have a account?&nbsp<a href='student_login.php' style="color:blue">Log in</a></p>
       	</form>
       </div>
       <div class="col-md-4">
       </div>
    </div>
    <?php include'footer.html' ?>
</body>
</html>