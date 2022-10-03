<?php 
session_start();

if(!empty($_POST['user'])&&!empty($_POST['status']) && !empty($_SESSION['user1']))
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
    
$sql = "UPDATE present_year_students SET Status = '".$_POST['status']."' WHERE Roll_no ='".$_POST['user']."'  ";
if ($conn->query($sql) === TRUE) {
  echo '<script type="text/javascript">';
    echo 'alert("Status updated successfully");';
    echo 'window.location="";';
    echo '</script>' ; 
    /*header('Location:student_details.php');*/
} else {
    echo "Error updating record: " . $conn->error;
}   
}


else
{

if(!empty($_SESSION['user1']))
{

  echo '
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
    #m4{
      background-color:#EAC8AF;
      border-radius:8px;
    }
	</style>
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">';
  include'Header1.html';
    echo '<br><div class="row" style="margin-bottom:130px;">
       <div class="col-md-4">
       </div>
       <div class="col-md-4">
       	<form class="form-sign-in" action="#" method="post" >
       		<h3 class="form-signin-heading" style="text-align:center;">Update status</h3></br>
       		<input type="text" class="form-control" name="user" placeholder="enter the Roll number" ></br>
          <select class="form-control" name="status"><option value="Yes">Placed</option><option value="No">Not placed</option></select><br>
          
       		<input type="submit" class="btn btn-primary btn-block" value="submit"></br>
       	</form>
        <div class="row">
            <div class="col-md-4">
            <p style="text-align:left;font-size:20px"><a href="logout.php" style="color:red"> Logout </a></p></div>
            <div class="col-md-4"></div>
            <div class="col-md-4"><form class="container">
        <a href="generate_pdf.php"><input type="button" style="border:none;color:red;font-size:20px" value="Go back!"></a>
      </form></div>
          </div>
                
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