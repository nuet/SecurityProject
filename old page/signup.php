<?php
	session_start();

	$id		= "";
	$name 	= "";
	$nameB	= "";
	$nameL	= "";
	$Bdate	= "";
	$email	= "";
	$socialSecurityNumber	= "";

	if(isset( $_POST['inputName']) )
	{
		$id		= $_POST['inputId'];
		$name 	= $_POST['inputName'];
		$nameB	= $_POST['inputNameB'];
		$nameL	= $_POST['inputNameL'];
		$Bdate	= $_POST['inputDate'];
		$email	= $_POST['inputEmail'];
		$socialSecurityNumber	= $_POST['inputN'];
		$args_op= array(
			'inputId'		=> array(
								"options" => array("regexp"=>"/^\s*([0-9]{4,9})\s*$/")
								)
			,
			'inputName'		=> array(
								"options" => array("regexp"=>"/\s*([\u0621-\u064A]{2,10}(\s+[\u0621-\u064A]{2,10})?)\s*/")
								)
			,
			'inputNameB'    => array(
								"options" => array("regexp"=>"/^\s*([\u0621-\u064A]){2,10}\s*$/")
								)
			,
			'inputNameL' 	=> array(
								"options" => array("regexp"=>"/^\s*([\u0621-\u064A]){2,10}\s*$/")
								)
			,
			'inputDate'    	=> array(
								"options" => array("regexp"=>"/\b{1,2}/\b{1,2}/\b{4}/")
								)
			,
			'inputEmail'   	=> FILTER_VALIDATE_EMAIL,
			'inputN'   	 	=> array(
								"options" => array("regexp"=>"/[12]{2}[0-9]{10}/")
								)
		);
		if( filter_input_array(INPUT_POST,$args_op) )
		{
			$patt = "/\s{2,}/";
			
			$_SESSION['id']	   	= trim($id);
			$name  				= preg_replace($patt, " ", $name);
			$_SESSION['name']  = trim($name);
			$_SESSION['nameB'] = trim($nameB);
			$_SESSION['nameL'] = trim($nameL);
			$_SESSION['Bdate'] 	= $Bdate;
			$_SESSION['email'] 	= $email;
			$_SESSION['SSN'] 	= $socialSecurityNumber;
			header("Location: show.php");  
		}
		else {
			
		}		
	}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Sign Up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Abdulmalik Ben Ali">

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	-->
	<!-- My CSS -->
	<link rel="stylesheet" href="css/style.css">
	 
  </head>
  <body>
	  <nav class="navbar navbar-expand-sm navbar-fixed-top bg-info navbar-dark">
		  <div class="container-fluid">
			  <a class="navbar-brand text-capitalize" href="#">security project CS340</a>
		  </div>
	  </nav>
	  <section class="section form_input">
		  <div class="container">
			<div class="row">
			<div class="col-sm-1"></div>
			  <form class="col-sm-12" role="form" dir="rtl" 
					accept-charset="utf8" 
					method="post"
					action="<?php echo $_SERVER['PHP_SELF']; ?>" 
					>
				  <h1 class="text-right">تسجيل</h1><!-- head form -->
				  
				  <div class="form-group row">
				  		<label for="inputId" class="col-sm-2 control-label col-form-label-lg text-right">رقم القيد<span class="_valid"> *</span></label>
				  		<div class="col-sm-10">
							<input type="text" name="inputId" class="form-control form-control-lg" id="inputId" placeholder="ادخل الرقم القيد اربعة ارقام او 9 ارقام" pattern="^\s*([0-9]{4,9})\s*$"
							value="<?php echo $id; ?>"
						    onchange="InvalidMsg(this)"
							oninvalid="InvalidMsg(this)"
							required />
				   		</div>
				  </div>
				  <div class="form-group row">
					  <label for="inputName" class="col-sm-2 control-label col-form-label-lg text-right">الاسم<span class="_valid"> *</span></label>
					  <div class="col-sm-10">
					  		<input type="text" name="inputName" class="form-control form-control-lg" id="inputName" placeholder="ادخل الاسم بطول من حرفين إلى 10 او اسم مركب" pattern="^\s*([\u0621-\u064A]{2,10}(\s+[\u0621-\u064A]{2,10})?)\s*$"
							value="<?php echo $name; ?>"
							onchange="InvalidMsg(this)"
							oninvalid="InvalidMsg(this)"
							required />
					  </div>
				  </div>
				  <div class="row">
					  <div class="form-group col-md-6">
						 <div class="row">
							<label for="inputParentName" class="col-sm-2 col-md-4 control-label col-form-label-lg text-right">اسم الاب<span class="_valid"> *</span></label>
							<div class="col-sm-10 col-md-8">
								<input type="text" name="inputNameB" class="form-control form-control-lg" id="inputParentName" placeholder="ادخل اسم بطول من 2 إلى 10 حروف" pattern="^\s*([\u0621-\u064A]){2,10}\s*$"
								value="<?php echo $nameB; ?>"
								onchange="InvalidMsg(this)"
								oninvalid="InvalidMsg(this)"
								required />
							</div>
						</div>
					  </div>
					  <div class="form-group col-md-6">
						<div class="row">
							<label for="inputLastName" class="col-sm-2 control-label col-form-label-lg text-right">اللقب<span class="_valid"> *</span></label>
							<div class="col-sm-10">
								<input type="text" name="inputNameL" class="form-control form-control-lg" id="inputLastName" placeholder="ادخل اللقب بطول من 2 إلى 10 حروف" pattern="^\s*([\u0621-\u064A]){2,10}\s*$"
								value="<?php echo $socialSecurityNumber; ?>"
								onchange="InvalidMsg(this)"
								oninvalid="InvalidMsg(this)"
								required />
							</div>
						</div>
					  </div>
				  </div>
				  <div class="form-group row">
					  <label for="inputDate" class="col-sm-2 control-label col-form-label-lg text-right">تاريخ الميلاد<span class="_valid"> *</span></label>
					  <div class="col-sm-10">
					  		<input type="date" name="inputDate" class="form-control form-control-lg" id="inputDate" placeholder="mm/dd/yyyy" pattern="\b{1,2}/\b{1,2}/\b{4}"
							value="<?php echo $Bdate; ?>"
							onchange="InvalidMsg(this)"
							oninvalid="InvalidMsg(this)"
							required />
					  </div>
				  </div>
				  <div class="form-group row">
				  		<label for="inputEmail" class="col-sm-2 control-label col-form-label-lg text-right">البريد الاكتروني<span class="_valid"> *</span></label>
				  		<div class="col-sm-10">
							<input type="email" name="inputEmail" class="form-control form-control-lg" id="inputEmail" placeholder="ادخل البريد الاكتروني"
							value="<?php echo $email; ?>"
							onchange="InvalidMsg(this)"
							oninvalid="InvalidMsg(this)"
							required /><!-- pattern is A valid e-mail According to standards w3.org -->
				   		</div>
				  </div>
				  <div class="form-group row">
					  <label for="inputN12" class="col-sm-2 control-label col-form-label-lg text-right">الرقم الوطني<span class="_valid"> *</span></label>
					  <div class="col-sm-10">
					  		<input type="text" name="inputN" class="form-control form-control-lg" id="inputN12" placeholder="ادخل الرقم الوطني يتكون من 12 الرقم" pattern="[12]{2}[0-9]{10}"
							value="<?php echo $socialSecurityNumber; ?>"
							onchange="InvalidMsg(this)"
							oninvalid="InvalidMsg(this)"
							required />
					  </div>
				  </div>
				  <div class="form-group row">
					<div class="col-sm-2"><p class="text-right ss">هذا الحقل مطلوب</p></div>
					<div class="col-sm-4 col-md-3 col-lg-2">
					  <button type="submit" class="btn btn-info btn-lg btn-block">التالي</button>
					</div>
				  </div>
			  </form>
			<div class="col-sm-1"></div>
			</div>
		  </div>
	  </section>
	  <footer class="_footer bg-info">
		  <div class="copyright text-center">
			  Copyright &copy; 2017 <span></span> .Inc
		  </div>
	  </footer>
	
    <!-- Optional JavaScript -->
	<!-- plugin JavaScript -->
	<script src="js/plugin.js"></script>
		  
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<!--
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	-->
  </body>
</html>