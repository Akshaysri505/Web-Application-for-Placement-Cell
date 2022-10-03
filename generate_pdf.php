

<?php

session_start();
require('fpdf183/fpdf.php');
$pdf=new FPDF('L', 'mm','Legal');
$pdf->AliasNbPages();
$pdf->AddPage();      
$pdf->SetFont('Arial','B',16);
$fontsize=16;    
if(!empty($_POST['filter1']) && !empty($_POST['filter2'] && !empty($_SESSION['user1'])) ) 
{ 

  
    $filter1=$_POST['filter1'];  
    $filter2=$_POST['filter2'];  
    $filter3=$_POST['filter3'];
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="placement";
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
    if($conn->connect_error)
    {
    die("connection failed: %s\n".$conn->connect_error);
    }
    

    if($filter1=='Department')
    {
        $sql="select  `Roll_no`, `Name`, `Gender`, `Mobile_no`, `Year`, `Company`, `Program`, `Branch` from student where Branch='".$filter2."' ";
    }
    else if($filter1=='year')
    {

        $sql="select  `Roll_no`, `Name`, `Gender`, `Mobile_no`, `Year`, `Company`, `Program`, `Branch` from student where Year='".$filter2."' ";
        
    }
    else if($filter1=='gender')
    {
        $sql="select  `Roll_no`, `Name`, `Gender`, `Mobile_no`, `Year`, `Company`, `Program`, `Branch` from student where Gender='".$filter2."' ";
    }
    else if($filter1=='Program')
    {
        $sql="select  `Roll_no`, `Name`, `Gender`, `Mobile_no`, `Year`, `Company`, `Program`, `Branch` from student where Program='".$filter2."' ";
    }
    else if($filter1=='Company-wise')
    {
        $sql="select  `Roll_no`, `Name`, `Gender`, `Mobile_no`, `Year`, `Company`, `Program`, `Branch` from student where Company='".$filter2."' ";
    }
    else if($filter1=='total')
    {
        $sql="select  `Company`,Count(*) as co from student group by Company";
        $result = $conn->query($sql);

         if ($result->num_rows > 0 ) {
          $pdf->Cell(0,10,$filter1."-"."   Report ",0,0,'C');


          while ($row = $result->fetch_assoc() ) {

            $ff=$row['Company'];
        $sql1="select `Roll_no`, `Name`, `Gender`, `Mobile_no`, `Year`, `Program`, `Branch` from student where Company='".$ff."' order by Branch desc";

                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0 ) {

                      

                            $pdf->ln();
                            $pdf->ln();

                             $pdf->SetFont('Arial','B',14);  

                            $pdf->Cell(0,10,$ff." Company selected count :".$row['co'],0,0,'C');
                            $pdf->ln();
                            
                             $pdf->SetFont('Arial','B',12);   

 
                            $s=$pdf->GetStringwidth('        S.NO          ');    
                            $g=$pdf->GetStringWidth('        Female         ');
                            $r=$pdf->GetStringWidth('        17001A0507        ');
                            $n=$pdf->GetStringWidth('        aaaaaaaaaaaaaaaaaaaaaaaaaaa        ');
                            $m=$pdf->GetStringWidth('        9999999999         ');
                            $y=$pdf->GetStringWidth('        2018        ');
                            $p=$pdf->GetStringWidth('        Program        ');;
                            $b=$pdf->GetStringWidth('        Branch        ');;

                            $pdf->cell($s,10,"  S.NO  ",1,0,'C');
                            $pdf->cell($r,10,"  Student Id  ",1,0,'C');
                            $pdf->cell($n,10,"  Name  ",1,0,'C');
                            $pdf->cell($g,10,"  Gender  ",1,0,'C');
                            $pdf->cell($m,10,"  Phone no  ",1,0,'C');
                            $pdf->cell($y,10,"  Year  ",1,0,'C');
                            $pdf->cell($p,10,"  Program  ",1,0,'C');
                            $pdf->cell($b,10,"  Branch  ",1,0,'C');

                            $y2=1;

                      while ($row1 = $result1->fetch_assoc() ) {

                            
    $pdf->Ln();

    $pdf->Cell($s,10,$y2,1,0,'C');
       $y2=$y2+1;
        $pdf->SetFont('Arial','I',12);  

       if($row1['Roll_no']===NULL)
       { 
          $pdf->Cell($r,10,$row1['Roll_no'],1,0,'C'); 
       }
       else if($row1['Roll_no']!=NULL )
       {

            $pdf->Cell($r,10,$row1['Roll_no'],1,0,'C');        
       }
       if($row1['Name']===NULL)
       {
          $pdf->Cell($n,10,$row1['Name'],1,0,'C');
       }
       else if($row1['Name']!=NULL)
       {
          $pdf->Cell($n,10,$row1['Name'],1,0,'C');
       }
       if($row1['Gender']===NULL)
       {
          $pdf->Cell($g,10,$row1['Gender'],1,0,'C');
       }
       else if($row1['Gender']!=NULL)
       {
          $pdf->Cell($g,10,$row1['Gender'],1,0,'C');
       }
     
       if($row1['Mobile_no']===NULL)
       {
          $pdf->Cell($m,10,$row1['Mobile_no'],1,0,'C');
       }
       else if($row1['Mobile_no']!=NULL)
       {
          $pdf->Cell($m,10,$row1['Mobile_no'],1,0,'C');
       }
       if($row1['Year']===NULL)
       {
          $pdf->Cell($y,10,$row1['Year'],1,0,'C');
       }
       else if($row1['Year']!=NULL)
       {
          $pdf->Cell($y,10,$row1['Year'],1,0,'C');
       }
       if($row1['Program']===NULL)
       {
          $pdf->Cell($p,10,$row1['Program'],1,0,'C');
       }
       else if($row1['Program']!=NULL)
       {
          $pdf->Cell($p,10,$row1['Program'],1,0,'C');
       }
       if($row1['Branch']===NULL)
       {
          $pdf->Cell($b,10,$row1['Branch'],1,0,'C');
       }
       if($row1['Branch']!=NULL)
       {
          $pdf->Cell($b,10,$row1['Branch'],1,0,'C');
       }

                      }
                     

                    }

        }
         $pdf->output();

        }
        else
        {
          echo "no data to display as per company name";
        }


    }

    else if($filter1=='status')
    {
        $sql="select  `Roll_no`, `Username`, `Gender`, `Mobile_no`, `Cgpa`, `email_id`, `Program`, `Branch` from present_year_students where Status='".$filter2."' ";
        $result = $conn->query($sql);

    
    /*echo mysqli_num_rows($result);*/
    if ($result->num_rows > 0) {

    /*while($row = $result->fetch_assoc())  
    {  
        $pdf->Cell(0,10,$row['Roll_no'],1,1,'C'); 
     $pdf->Cell(10,20, $row['Name'] ,1,1,'C');
      $pdf->Cell(20,30, $row['Gender'],1,1,'C');
       $pdf->Cell(30,40,$row['Mobile_no'],1,1,'C');
        $pdf->Cell(40,50, $row['Year'],1,1,'C');
         $pdf->Cell(50,60, $row['Company'],1,1,'C');
          $pdf->Cell(60,70, $row['Program'],1,1,'C');
           $pdf->Cell(70,80,$row['Branch'],1,1,'C');  
    }  
    $pdf->Output();*/
  $pdf->Cell(0,10,$filter1."-".$filter2."   Report ",0,0,'C');

  $pdf->ln();
  $pdf->ln();
    $s=$pdf->GetStringwidth('S.NO');
    $g=$pdf->GetStringWidth('Female  ');
    $r=$pdf->GetStringWidth('17001A0507 ');
    $n=$pdf->GetStringWidth('aaaaaaaaaaaaaaaaaaaaaaaaaa ');
    $m=$pdf->GetStringWidth('9999999999 ');
    $c=$pdf->GetStringWidth('2018  ');
    $e=$pdf->GetStringWidth('aaaaaaaaaaaaaaaaaaaaaaaaaaaaa ');
    $p=$pdf->GetStringWidth('Program ');;
    $b=$pdf->GetStringWidth('Branch ');;

    $pdf->cell($s,10,"S.NO",1,0,'C');
    $pdf->cell($r,10,"Student Id",1,0,'C');
    $pdf->cell($n,10,"Name",1,0,'C');
    $pdf->cell($g,10,"Gender",1,0,'C');
    $pdf->cell($m,10,"Phone no",1,0,'C');
    $pdf->cell($c,10,"Cgpa",1,0,'C');
    $pdf->cell($e,10,"Email id",1,0,'C');
    $pdf->cell($p,10,"Program",1,0,'C');
    $pdf->cell($b,10,"Branch",1,0,'C');
    $y=1;
    while ($row = $result->fetch_assoc()) {
     


     
/*foreach($result as $row) {*/
    $pdf->SetFont('Arial','B',12);   
    $pdf->Ln();
       $pdf->Cell($s,10,$y,1,0,'C');
       $y=$y+1;
       if($row['Roll_no']!=NULL )
       {

            $pdf->Cell($r,10,$row['Roll_no'],1,0,'C');        
       }
       
       if($row['Username']!=NULL)
       {
          $pdf->Cell($n,10,$row['Username'],1,0,'C');
       }
       
       if($row['Gender']!=NULL)
       {
          $pdf->Cell($g,10,$row['Gender'],1,0,'C');
       }
       
       if($row['Mobile_no']!=NULL)
       {
          $pdf->Cell($m,10,$row['Mobile_no'],1,0,'C');
       }
       
       if($row['Cgpa']!=NULL)
       {
          $pdf->Cell($c,10,$row['Cgpa'],1,0,'C');
       }
       
       if($row['email_id']!=NULL)
       {
          $pdf->Cell($e,10,$row['email_id'],1,0,'C');
       }
       
       if($row['Program']!=NULL)
       {
          $pdf->Cell($p,10,$row['Program'],1,0,'C');
       }
       
       if($row['Branch']!=NULL)
       {
          $pdf->Cell($b,10,$row['Branch'],1,0,'C');
       }


  }
    $pdf->output();
    }
    else
    { 
      echo "<script>";
    echo "alert('There is no required data to display');";
    echo "window.close(-1)";
    echo "</script>"; 
    }  
  }
    
    $result = $conn->query($sql);
    
    /*echo mysqli_num_rows($result);*/
    if ($result->num_rows > 0) {

    /*while($row = $result->fetch_assoc())  
    {  
        $pdf->Cell(0,10,$row['Roll_no'],1,1,'C'); 
     $pdf->Cell(10,20, $row['Name'] ,1,1,'C');
      $pdf->Cell(20,30, $row['Gender'],1,1,'C');
       $pdf->Cell(30,40,$row['Mobile_no'],1,1,'C');
        $pdf->Cell(40,50, $row['Year'],1,1,'C');
         $pdf->Cell(50,60, $row['Company'],1,1,'C');
          $pdf->Cell(60,70, $row['Program'],1,1,'C');
           $pdf->Cell(70,80,$row['Branch'],1,1,'C');  
    }  
    $pdf->Output();*/
	$pdf->Cell(0,10,$filter1."-".$filter2."   Report ",0,0,'C');

	$pdf->ln();
	$pdf->ln();

    $s=$pdf->GetStringwidth('S.NO');    
    $g=$pdf->GetStringWidth('Female  ');
    $r=$pdf->GetStringWidth('17001A0507 ');
    $n=$pdf->GetStringWidth('aaaaaaaaaaaaaaaaaaaaaaaaaaa ');
    $m=$pdf->GetStringWidth('9999999999 ');
    $y=$pdf->GetStringWidth('2018  ');
    $c=$pdf->GetStringWidth('aaaaaaaaaaaaaaaaaaaaaaaaaaaaa ');
    $p=$pdf->GetStringWidth('Program ');;
    $b=$pdf->GetStringWidth('Branch ');;

    $pdf->cell($s,10,"S.NO",1,0,'C');
    $pdf->cell($r,10,"Student Id",1,0,'C');
    $pdf->cell($n,10,"Name",1,0,'C');
    $pdf->cell($g,10,"Gender",1,0,'C');
    $pdf->cell($m,10,"Phone no",1,0,'C');
    $pdf->cell($y,10,"Year",1,0,'C');
    $pdf->cell($c,10,"Company",1,0,'C');
    $pdf->cell($p,10,"Program",1,0,'C');
    $pdf->cell($b,10,"Branch",1,0,'C');
    $y1=1;
    while ($row = $result->fetch_assoc()) {
     



/*foreach($result as $row) {*/
    $pdf->SetFont('Arial','B',12);   
    $pdf->Ln();
    $pdf->Cell($s,10,$y1,1,0,'C');
       $y1=$y1+1;
       if($row['Roll_no']===NULL)
       { 
       	  $pdf->Cell($r,10,$row['Roll_no'],1,0,'C'); 
       }
       else if($row['Roll_no']!=NULL )
       {

            $pdf->Cell($r,10,$row['Roll_no'],1,0,'C');        
       }
       if($row['Name']===NULL)
       {
       		$pdf->Cell($n,10,$row['Name'],1,0,'C');
       }
       else if($row['Name']!=NULL)
       {
       		$pdf->Cell($n,10,$row['Name'],1,0,'C');
       }
       if($row['Gender']===NULL)
       {
       		$pdf->Cell($g,10,$row['Gender'],1,0,'C');
       }
       else if($row['Gender']!=NULL)
       {
       		$pdf->Cell($g,10,$row['Gender'],1,0,'C');
       }
     
       if($row['Mobile_no']===NULL)
       {
       		$pdf->Cell($m,10,$row['Mobile_no'],1,0,'C');
       }
       else if($row['Mobile_no']!=NULL)
       {
       		$pdf->Cell($m,10,$row['Mobile_no'],1,0,'C');
       }
       if($row['Year']===NULL)
       {
       		$pdf->Cell($y,10,$row['Year'],1,0,'C');
       }
       else if($row['Year']!=NULL)
       {
       		$pdf->Cell($y,10,$row['Year'],1,0,'C');
       }
       if($row['Company']===NULL)
       {
       		$pdf->Cell($c,10,$row['Company'],1,0,'C');
       }
       else if($row['Company']!=NULL)
       {
       		$pdf->Cell($c,10,$row['Company'],1,0,'C');
       }
       if($row['Program']===NULL)
       {
       		$pdf->Cell($p,10,$row['Program'],1,0,'C');
       }
       else if($row['Program']!=NULL)
       {
       		$pdf->Cell($p,10,$row['Program'],1,0,'C');
       }
       if($row['Branch']===NULL)
       {
       		$pdf->Cell($b,10,$row['Branch'],1,0,'C');
       }
       if($row['Branch']!=NULL)
       {
       		$pdf->Cell($b,10,$row['Branch'],1,0,'C');
       }


  }
    $pdf->output();
    } 
 
} 

