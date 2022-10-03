<?php
session_start();
if(!empty($_POST['pass1']) && !empty($_POST['pass2'])  && $_POST['pass1']==$_POST['pass2'] && !empty($_SESSION['user']))
{
	
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];

    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="placement";
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
    if($conn->connect_error)
    {
    die("connection failed: %s\n".$conn->connect_error);
    }
    $sql = " UPDATE present_year_students SET Password = '".$pass1."' where Username = '".$_SESSION['user']."' ";
    if ($conn->query($sql) === TRUE) {

    	echo '<script>';
       	echo "alert('Password is updated successfulyy');";
       	echo "window.location='student_login.php';";
       	echo "</script>";


        /*header('Location:student_login.php');*/

	} else {
    echo "Error updating record: " . $conn->error;
	}   

}

else
{
if(!empty($_SESSION['user']))
{
echo '<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<style>
		#m2{
      background-color:#EAC8AF;
      border-radius:8px;
    }
	</style>
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">';
	include('Header1.html');
	echo '<div class="row">

		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<br>
			<form action="#" method="post" class="form-sign-in">
				<h3 class="form-signin-heading" style="text-align:center;">Update Password</h3>
				<input class="form-control" type="password" name="pass1" required placeholder="enter new password"><br>
				<input class="form-control" type="password" name="pass2" required placeholder="Reenter new password"><br>
				<input type="submit" value="submit" class="btn btn-block btn-secondary"><br>&nbsp
				
			</form>

		</div>
		<div class="col-md-4" >


		</div>


	</div>';
	include('footer.html');
echo '</body>
</html>';
}

else
{
	header('Location:index.php');
}

}

?>