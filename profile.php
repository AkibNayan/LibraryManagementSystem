<?php

  include "inc/header.php";

?>
<div class="book-details">
	<div class="container">
		<h2>Manage Your Profile</h2>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php

							if (isset($_GET['login_id'])) {

								$login_id = $_GET['login_id'];

								$userSql = "SELECT * FROM users WHERE user_id = '$login_id' ";
								$userSqlRes = mysqli_query($db, $userSql);
								while ($row = mysqli_fetch_assoc($userSqlRes)) {
									$user_id 	= $row['user_id'];
									$fullname 	= $row['fullname'];
									$email 		= $row['email'];
									$password 	= $row['password'];
									$phone 		= $row['phone'];
									$address 	= $row['address'];
									$image 		= $row['image'];
									$role 		= $row['role'];
									$status 	= $row['status'];
								}

							}

						?>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-6">
									<div class="mb-3">
										<label>Full Name</label>
										<input type="text" name="fullname" class="form-control" placeholder="Your Full Name" value="<?php echo $fullname; ?>" >
									</div>
									<div class="mb-3">
										<label>Password</label>
										<input type="password" name="password" class="form-control" placeholder="Your Password">
									</div>
									<div class="mb-3">
										<label>Re-Type Password</label>
										<input type="password" name="repassword" class="form-control" placeholder="Re-Type Password">
									</div>
									<div class="mb-3">
										<label>Phone No.</label>
										<input type="text" name="phone" class="form-control" placeholder="Your Phone No." value="<?php echo $phone; ?>" >
									</div>
								</div>
								<div class="col-lg-6">
									<div class="mb-3">
										<label>Address</label>
										<input type="text" name="address" class="form-control" placeholder="Your Address" value="<?php echo $address; ?>" >
									</div>
									<div class="mb-3">
										<label>Profile Picture</label><br/>
										<?php

											if (!empty($image)) {
												?>
												<img src="admin/dist/img/users/<?php echo $image; ?>" width="100">
												<?php
											}
											else {
												?>
												<img src="admin/dist/img/user8-128x128.jpg" width="100">
												<?php
											}

										?>
										<input type="file" name="image" class="form-control-file" >
									</div>
									<div class="mb-3">
										<input type="hidden" name="profile_id" value="<?php echo $user_id; ?>">
										<input type="submit" name="updateProfile" class="btn btn-success" value="Save Changes">
									</div>
								</div>
							</div>
						</form>
						<!-- Update Profile -->
						<?php

							if (isset($_POST['updateProfile'])) {

								$profile_id 	= mysqli_real_escape_string($db, $_POST['profile_id']);

								$fullname 		= mysqli_real_escape_string($db, $_POST['fullname']);
								$password 		= mysqli_real_escape_string($db, $_POST['password']);
								$repassword 	= mysqli_real_escape_string($db, $_POST['repassword']);
								$phone 			= mysqli_real_escape_string($db, $_POST['phone']);
								$address 		= mysqli_real_escape_string($db, $_POST['address']);
								$image 			= mysqli_real_escape_string($db, $_FILES['image']['name']);
								$tmp_name 		= $_FILES['image']['tmp_name'];

								if (!empty($password) && !empty($image)) {

									if ($password == $repassword) {

										$hassedPass = sha1($password);

										$split = explode('.', $_FILES['image']['name']);
										$extn = strtolower(end($split));

										$extension = array('jpg', 'jpeg', 'png');

										if (in_array($extn, $extension) === true) {
											$random = rand();
											$updatedName = $random."_".$image;

											move_uploaded_file($tmp_name, 'admin/dist/img/users/'.$updatedName);

											/*Unlink Previous Image*/
											$oldImgSql = "SELECT image FROM users WHERE user_id = '$profile_id' ";
											$oldImgSqlRes = mysqli_query($db, $oldImgSql);
											while ($row = mysqli_fetch_assoc($oldImgSqlRes)) {
												$existingImg = $row['image'];
											}
											if (!empty($existingImg)) {
												unlink('admin/dist/img/users/'.$existingImg);
											}

											$updateSql = "UPDATE users SET fullname = '$fullname', password = '$hassedPass', phone = '$phone', address = '$address', image = '$updatedName' WHERE user_id = '$profile_id' ";
											$updateSqlRes = mysqli_query($db, $updateSql);

											if ($updateSqlRes) {
												header('Location: index.php');
											}
											else {
												die("User Profile Update Error!!".mysqli_error($db));
											}

										}
										else {
											echo "<span class='alert alert-danger'>File Type is not an image!!</span>";
										}

									}
									else {
										echo "<span class='alert alert-danger'>Password Not Matched!!</span>";
									}

								}
								else if (!empty($password) && empty($image)) {

									if ($password == $repassword) {

										$hassedPass = sha1($password);

										$updateSql = "UPDATE users SET fullname = '$fullname', password = '$hassedPass', phone = '$phone', address = '$address' WHERE user_id = '$profile_id' ";
										$updateSqlRes = mysqli_query($db, $updateSql);

										if ($updateSqlRes) {
											header('Location: index.php');
										}
										else {
											die("User Profile Update Error!!".mysqli_error($db));
										}
									}
									else {
										echo "<span class='alert alert-danger'>Password Not Matched!!</span>";
									}

								}
								else if (empty($password) && !empty($image)) {

									$split = explode('.', $_FILES['image']['name']);
									$extn = strtolower(end($split));

									$extension = array('jpg', 'jpeg', 'png');

									if (in_array($extn, $extension) === true) {
										$random = rand();
										$updatedName = $random."_".$image;

										move_uploaded_file($tmp_name, 'admin/dist/img/users/'.$updatedName);

										/*Unlink Previous Image*/
										$oldImgSql = "SELECT image FROM users WHERE user_id = '$profile_id' ";
										$oldImgSqlRes = mysqli_query($db, $oldImgSql);
										while ($row = mysqli_fetch_assoc($oldImgSqlRes)) {
											$existingImg = $row['image'];
										}
										if (!empty($existingImg)) {
											unlink('admin/dist/img/users/'.$existingImg);
										}

										$updateSql = "UPDATE users SET fullname = '$fullname', phone = '$phone', address = '$address', image = '$updatedName' WHERE user_id = '$profile_id' ";
										$updateSqlRes = mysqli_query($db, $updateSql);

										if ($updateSqlRes) {
											header('Location: index.php');
										}
										else {
											die("User Profile Update Error!!".mysqli_error($db));
										}

									}
									else {
										echo "<span class='alert alert-danger'>File Type is not an image!!</span>";
									}

								}
								else if (empty($password) && empty($image)) {

									$updateSql = "UPDATE users SET fullname = '$fullname', phone = '$phone', address = '$address' WHERE user_id = '$profile_id' ";
									$updateSqlRes = mysqli_query($db, $updateSql);

									if ($updateSqlRes) {
										header('Location: index.php');
									}
									else {
										die("User Profile Update Error!!".mysqli_error($db));
									}

								}

							}

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

  include "inc/footer.php";

?>