else
{

if(!empty($_SESSION['user1']))
{


echo '<html>
<head>  
    <link rel="stylesheet" href="css/bootstrap.css">
    <style> #m4{ background-color:#EAC8AF;  border-radius:8px; </style>';
echo "<script>
  function filters()
  {
    if(document.getElementById('filter1').value=='year')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
      var select = document.getElementById('filter2');
      var op=[2016,2018,2019,2020];
      var values=['2016','2018','2019','2020','2021'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
    }
    if(document.getElementById('filter1').value=='Department')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
      var select = document.getElementById('filter2');
      var op=['CSE','ECE','EEE','MECH','CHE','CIVIL','MBA'];
      var values=['CSE','ECE','EEE','ME','CHE','CIVIL','MBA'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
    }
    if(document.getElementById('filter1').value=='gender')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
      var select = document.getElementById('filter2');
      var op=['Male','Female'];
      var values=['Male','Female'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i],values[i],false,false);
      }
    }
    if(document.getElementById('filter1').value=='Program')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
      var select = document.getElementById('filter2');
      var op=['Btech/UG','Mtech/PG','MBA',''];
      var values=['BTech','MTech','MBA','MCA'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
    }
    if(document.getElementById('filter1').value=='Cgpa')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
       var select= document.getElementById('filter2');
       var op=['>6.0','>6.5','>7.0','>7.5','>8.0','>8.5','>9.0','>9.5','10.0'];
       var values=['6.0','6.5','7.0','7.5','8.0','8.5','9.0','9.5','10.0'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
      
      
    }
    if(document.getElementById('filter1').value=='status')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>Placed</option><option>Not placed</option>';*/
      document.getElementById('filter2').options.length=0;
       var select= document.getElementById('filter2');
       var op=['Placed','Not placed'];
       var values=['Yes','No'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
      
      
    }
    if(document.getElementById('filter1').value=='Company-wise')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
      var select = document.getElementById('filter2');
      var op=['Tcs_Digital','Tcs_Ninja','CTS','Accenture','CGI','Genpact','Socrotonics','ALTP','INDO-MTM','AurobindoPharma','Medha Servo','TATA Projects','Tranncuron',
      'Cerium Systems','Wipro','Broadcom','DIVIs Laboratories','Infosys','Delta X','PSA AVTEC','Math Works','Hyundai Motors','Amara Raja Group','Vertex Customer Management India Pvt Ltd','FACE','DAIKIN INDIA Pvt Ltd','Hyundai dym','Catchpoint systems','Berger paint','Black pepper','Hetro Drugs','Cap Gemini','EPAM','Tata Chemical','KCC paint','KIA Motors','BE Analytic solution','Ingersoll Rand','Zapcom Solutions','Robet Bosch','AMD','Nalsoft Pvt Ltd','Capital Via Global Pvt Ltd','Bibox Pvt Ltd','Spic Company','Aarvee associates','All online tele services'];
      var values=['Tcs_Digital','Tcs_Ninja','CTS','Accenture','CGI','Genpact','Socrotonics','ALTP','INDO-MTM','AurobindoPharma','Medha Servo','TATA Projects','Tranncuron',
      'Cerium Systems','Wipro','Broadcom','DIVIs Laboratories','Infosys','Delta X','PSA AVTEC','Math Works','Hyundai Motors','Amara Raja Group','Vertex Customer Management India Pvt Ltd','FACE','DAIKIN INDIA Pvt Ltd','Hyundai dym','Catchpoint systems','Berger paint','Black pepper','Hetro Drugs','Cap Gemini','EPAM','Tata Chemical','KCC paint','KIA Motors','BE Analytic solution','Ingersoll Rand','Zapcom Solutions','Robet Bosch','AMD','Nalsoft Pvt Ltd','Capital Via Global Pvt Ltd','Bibox Pvt Ltd','Spic Company','Aarvee associates','All online tele services'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
    }
    if(document.getElementById('filter1').value=='total')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').style.display='none';
      
    }
  }
