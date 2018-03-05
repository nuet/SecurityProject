<?php
	session_start();

	$id		= "";
	$name 	= "";
	$na1	= ["",""];
	$nameB	= "";
	$naB1	= ["",""];
	$nameL	= "";
	$naL1	= ["",""];
	$Bdate	= 1;
	$Bmonth	= 1;
	$Byear	= date('Y');
	$email	= "";
	$socialSecurityNumber	= "";

	$flag_date = true;
	$flag_SSN  = true;

	if(isset( $_POST['inputName']) )
	{
		$id		= $_POST['inputId'];
		//$name
		$na1	= $_POST['inputName'];
		foreach($_POST['inputName'] as $val)
		{
			$name .= " ". $val;
		}
		//$nameB
		$naB1	= $_POST['inputNameB'];
		foreach($_POST['inputNameB'] as $val)
		{
			$nameB .= " ". $val;
		}
		//$nameL
		$naL1	= $_POST['inputNameL'];
		foreach($_POST['inputNameL'] as $val)
		{
			$nameL .= " ". $val;
		}
		$Bdate	= $_POST["dd"];
		$Bmonth	= $_POST["mm"];
		$Byear	= $_POST["yyyy"];
		$date   = new DateTime();
		$date->setDate($Byear, $Bmonth, $Bdate);
		
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
								"options" => array("regexp"=>"/\s*([\u0621-\u064A]{2,10}(\s+[\u0621-\u064A]{2,10})?)\s*/")
								)
			,
			'inputNameL' 	=> array(
								"options" => array("regexp"=>"/\s*([\u0621-\u064A]{2,10}(\s+[\u0621-\u064A]{2,10})?)\s*/")
								)
			,
			'inputEmail'   	=> FILTER_VALIDATE_EMAIL,
			'inputN'   	 	=> array(
								"options" => array("regexp"=>"/[12]{2}[0-9]{10}/")
								)
		);
		$flag_date = true;
		$flag_SSN  = true;
		if( $date > new DateTime('-1 day')  ){
			$flag_date = false;
		}
		if( $date->format('Y') != substr($socialSecurityNumber , 1 , 4) ){
			$flag_SSN = false;
		}
		
		if( filter_input_array(INPUT_POST,$args_op) && $flag_date && $flag_SSN )
		{
			$patt = "/\s{2,}/";
			
			$_SESSION['id']	   	= trim($id);
			$name  				= preg_replace($patt, " ", $name);
			$_SESSION['name']   = trim($name);
			$nameB  			= preg_replace($patt, " ", $nameB);
			$_SESSION['nameB']  = trim($nameB);
			$nameL  			= preg_replace($patt, " ", $nameL);
			$_SESSION['nameL']  = trim($nameL);
			$_SESSION['Bdate'] 	= $date;
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
					action="<?= $_SERVER['PHP_SELF'] ?>" 
					>
				  <h1 class="text-right">تسجيل</h1><!-- head form -->
				  
				  <div class="form-group">
					  <div class="row">
				  		<label for="inputId" class="col-sm-2 control-label col-form-label-lg text-right">رقم القيد<span class="_valid"> *</span></label>
				  		<div class="col-sm-10">
							<input type="text" name="inputId" class="form-control form-control-lg" id="inputId" placeholder="ادخل رقم قيدك" pattern="^\s*([0-9]{4,9})\s*$"
							value="<?= $id ?>"
						    onchange="InvalidMsg(this)"
							oninvalid="InvalidMsg(this)"
							required />
				   		</div>
					   </div>
					  <div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-10">
					  		<small id="idHelp" class="Help form-text _HelpValid">رقم القيد يتكون من اربعة إلى تسعة ارقام.</small>
						</div>
					  </div>
				  </div>
				  
				  <div class="form-group">
					  <div class="row">
					  <label for="inputName" class="col-sm-2 control-label col-form-label-lg text-right">الاسم<span class="_valid"> *</span></label>
					  <div class="col-sm-10">
						  <div class="container-fluid">
						  <div class="row">
					  		<input type="text" name="inputName[]" class="col-md form-control form-control-lg" id="inputName" placeholder="ادخل اسمك" pattern="^\s*([\u0621-\u064A]{2,10})\s*$"
							value="<?= $na1[0] ?>" 
							onchange="Invalid_name(this)"
							oninvalid="Invalid_name(this)"
							required />
							<?php 
							 	if( !empty($na1[1]) ) {
							 
							  		echo "<input type=\"text\" name=\"inputName[]\" class=\"col col-md form-control form-control-lg\" id=\"inputName2\" pattern=\"^\\s*([\\u0621-\\u064A]{2,10})\\s*$\" value=\"$na1[1]\" placeholder=\"بقية الاسم المركب\" onchange=\"Invalid_name(this)\" oninvalid=\"Invalid_name(this)\" required />";
									echo "<span class=\"input-group-btn\">
							    <button class=\"btn btn-danger\" type=\"button\" onclick=\"delInput(this)\">-</button>
							</span>";
							  
								} else {
							  ?>
							<span class="input-group-btn">
							    <button class="btn btn-info" type="button" onclick="addInput(this)">+</button>
							</span>
							 <?php } ?>
						  </div>
						  </div>
					  </div>
					  </div>
					  <div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-10">
					  		<small id="nameHelp" class="Help form-text _HelpValid">الاسم يجب ان يكون باللغة العربية وطوله من حرفين إلى عشرة حروف اذا كان الاسم مركب اضغط على الرمز (+).</small>
						</div>
					  </div>
				  </div>
				  <div class="form-group">
					  	<div class="row">
							<label for="inputParentName" class="col-sm-2 control-label col-form-label-lg text-right">اسم الاب<span class="_valid"> *</span></label>
							<div class="col-sm-10">
							  <div class="container-fluid">
						      <div class="row">
								<input type="text" name="inputNameB[]" class="col-md form-control form-control-lg" id="inputParentName" placeholder="ادخل اسم الوالد" pattern="^\s*([\u0621-\u064A]){2,10}\s*$"
								value="<?= $naB1[0] ?>"
								onchange="Invalid_name(this)"
								oninvalid="Invalid_name(this)"
								required />
								<?php 
							 	if( !empty($naB1[1]) ) {
							 
							  		echo "<input type=\"text\" name=\"inputNameB[]\" class=\"col col-md form-control form-control-lg\" id=\"inputParentName2\" pattern=\"^\\s*([\\u0621-\\u064A]{2,10})\\s*$\" value=\"$naB1[1]\" placeholder=\"بقية الاسم المركب\" onchange=\"Invalid_name(this)\" oninvalid=\"Invalid_name(this)\" required />";
									echo "<span class=\"input-group-btn\">
							    <button class=\"btn btn-danger\" type=\"button\" onclick=\"delInput(this)\">-</button>
							</span>";
							  
								} else {
							  ?>
							<span class="input-group-btn">
							    <button class="btn btn-info" type="button" onclick="addInput(this)">+</button>
							</span>
							 <?php } ?> 
							  </div>
							  </div>
							</div>
						  </div>
						  <div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-10">
								<small id="idHelp" class="Help form-text _HelpValid">الاسم يجب ان يكون باللغة العربية وطوله من حرفين إلى عشرة حروف اذا كان الاسم مركب اضغط على الرمز (+).</small>
							</div>
						  </div>
					  </div>
					  <div class="form-group">
						  <div class="row">
							<label for="inputLastName" class="col-sm-2 control-label col-form-label-lg text-right">اللقب<span class="_valid"> *</span></label>
							<div class="col-sm-10">
							   <div class="container-fluid">
						       <div class="row">
								<input type="text" name="inputNameL[]" class="col-md form-control form-control-lg" id="inputLastName" placeholder="ادخل اسم العائلة" pattern="^\s*([\u0621-\u064A]){2,10}\s*$"
								value="<?= $naL1[0] ?>"
								onchange="Invalid_name(this)"
								oninvalid="Invalid_name(this)"
								required />
								<?php 
							 	if( !empty($naL1[1]) ) {
							 
							  		echo "<input type=\"text\" name=\"inputNameL[]\" class=\"col col-md form-control form-control-lg\" id=\"inputLastName2\" pattern=\"^\\s*([\\u0621-\\u064A]{2,10})\\s*$\" value=\"$naL1[1]\" placeholder=\"بقية الاسم المركب\" onchange=\"Invalid_name(this)\" oninvalid=\"Invalid_name(this)\" required />";
									echo "<span class=\"input-group-btn\">
							    <button class=\"btn btn-danger\" type=\"button\" onclick=\"delInput(this)\">-</button>
							</span>";
							  
								} else {
							  ?>
							<span class="input-group-btn">
							    <button class="btn btn-info" type="button" onclick="addInput(this)">+</button>
							</span>
							 <?php } ?> 
							  </div>
							  </div>
							</div>
						 </div>
						 <div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-10">
								<small id="idHelp" class="Help form-text _HelpValid">الاسم يجب ان يكون باللغة العربية وطوله من حرفين إلى عشرة حروف اذا كان الاسم مركب اضغط على الرمز (+).</small>
							</div>
						 </div>
					  </div>
				  
				  <script>
				      var selectedDay  = <?= $Bdate ?>;
					  var selectedMon  = <?= $Bmonth ?>;
					  var selectedYear = <?= $Byear ?>;
				  </script>
				  
				  <div class="form-group row">
					  <label for="inputDate" class="col-sm-2 control-label col-form-label-lg text-right">تاريخ الميلاد<span class="<?php 
						  								if(!$flag_date) echo "_invalid";
														else echo "_valid";
					  								?>"> *</span></label>
					  <div class="col-sm-10">
						  <div class="container-fluid">
						  <div class="row">
							<SELECT class="col combine form-control form-control-lg" id ="year" name = "yyyy" onchange="change_year(this)">
							</SELECT>
						    <SELECT class="col combine form-control form-control-lg" id ="month" name = "mm" onchange="change_month(this)">
							</SELECT>
						    <SELECT class="col combine form-control form-control-lg" id ="day" name = "dd" >
							</SELECT>
						  </div>
						  </div>
					  </div>
				  </div>
				  <div class="form-group ">
					  <div class="row">
				  		<label for="inputEmail" class="col-sm-2 control-label col-form-label-lg text-right">البريد الاكتروني<span class="_valid"> *</span></label>
				  		<div class="col-sm-10">
							<input type="email" name="inputEmail" class="form-control form-control-lg" id="inputEmail" placeholder="ادخل بريدك الاكتروني"
							value="<?= $email ?>"
							onchange="InvalidMsg(this)"
							oninvalid="InvalidMsg(this)"
							required /><!-- pattern is A valid e-mail According to standards w3.org -->
				   		</div>
					  </div>
					  <div class="row">
					      <div class="col-sm-2"></div>
						  <div class="col-sm-10">
						      <small id="idHelp" class="Help form-text _HelpValid">البريد الاكتروني يكون بهذا النمط (xxxx@xxx.xxx).</small>
						  </div>
					  </div>
				  </div>
				  <div class="form-group">
					 <div class="row">
					  <label for="inputN12" class="col-sm-2 control-label col-form-label-lg text-right">الرقم الوطني<span class="<?php 
						  								if(!$flag_SSN) echo "_invalid";
														else echo "_valid";
					  								?>"> *</span></label>
					  <div class="col-sm-10">
					  		<input type="text" name="inputN" class="form-control form-control-lg" id="inputN12" placeholder="ادخل رقمك الوطني" pattern="[12]{2}[0-9]{10}"
							value="<?= $socialSecurityNumber ?>"
							onchange="InvalidMsg(this)"
							oninvalid="InvalidMsg(this)"
							required />
					  </div>
				     </div>
					  <div class="row">
					      <div class="col-sm-2"></div>
						  <div class="col-sm-10">
						      <small id="idHelp" class="Help form-text <?php 
						  								if(!$flag_SSN) echo "_HelpInvalid";
														else echo "_HelpValid";
					  								?>">الرقم الوطني يتكون من اثنى عشر خانة الخانة الاولى يجب ان تكون 1 او 2 والخانة الثانية إلى الخامسة تمثل سنة ميلادك.</small>
						  </div>
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
		  
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	  
	<!-- plugin JavaScript -->
	<script src="js/plugin.js"></script>
	<!--
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	-->
  </body>
</html>