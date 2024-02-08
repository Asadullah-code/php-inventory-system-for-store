<?php 
require_once 'php_action/db_connect.php';
session_start();

if(isset($_SESSION['userId'])) {
	header('location:'.$store_url.'dashboard.php');		
}

$errors = array();

if ($_POST) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
//    echo "<pre>";
//    print_r($_POST);
//    die();
    if (empty($username) || empty($password)) {
        if (empty($username)) {
            $errors[] = "Username is required";
        }

        if (empty($password)) {
            $errors[] = "Password is required";
        }
    } else {

        // Use a prepared statement to avoid SQL injection
        $stmt = $connect->prepare("SELECT users.*, roles.name as role_name FROM users
                                    JOIN roles ON users.role_id = roles.id
                                    WHERE users.username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $password = md5($password);

            if ($role == $row['role_name']) {
                if ($password == $row['password']) {
                    // Set session
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['userRole'] = $row['role_name'];

                    header('location:' . $store_url . 'dashboard.php');
                } else {
                    $errors[] = "Incorrect username/password combination";
                }
            }else{
                $errors[] = "No ".$role." registered with this email";
            }


        } else {
            $errors[] = "Username does not exist";
        }

        $stmt->close();
    }
}
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
								<a id="adminBtn" class="panelCol1Btn role_btn  active" data-role="admin" href="#">As Admin</a>
							</div>
							<div class="col-lg-6 col-md-6 col-12 panelCol2">
								<a id="userBtn" class="panelCol2Btn role_btn" data-role="user" href="#">As User</a>
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
                            $(document).on('click', '.role_btn', function () {
                                $(".role_btn").removeClass('active');
                                $(this).addClass('active');
                                $('#loginForm').find('input[name="role"]').val($(this).data('role'))
                            });

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
                                <input type="hidden" name="role" value="admin">
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group d-flex align-items-center justify-content-center">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default" style="margin-bottom: 12px;"> <i class="glyphicon glyphicon-log-in"></i> Login</button>
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







	