</script>";
echo '</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;>';

include 'Header1.html';
echo '<div class="row" >
    <div class="col-md-4"></div>
    <div class="col-md-4" style="box-shadow: gray;padding:40px;">
        <form class="form-sign-in" action="#" method="post" target="_blank">
          <h3 class="form-signin-heading" style="text-align:center;color:gray">Reports Generation</h3></br>
          <select class="form-control" name="filter1" id="filter1" onclick="filters()"><option value="year">Year</option><option value="Department">Department</option><option value="gender">Gender</option><option value="Program">Program</option><option value="Company-wise">Company-wise</option><option value="status">Status</option><option value="total">Entire Placement details</option></select>
          &nbsp &nbsp <select class="form-control" name="filter2" id="filter2"></select></br>
          <select style="display:none;" class="form-control" name="filter3" id="filter3" > <option value="pdf">pdf</option></select><br>
          <input type="submit" class="btn btn-primary btn-block" value="Generate"><br><br>
          <div class="row">
            <div class="col-md-4"><p style="text-align:left;font-size:20px"><a href="logout.php" style="color:red">Logout</a></p></div>
            <div class="col-md-4"></div>
            <!--<div class="col-md-4"><p style="font-size:20px"><a href="index.php" style="color:red">Enter data</a></p></div>-->
            <div class="col-md-4"><p style="text-align:right;font-size:20px"><a href="send_mail.php" style="color:red">?Send Mail</a></p></div>
          </div>
        </form>
    </div>
    <div class="col-md-4">
       
       <div class="container " style="margin-top:80px;">
      <button style="margin:10px;padding:5px;border-radius:8px;border:none;background-color:#2940D3;width:300px;"><p style="font-size:20px"><a href="company_credentials.php" style="color:white;">Upload Company Credentials</a></p></button>



      <button style="margin:10px;padding:5px;border-radius:8px;border:none;background-color:#2940D3;width:300px;"><p style="font-size:20px"><a href="data_entry.php" style="color:white;">Upload Placed Students data</a></p></button>



      <button style="margin:10px;padding:5px;border-radius:8px;border:none;background-color:#2940D3;width:300px;"><p style="font-size:19px"><a href="status_update.php" style="color:white;">Update Student Placement Status</a></p></button>
      </div>

    </div>
</div>';
include 'footer.html';

echo '</body>
</html>';
}



else
{
  header('Location:index.php');
}

}
?>
<!--<html>
<head>
</head>
<body>
	<?php

/*require('fpdf183/fpdf.php');
$pdf=new FPDF();
if(isset($_POST['create'])){
$n1=$_POST['n1'];
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,$n1,1,1,'C');
$pdf->Output();

}*/

?>
	<form method="post" action="#">
		<input type="text" name="n1" required placeholder="Company name" ><br>
		<input type="submit" value="create" name="create" >
	</form>
</body>-->
