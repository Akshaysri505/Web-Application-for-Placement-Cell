<?php 
session_start();
if( !empty($_POST['cname']) &&  !empty($_POST['username']) && !empty($_POST['pass'])  && !empty($_SESSION['user1'])) {  
    $cname=$_POST['cname'];
    $user=$_POST['username'];  
    $pass=$_POST['pass']; 
    
     $dbhost="localhost";
     $dbuser="root";
     $dbpass="";
     $db="placement";
    

    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
   if($conn->connect_error)
   {
    die("connection failed: %s\n".$conn->connect_error);
   }
   $sql = "SELECT * FROM company where username='".$user."' or company_name='".$cname."' ";
    $result = $conn->query($sql);
    if ($result->num_rows == 0)
     {

   $sql= "INSERT INTO company VALUES('$cname','$user','$pass')";
   if($conn->query($sql)==true)
   {
     echo '<script type="text/javascript">';
    echo 'alert("Account created successfully");';
    echo 'window.location="";';
    echo '</script>' ;  
     /*header("Location:generate_pdf.php");*/
    }
      
  
    } 
    else {  
       echo '<script type="text/javascript">';
    echo 'alert("That username/company name already exists! Please try again with another.");';
    echo 'window.location="";';
    echo '</script>' ;   
    }  
  
}


else
{

if(!empty($_SESSION['user1']))
{
echo '<html>
<head>
	<link type="text/css" href="css/bootstrap.css">
	<style>
		#m4{
			background-color:#EAC8AF;
			border-radius:8px;
		}
	</style>
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">';
    include'Header1.html';
    echo '<div class="row">
       <div class="col-md-4"></div>
       <div class="col-md-4" style="padding:35px;margin:30px">
       	<form class="form-sign-in" action="#" method="post" enctype="multipart/form-data">
       		<h3 class="form-signin-heading" style="text-align:center;padding-bottom:35px;">Company credentials</h3>
       		<input type="text" class="form-control" name="cname" placeholder="Company Name" required></br>
       		<input type="text" class="form-control" name="username" placeholder="Username" required></br>
       		<input type="password" class="form-control" name="pass" placeholder="Enter passsord" required></br>
       		<input type="submit" class="btn btn-info  btn-block" value="Submit"></br>
            <div class="row">
            <div class="col-md-4">
            <p style="text-align:left;font-size:20px"><a href="logout.php" style="color:red"> Logout </a></p></div>
            <div class="col-md-4"></div>
            <div class="col-md-4"><form class="container">
        <a href="generate_pdf.php"><input type="button" style="border:none;color:red;font-size:20px" value="Go back!" ></a>
      </form></div>
          </div>
       	</form>
       </div>
       <div class="col-md-4">
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