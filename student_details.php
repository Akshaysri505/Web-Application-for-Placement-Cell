<?php session_start() ?>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		.hai{
			text-align:right;
		}
    #m2{
      background-color:#EAC8AF;
      border-radius:8px;
    }
	</style>
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">
  <?php include('Header1.html') ?>
<?php
if(!empty($_SESSION['user']))
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
$sql = "SELECT * FROM present_year_students where Username='".$_SESSION['user']."' " ;
$result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
       
        $_SESSION['Roll_no']=$row['Roll_no'];
        $_SESSION['Password']=$row['Password'];
        $_SESSION['Mobile_no']=$row['Mobile_no'];
        $_SESSION['Cgpa']=$row['Cgpa'];
        $_SESSION['email_id']=$row['email_id'];
        $_SESSION['Program']=$row['Program'];
        $_SESSION['Branch']=$row['Branch'];
        $_SESSION['Gender']=$row['Gender'];
        $_SESSION['Passing_year']=$row['Passing_year'];
        
        echo "<br>";
       echo "<div class='row '><div class='col-md-4 hai'>Roll Number :</div><div class='col-md-4'>".$row['Roll_no']."</div><div class='col-md-4'></div> </div><br>"; 
       echo "<div class='row '><div class='col-md-4 hai'>Name :</div><div class='col-md-4'>".$_SESSION['user']."</div><div class='col-md-4'></div> </div><br>"; 
       echo "<div class='row '><div class='col-md-4 hai'>Mobile Number :</div><div class='col-md-4'>".$row['Mobile_no']."</div><div class='col-md-4'></div> </div><br>";
       echo "<div class='row '><div class='col-md-4 hai'>CGPA :</div><div class='col-md-4'>".$row['Cgpa']."</div><div class='col-md-4'></div> </div><br>";
       echo "<div class='row '><div class='col-md-4 hai'>Email id :</div><div class='col-md-4'>".$row['email_id']."</div><div class='col-md-4'></div> </div><br>";
       echo "<div class='row '><div class='col-md-4 hai'>Program :</div><div class='col-md-4'>".$row['Program']."</div><div class='col-md-4'></div> </div><br>";
       echo "<div class='row '><div class='col-md-4 hai'>Branch :</div><div class='col-md-4'>".$row['Branch']."</div><div class='col-md-4'></div> </div><br>";
       echo "<div class='row '><div class='col-md-4 hai'>Gender :</div><div class='col-md-4'>".$row['Gender']."</div><div class='col-md-4'></div> </div><br>";
       echo "<div class='row '><div class='col-md-4 hai'>Passing Year :</div><div class='col-md-4'>".$row['Passing_year']."</div><div class='col-md-4'></div> </div><br>";
        echo "<div class='row '><div class='col-md-4 hai'>Resume :</div><div class='col-md-4'><a href='upload/$row[Roll_no].pdf' target='_blank'>".$row['Roll_no']."</a></div><div class='col-md-4'></div> </div><br>";
       echo "<div class='row '><div class='col-md-4 hai'></div><div class='col-md-4'> <a href='edit.php'><button style='background-color:#33b5e5;color:#fff;border:none;padding:10px 10px;border-radius:5px;'>edit</button></a></div><div class='col-md-4'> <a href='update_password.php'><button style='border:none;padding:10px 10px;border-radius: 5px;background-color:skyblue'>Update Password</button></a></div> </div><br>"; 
        echo "<div class='row '><div class='col-md-4 hai'></div><div class='col-md-4'> <a href='logout.php'><button style='border:none;padding:10px 10px;border-radius: 5px;background-color:skyblue'>Logout</button></a></div><div class='col-md-4'></div> </div><br>"; 
           }
           
}
else
{

  header('Location:Student_login.php');
}
?>

  <?php include'footer.html' ?>
</body>
</html>