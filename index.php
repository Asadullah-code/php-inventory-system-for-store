<?php 
require_once 'php_action/db_connect.php';
session_start();

if(isset($_SESSION['userId'])) {
	header('location:'.$store_url.'dashboard.php');		
}

$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Username is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			// exists
			$mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['user_id'];

				// set session
				$_SESSION['userId'] = $user_id;

				header('location:'.$store_url.'dashboard.php');	
			} else{
				
				$errors[] = "Incorrect username/password combination";
			} // /else
		} else {		
			$errors[] = "Username doesnot exists";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>

<!DOCTYPE html>
<html>
<head>
	<title>Stock Management System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">
	<style>
		.active {
	     background-color: #cce7f4b0;
	     padding: 16px;
        box-shadow: 0px 0px 7px #0000007d; /* Example box shadow */
    }
	</style>

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">	

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row vertical">
			<div class="col-md-5 col-md-offset-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign in</h3>
					</div>
					<div class="panel-body">
						<div class="row panelrow">
							<div class="col-lg-6 col-md-6 col-12 panelCol1"> 
								<a id="adminBtn" class="panelCol1Btn active" onclick="showLoginForm('admin')" href="#">As Admin</a>
							</div>
							<div class="col-lg-6 col-md-6 col-12 panelCol2">
								<a id="userBtn" class="panelCol2Btn" onclick="showLoginForm('user')" href="#">As User</a>
							</div>
						</div>
						<script>
							function showLoginForm(userType){
								$loginForm = document.getElementById("loginForm");
								$loginFormU = document.getElementById("loginFormU");

								if (userType ==='admin') {
									loginForm.style.display = 'block';
									loginFormU.style.display = 'none';

									adminBtn.classList.add('active');
									userBtn.classList.remove('active');
								}
								else{
									loginForm.style.display = 'none';
									loginFormU.style.display = 'block';

									userBtn.classList.add('active');
									adminBtn.classList.remove('active');
								}

							}
						</script>

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>

						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							<fieldset>
							    <div class="form-group">
									<label for="username" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group d-flex align-items-center justify-content-center">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default" style="margin-bottom: 12px;"> <i class="glyphicon glyphicon-log-in"></i> As Admin</button>
								    </div>
								</div>
							</fieldset>
						</form>
						<form action="php_action/checkUserLogin.php" method="post" id="loginFormU" style="display: none;">
							<fieldset>
							    <div class="form-group">
									<label for="usernameu" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="usernameu" name="usernameU" placeholder="Username" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="passwordu" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="passwordu" name="passwordU" placeholder="Password" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group d-flex align-items-center justify-content-center">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default" style="margin-bottom: 12px;"> <i class="glyphicon glyphicon-log-in"></i> As User</button>
								    </div>
								</div>
							</fieldset>
						</form>
					</div>
					<!-- panel-body -->
				</div>
				<!-- /panel -->
			</div>
			<!-- /col-md-4 -->
		</div>
		<!-- /row -->
	</div>
	<!-- container -->	
</body>
</html>







	