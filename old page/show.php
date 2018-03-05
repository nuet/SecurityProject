<?php
	session_start();

	if(!isset($_SESSION['id']))
	{
		header("Location: signup.php");
		exit();
	}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>show</title>
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
	  <section class="section show_input">
		  <div class="container">
			<div class="row">
			<div class="col-sm-1"></div>
			<table class="table table-bordered" dir="rtl">
			  <thead class="table-info">
				<tr>
				  <th scope="col" class="w-25">#</th>
				  <th scope="col">البيانات</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">رقم القيد</th>
				  <td><?php echo $_SESSION['id']; ?></td>
				</tr>
				<tr>
				  <th scope="row">الاسم</th>
				  <td><?php echo $_SESSION['name']; ?></td>
				</tr>
				<tr>
				  <th scope="row">الاب</th>
				  <td><?php echo $_SESSION['nameB']; ?></td>
				</tr>
				<tr>
				  <th scope="row">اسم العائلة</th>
				  <td><?php echo $_SESSION['nameL']; ?></td>
				</tr>
				<tr>
				  <th scope="row">تاريخ الميلاد</th>
				  <td><?php echo $_SESSION['Bdate']; ?></td>
				</tr>
				<tr>
				  <th scope="row">البريد الاكتروني</th>
				  <td><?php echo $_SESSION['email']; ?></td>
				</tr>
				<tr>
				  <th scope="row">الرقم الوطني</th>
				  <td><?php echo $_SESSION['SSN']; ?></td>
				</tr>
			  </tbody>
			</table>
				
				<form class="col-sm-12" role="form" dir="rtl" 
					accept-charset="utf8" 
					method="post"
					action="<?php echo $_SERVER['PHP_SELF']; ?>" 
					>
				  <div class="form-group row">
					  <label for="inputPass" class="col-sm-2 control-label col-form-label-lg text-right">الرقم السري<span class="_valid">*</span></label>
					  <div class="col-sm-10">
					  		<input type="text" name="inputPass" class="form-control form-control-lg" id="inputPass" placeholder="" pattern=""
							value="<?php echo ""; ?>"
							onchange="InvalidMsg(this)"
							oninvalid="InvalidMsg(this)"
							required />
					  </div>
				  </div>
					<div class="form-group">
						 <div class="row">
							<label for="inputPass2" class="col-sm-2 control-label col-form-label-lg text-right">اعد كتابة الرقم السري<span class="_valid">*</span></label>
							<div class="col-sm-10">
								<input type="text" name="inputPass2" class="form-control form-control-lg" id="inputPass2" placeholder="" pattern=""
								value="<?php echo ""; ?>"
								onchange="InvalidMsg(this)"
								oninvalid="InvalidMsg(this)"
								required />
							</div>
						</div>
					  </div>
				  <div class="form-group row">
					<div class="col-sm-2"><p class="text-right ss">هذا الحقل مطلوب</p></div>
					<div class="col-sm-4 col-md-3 col-lg-2">
					  <button type="submit" class="btn btn-info btn-lg btn-block">التسجيل</button>
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