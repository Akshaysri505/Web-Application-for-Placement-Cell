<html>
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/bootstrap.css">
	<style>
section{
	width: 100%;
	height: 70vh;
	background-color: #F5F3EE;
	display: flex;
	align-items: center;
	justify-content: center;
	padding-left: 5rem;
	padding-right: 5rem;
}

.container{
	width: 100%;
	max-width: 10rem;
	padding: 0 ;
}

.accordion-item{
	background-color: #283042;
	box-shadow: 0rem 1px 0.5rem rgba(0,0,0,0.3);
	padding-bottom: 0rem;
	padding-left: 0rem;
}

.accordion-link{
	font-size: 1.5rem;
	color: black;
	text-decoration: none;
	background-color: none;
	width: 100%;
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 0.5rem 0;
}

.accordion-link i{
	color: #ffffff;
	padding: 0.5rem;
}


.accordion-link .ion-md-remove{
	display: none;
}

.answer{
	max-height: 0;
	overflow: hidden;
	position: relative;
	background-color: #212838;
    transition: max-height 650ms;

}

.answer::before{
	content: "";
	position: absolute;
	width: 0.8rem;
	height: 70%;
	background-color: #8fc460;
	top: 50%;
	left: 0;
	transform:translateY(-50%);


}

.answer p{
	color: rgba(255,255,255,0.6);
	font-size: 1.3rem;
	padding: 1.5rem;
}

.accordion-item:target .answer{
	max-height: 6rem;
}

.accordion-item:target .accordion-link .ion-md-add{
	display: none;
}
.accordion-item:target .accordion-link .ion-md-remove{
	display: block;
}
#m6{
			background-color:#EAC8AF;
			border-radius:8px;
		}
	</style>
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">
	<?php include('Header1.html');?>
	<section>
		<div class="container" >
			<h5 style="text-align:center;font-size:40px;">FAQ's</h5>
			<div class="accordion">
				<div class="accordion-item" id="question1">
					<a class="accordion-link" href="#question1" style="padding:10px;">
					 When does the campus recruitment season begin?
					 <i class="icon ion-md-add"></i> 
					 <i class="icon ion-md-remove"></i>	
					 <ion-icon name="md-apps"></ion-icon>
					</a>
					<div class="answer">
						<p>
						Normally, the campus placement season begins at the prefinal/final semester. It commences in the month of July and goes on till
                         the end of the academic year.
					</p>
					</div>
					
				</div>
				<div class="accordion-item" id="question2">
					<a class="accordion-link" href="#question2" style="padding:10px;">
					 How do I communicate with a particular Company?
					 <i class="icon ion-md-add"></i> 
					 <i class="icon ion-md-remove"></i>	
					 <ion-icon name="md-apps"></ion-icon>
					</a>
					<div class="answer">
						<p>
						All communications should be routed only through the Placement
                        Cell. No direct communication with company HR should be done.
					    </p>
					</div>
					
				</div>
				<div class="accordion-item" id="question3">
					<a class="accordion-link" href="#question3" style="padding:10px;">
					 Will the results be declared on the same day of the campus
                     placements?
					 <i class="icon ion-md-add"></i> 
					 <i class="icon ion-md-remove"></i>	
					 <ion-icon name="md-apps"></ion-icon>
					</a>
					<div class="answer">
						<p>
						Results will be declared on the same day by most of the
                        companies, but few companies might announce the results later
						</p>
					
					</div>
					
				</div>
				<div class="accordion-item" id="question4" style="padding:10px;">
					<a class="accordion-link" href="#question4">
					 What are the documents to be carried by the students on the
                     day of campus placements?
					 <i class="icon ion-md-add"></i> 
					 <i class="icon ion-md-remove"></i>	
					 <ion-icon name="md-apps"></ion-icon>
					</a>
					<div class="answer">
						<p>
						a. College identity card.<br>
						b. Three sets of updated Resume, Photocopies of mark sheets and
						other certification if any and  2 recent passport size photographs.<br>
					    </p>
					</div>
					
				</div>
				
			</div>
		</div>
	</section>
	<?php include('footer.html');?>
</body>
</html>