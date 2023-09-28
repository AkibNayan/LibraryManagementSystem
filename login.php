<?php

	include "inc/header.php";

?>
<!DOCTYPE html>
<html>
<head>
<title>Creative Colorlib SignUp Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="assets/custom.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Please Login to grab your book.</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="" method="POST">
					<input class="text email" type="email" name="email" placeholder="Email Address" required="">
					<input class="text" type="password" name="password" placeholder="Your Password" required="">
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" name="login" value="Login">
				</form>

				<?php

					if (isset($_POST['login'])) {

						$email 		= mysqli_real_escape_string($db, $_POST['email']);
						$password 	= mysqli_real_escape_string($db, $_POST['password']);

						if (!empty($password)) {

							$hassedPass = sha1($password);

							$query = "SELECT * FROM users WHERE email = '$email' AND password = '$hassedPass' ";
							$result = mysqli_query($db, $query);
							while ($row = mysqli_fetch_assoc($result)) {

								$_SESSION['user_id']  	= $row['user_id'];
								$fullname 				= $row['fullname'];
								$_SESSION['email'] 		= $row['email'];
								$password 				= $row['password'];
								$phone 					= $row['phone'];
								$address 				= $row['address'];
								$image 					= $row['image'];
								$_SESSION['role'] 		= $row['role'];
								$status 				= $row['status'];
								$join_date 				= $row['join_date'];

								if ($status == 1) {

									if ($email == $_SESSION['email'] && $hassedPass == $password) {
										header('Location: index.php');
									}
									else if ($email != $_SESSION['email'] || $hassedPass != $password) {
										header('Location: login.php');
									}
									else {
										header('Location: login.php');
									}

								}
								else {
									header('Location: login.php');
								}

							}

						}
					}

				?>

				<p>Don't have an Account? <a href="register.php"> Registration!</a></p>
			</div>
		</div>
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>