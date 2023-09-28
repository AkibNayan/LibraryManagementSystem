<?php

  include "inc/header.php";

?>

<?php

  include "inc/topbar.php";

?>
  
<?php

  include "inc/leftmenu.php";

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Users Management</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
    <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<?php

						$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
						//Manage All Users
						if ($do == 'Manage') {
							?>

							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Manage All Users</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table class="table table-bordered table-striped table-hover">
										<thead class="table-info">
											<tr>
												<th >#</th>
												<th>Thumbnail</th>
												<th>FullName</th>
												<th>Email Address</th>
												<th>Address</th>
												<th>Phone</th>
												<th>User Role</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php

												$readSql = "SELECT * FROM users";
												$readSqlRes = mysqli_query($db, $readSql);
												$count = 0;
												while ($row = mysqli_fetch_assoc($readSqlRes)) {

													$user_id 	= $row['user_id'];
													$fullname 	= $row['fullname'];
													$email 		= $row['email'];
													$password 	= $row['password'];
													$phone 		= $row['phone'];
													$address 	= $row['address'];
													$image 		= $row['image'];
													$role 		= $row['role'];
													$status 	= $row['status'];
													$count++;

													?>

													<tr>
														<td><?php echo $count; ?></td>
														<td>
															<?php

																if (!empty($image)) {
																	?>
																	<img src="dist/img/users/<?php echo $image; ?>" width="50">
																	<?php
																}
																else { ?>
																	<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" width="50">
																<?php }

															?>
														</td>
														<td><?php echo $fullname; ?></td>
														<td><?php echo $email; ?></td>
														<td><?php echo $address; ?></td>
														<td><?php echo $phone; ?></td>
														<td><?php
															if ($role == 1) {
																echo "<span class='badge badge-danger'>Admin</span>";
															}
															else if ($role == 2) {
																echo "<span class='badge badge-success'>User</span>";
															}
														?></td>
														<td><?php
															if ($status == 1) {
																echo "<span class='badge badge-success'>Active</span>";
															}
															else if ($status == 0) {
																echo "<span class='badge badge-danger'>Inactive</span>";
															}
														?></td>
														<td>
															<a href="users.php?do=Edit&edit_id=<?php echo $user_id; ?>" ><i class="fa fa-edit"></i></a>
															<a href="" data-toggle="modal" data-target="#delete<?php echo $user_id; ?>" class="text-danger"><i class="fa fa-trash"></i></a>

															<!-- Vertically centered modal -->
                    <div class="modal fade" id="delete<?php echo $user_id; ?>" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true" >
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content modal-filled bg-light-warning" >
                          <div class="modal-body p-4">
                            <div class="text-center text-warning">
                              <i data-feather="alert-octagon" class="fill-white feather-lg" ></i>
                              <h4 class="mt-2">Are you sure to delete this category or sub category?</h4>
                              <a href="" type="button" class="btn btn-warning my-2" data-dismiss="modal" > Cancel </a>
                              <a href="users.php?do=Delete&delete_id=<?php echo $user_id; ?>" type="button" class="btn btn-warning my-2" > Confirm </a>
                            </div>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                    </div>
                    <!-- Button trigger modal -->

														</td>
													</tr>

													<?php

												}


											?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>

							<?php
						}
						//Create New User
						else if($do == 'Create') {
							?>

							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Add New User</h3>
								</div>
								<!-- /.card-header -->
								<!-- form start -->
								<form action="users.php?do=Store" method="POST" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label for="exampleInputName">FullName</label>
													<input type="text" class="form-control" id="exampleInputName" placeholder="Enter FullName" name="fullname" required="required" autocomplete="off">
												</div>
												<div class="form-group">
													<label for="exampleInputEmail">Email Address</label>
													<input type="email" class="form-control" id="exampleInputEmail" placeholder="Enter Email Address" name="email" required="required" autocomplete="off">
												</div>
												<div class="form-group">
													<label for="exampleInputPassword">Password</label>
													<input type="password" class="form-control" id="exampleInputPassword" placeholder="Enter Password" name="password" required="required" autocomplete="off">
												</div>
												<div class="form-group">
													<label for="exampleInputRePassword">Re-Type Password</label>
													<input type="password" class="form-control" id="exampleInputRePassword" placeholder="Enter Password" name="repassword" required="required" autocomplete="off">
												</div>
												<div class="form-group">
													<label for="exampleInputPhone">Phone</label>
													<input type="text" class="form-control" id="exampleInputPhone" placeholder="Enter Phone Number" name="phone" >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="exampleInputAddress">Address</label>
													<textarea  class="form-control" name="ckeditor" required="required"></textarea>
												</div>
												<div class="form-group">
													<label>User Role</label>
													<select class="form-control" name="role">
														<option value="2">Please select a role</option>
														<option value="1">Admin</option>
														<option value="2">User</option>
														
													</select>
												</div>
												<div class="form-group">
													<label>Status</label>
													<select class="form-control" name="status">
														<option value="0">Please select status</option>
														<option value="1">Active</option>
														<option value="0">Inactive</option>
													</select>
												</div>
												<div class="form-group">
													<label>Profile Picture</label>
													<input type="file" name="image" class="form-control-file" >
												</div>
												<div class="form-group">
													<input type="submit" class="btn btn-primary" value="Add New User" name="addUser">
												</div>
											</div>
										</div>
										
										
									</div>
									<!-- /.card-body -->
									
								</form>
							</div>

							<?php
						}
						//Store the user in database
						else if($do == 'Store') {
							
							if (isset($_POST['addUser'])) {

								$fullname 		= $_POST['fullname'];
								$email 			= $_POST['email'];
								$password 		= $_POST['password'];
								$repassword 	= $_POST['repassword'];
								$phone 			= $_POST['phone'];
								$address 		= mysqli_real_escape_string($db, $_POST['ckeditor']);
								$role 			= $_POST['role'];
								$status 		= $_POST['status'];

								$image_name		= $_FILES['image']['name'];
								$tmp_name		= $_FILES['image']['tmp_name'];

								if ($password == $repassword) {

									$hassedPass = sha1($password);

									$split = explode('.', $_FILES['image']['name']);
									$extn = strtolower(end($split));

									$extension = array("jpg", "jpeg", "png");
									if (in_array($extn, $extension) === true) {

										$random = rand(1, 9999999999);
										$updated_name = $random."_".$image_name;
										move_uploaded_file($tmp_name, "dist/img/users/$updated_name");

										$addSql = "INSERT INTO users (fullname, email, password, phone, address, image, role, status, join_date) VALUES ('$fullname', '$email', '$hassedPass', '$phone', '$address', '$updated_name', '$role', '$status', now()) ";
										$addSqlRes = mysqli_query($db, $addSql);
										if ($addSqlRes) {
											header('Location: users.php?do=Manage');
										}
										else {
											die("User Insertion Error!!".mysqli_error($db));
										}

									}
									else {
										echo "<span class='alert bg-danger'>File Type is not an image!!</span>";
									}

								}
								else {
									echo "<span class='alert bg-danger'>Password Not Matched!!</span>";
								}

							}

						}
						//Edit user
						else if($do == 'Edit') {
							
							if(isset($_GET['edit_id'])) {

								$edit_id = $_GET['edit_id'];

								$readSql = "SELECT * FROM users WHERE user_id = '$edit_id' ";
								$readSqlRes = mysqli_query($db, $readSql);
								while ($row = mysqli_fetch_assoc($readSqlRes)) {

									$user_id 	= $row['user_id'];
									$fullname 	= $row['fullname'];
									$email 		= $row['email'];
									$password 	= $row['password'];
									$phone 		= $row['phone'];
									$address 	= $row['address'];
									$image 		= $row['image'];
									$role 		= $row['role'];
									$status 	= $row['status'];
									?>

									<div class="card card-primary">
										<div class="card-header">
											<h3 class="card-title">Edit Existing User</h3>
										</div>
										<!-- /.card-header -->
										<!-- form start -->
										<form action="users.php?do=Update" method="POST" enctype="multipart/form-data">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="exampleInputName">FullName</label>
															<input type="text" class="form-control" id="exampleInputName" placeholder="Enter FullName" name="fullname" value="<?php echo $fullname; ?>">
														</div>
														<div class="form-group">
															<label for="exampleInputEmail">Email Address</label>
															<input type="email" class="form-control" id="exampleInputEmail" placeholder="Enter Email Address" name="email" value="<?php echo $email; ?>">
														</div>
														<div class="form-group">
															<label for="exampleInputPassword">Password</label>
															<input type="password" class="form-control" id="exampleInputPassword" placeholder="Enter Password" name="password" >
														</div>
														<div class="form-group">
															<label for="exampleInputRePassword">Re-Type Password</label>
															<input type="password" class="form-control" id="exampleInputRePassword" placeholder="Enter Password" name="repassword" >
														</div>
														<div class="form-group">
															<label for="exampleInputPhone">Phone</label>
															<input type="text" class="form-control" id="exampleInputPhone" placeholder="Enter Phone Number" name="phone" value="<?php echo $phone; ?>" >
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="exampleInputAddress">Address</label>
															<textarea  class="form-control" name="ckeditor" ><?php echo $address; ?></textarea>
														</div>
														<div class="form-group">
															<label>User Role</label>
															<select class="form-control" name="role">
																<option value="2">Please select a role</option>
																<option value="1" <?php if ($role == 1) echo "selected"; ?> >Admin</option>
																<option value="2" <?php if ($role == 2) echo "selected"; ?> >User</option>
																
															</select>
														</div>
														<div class="form-group">
															<label>Status</label>
															<select class="form-control" name="status">
																<option value="0">Please select status</option>
																<option value="1" <?php if ($status == 1) echo "selected"; ?> >Active</option>
																<option value="0" <?php if ($status == 0) echo "selected"; ?> >Inactive</option>
															</select>
														</div>
														<div class="form-group">
															<label>Profile Picture</label><br/>
															<img src="dist/img/users/<?php echo $image; ?>" width="100">
															<input type="file" name="image" class="form-control-file" >
														</div>
														<div class="form-group">
															<input type="hidden" name="updateId" value="<?php echo $user_id; ?>">
															<input type="submit" class="btn btn-primary" value="Update Existing User" name="addUser">
														</div>
													</div>
												</div>
												
												
											</div>
											<!-- /.card-body -->
											
										</form>
									</div>

									<?php
								}

							}

						}
						//Update user form database
						else if($do == 'Update') {
							
							if (isset($_POST['updateId'])) {

								$update_id 		= $_POST['updateId'];
								$fullname 		= $_POST['fullname'];
								$email 			= $_POST['email'];
								$password 		= $_POST['password'];
								$repassword 	= $_POST['repassword'];
								$phone 			= $_POST['phone'];
								$address 		= mysqli_real_escape_string($db, $_POST['ckeditor']);
								$role 			= $_POST['role'];
								$status 		= $_POST['status'];

								$image_name		= $_FILES['image']['name'];
								$tmp_name		= $_FILES['image']['tmp_name'];

								//Update All Data
								if (!empty($password) && !empty($image_name)) {

									if ($password == $repassword) {

										$hassedPass = sha1($password);

										$split = explode('.', $_FILES['image']['name']);
										$extn = strtolower(end($split));

										$extension = array("jpg", "jpeg", "png");
										if (in_array($extn, $extension) === true) {

											$random = rand(1, 9999999999);
											$updated_name = $random."_".$image_name;
											move_uploaded_file($tmp_name, "dist/img/users/$updated_name");

											$oldImgSql = "SELECT image FROM users WHERE user_id  = '$update_id' ";
											$oldImgSqlRes = mysqli_query($db, $oldImgSql);
											while ($row = mysqli_fetch_assoc($oldImgSqlRes)) {
												$oldImg = $row['image'];
											}
											unlink("dist/img/users/$oldImg");

											$updateSql = "UPDATE users SET fullname = '$fullname', email = '$email', password = '$hassedPass', phone = '$phone', address = '$address', image = '$updated_name', role = '$role', status = '$status' WHERE user_id = '$update_id' ";
											$updateSqlRes = mysqli_query($db, $updateSql);
											if ($updateSqlRes) {
												header('Location: users.php?do=Manage');
											}
											else {
												die("User Update Error!!".mysqli_error($db));
											}

										}
										else {
											echo "<span class='alert bg-danger'>File Type is not an image!!</span>";
										}

									}
									else {
										echo "<span class='alert bg-danger'>Password Not Matched!!</span>";
									}

								}
								//Update All data without Image
								else if (!empty($password) && empty($image_name)) {

									if ($password == $repassword) {

										$hassedPass = sha1($password);

										$updateSql = "UPDATE users SET fullname = '$fullname', email = '$email', password = '$hassedPass', phone = '$phone', address = '$address', role = '$role', status = '$status' WHERE user_id = '$update_id' ";
										$updateSqlRes = mysqli_query($db, $updateSql);
										if ($updateSqlRes) {
											header('Location: users.php?do=Manage');
										}
										else {
											die("User Update Error!!".mysqli_error($db));
										}

									}
									else {
										echo "<span class='alert bg-danger'>Password Not Matched!!</span>";
									}

								}
								//Update All data without Password
								else if (empty($password) && !empty($image_name)) {
									
									$split = explode('.', $_FILES['image']['name']);
									$extn = strtolower(end($split));

									$extension = array("jpg", "jpeg", "png");
									if (in_array($extn, $extension) === true) {

										$random = rand(1, 9999999999);
										$updated_name = $random."_".$image_name;
										move_uploaded_file($tmp_name, "dist/img/users/$updated_name");

										$oldImgSql = "SELECT image FROM users WHERE user_id  = '$update_id' ";
										$oldImgSqlRes = mysqli_query($db, $oldImgSql);
										while ($row = mysqli_fetch_assoc($oldImgSqlRes)) {
											$oldImg = $row['image'];
										}
										unlink("dist/img/users/$oldImg");

										$updateSql = "UPDATE users SET fullname = '$fullname', email = '$email', phone = '$phone', address = '$address', image = '$updated_name', role = '$role', status = '$status' WHERE user_id = '$update_id' ";
										$updateSqlRes = mysqli_query($db, $updateSql);
										if ($updateSqlRes) {
											header('Location: users.php?do=Manage');
										}
										else {
											die("User Update Error!!".mysqli_error($db));
										}

									}
									else {
										echo "<span class='alert bg-danger'>File Type is not an image!!</span>";
									}

								}
								//Update All data without password and image
								else if (empty($password) && empty($image_name)) {
									
									$updateSql = "UPDATE users SET fullname = '$fullname', email = '$email', phone = '$phone', address = '$address', role = '$role', status = '$status' WHERE user_id = '$update_id' ";
									$updateSqlRes = mysqli_query($db, $updateSql);
									if ($updateSqlRes) {
										header('Location: users.php?do=Manage');
									}
									else {
										die("User Update Error!!".mysqli_error($db));
									}

								}


							}

						}
						//Delete an existing user
						else if($do == 'Delete') {
							
							if (isset($_GET['delete_id'])) {

								$del_id = $_GET['delete_id'];

								$oldImgSql = "SELECT image FROM users WHERE user_id  = '$del_id' ";
								$oldImgSqlRes = mysqli_query($db, $oldImgSql);
								while ($row = mysqli_fetch_assoc($oldImgSqlRes)) {
									$oldImg = $row['image'];
								}
								unlink("dist/img/users/$oldImg");

								$delSql = "DELETE FROM users WHERE user_id  = '$del_id' ";
								$delSqlRes = mysqli_query($db, $delSql);

								if ($delSqlRes) {
									header('Location: users.php?do=Manage');
								}
								else {
									die("User Delete Error!!".mysqli_error($db));
								}

							}

						}

					?>
				</div>
			</div>
		</div>
	</section>


<?php

  include "inc/footer.php";

?>