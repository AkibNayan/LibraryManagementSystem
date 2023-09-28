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
					<h1 class="m-0">Category Manage</h1>
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
				<div class="col-lg-12 col-lg-12">

					<?php

						$do = isset($_GET['do']) ? $_GET['do'] : "Manage" ;

						if ($do == "Manage") {
							
							?>

							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Manage All Category</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table class="table table-bordered table-striped table-hover" id="datatable">
										<thead class="table-info">
											<tr>
												<th >#</th>
												<th>Category Name</th>
												<th>Description</th>
												<th>Parent Category / Sub Category</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php

												$catSql = "SELECT * FROM category";
												$catRes = mysqli_query($db, $catSql);
												$count = 0;
												while ($row = mysqli_fetch_assoc($catRes)) {

													$cat_id 		= $row['cat_id'];
													$cat_name 		= $row['cat_name'];
													$cat_desc 		= $row['cat_desc'];
													$is_parent 		= $row['is_parent'];
													$cat_status 	= $row['cat_status'];

													$count++;
													?>

													<tr>
														<td><?php echo $count; ?></td>
														<td><?php echo $cat_name; ?></td>
														<td><?php echo $cat_desc; ?></td>
														<td>
															<?php
																if ($is_parent == 0) {
																	echo "<span class='badge badge-success'>Primary</span>";
																}
																else {
																	echo "<span class='badge badge-primary'>Sub Category</span>";
																}
															?>
														</td>
														<td>
															<?php
																if ($cat_status == 1) {
																	echo "<span class='badge badge-success'>Active</span>";
																}
																else if ($cat_status == 2) {
																	echo "<span class='badge badge-danger'>Inactive</span>";
																}
															?>
														</td>
														<td>
															<a href="category.php?do=Edit&edit_id=<?php echo $cat_id; ?>" ><i class="fa fa-edit"></i></a>
															<a href="" data-toggle="modal" data-target="#delete<?php echo $cat_id; ?>" class="text-danger"><i class="fa fa-trash"></i></a>

															<!-- Vertically centered modal -->
                    <div class="modal fade" id="delete<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true" >
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content modal-filled bg-light-warning" >
                          <div class="modal-body p-4">
                            <div class="text-center text-warning">
                              <i data-feather="alert-octagon" class="fill-white feather-lg" ></i>
                              <h4 class="mt-2">Are you sure to delete this category or sub category?</h4>
                              <a href="" type="button" class="btn btn-warning my-2" data-dismiss="modal" > Cancel </a>
                              <a href="category.php?do=Delete&delete_id=<?php echo $cat_id; ?>" type="button" class="btn btn-warning my-2" > Confirm </a>
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
						else if ($do == "Create") {
							?>

							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Add New Category</h3>
								</div>
								<!-- /.card-header -->
								<!-- form start -->
								<form action="category.php?do=Store" method="POST">
									<div class="card-body">
										<div class="form-group">
											<label for="exampleInputName">Category Name</label>
											<input type="text" class="form-control" id="exampleInputName" placeholder="Enter Category Name" name="cat_name" required="required" autocomplete="off">
										</div>
										<div class="form-group">
											<label for="exampleInputName">Category Description</label>
											<textarea rows="5" class="form-control" name="cat_desc" required="required"></textarea>
										</div>
										<div class="form-group">
											<select class="form-control" name="is_parent">
												<option value="0">Please select category or sub category</option>
												<?php

													$parentSql = "SELECT cat_id AS 'p_cat_id', cat_name AS 'p_cat_name' FROM category WHERE is_parent = 0 ";
													$parentSqlRes = mysqli_query($db, $parentSql);
													while ($row = mysqli_fetch_assoc($parentSqlRes)) {
														extract($row);
														?>
														<option value="<?php echo $p_cat_id; ?>"><?php echo $p_cat_name; ?></option>
														<?php
														
													}

												?>
											</select>
										</div>
										<div class="form-group">
											<select class="form-control" name="cat_status">
												<option value="1">Please select status</option>
												<option value="1">Active</option>
												<option value="2">Inactive</option>
											</select>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-primary" value="Add Category" name="addCat">
										</div>
									</div>
									<!-- /.card-body -->
									
								</form>
							</div>

							<?php
						}
						else if ($do == "Store") {
							
							if (isset($_POST['addCat'])) {

								$cat_name 		= $_POST['cat_name'];
								$cat_desc 		= $_POST['cat_desc'];
								$is_parent 		= $_POST['is_parent'];
								$cat_status 	= $_POST['cat_status'];

								$addSql = "INSERT INTO category (cat_name, cat_desc, is_parent, cat_status) VALUES ('$cat_name', '$cat_desc', '$is_parent', '$cat_status') ";
								$addSqlRes = mysqli_query($db, $addSql);

								if ($addSqlRes) {
									header('Location: category.php?do=Manage');
								}
								else {
									die("Category Insertion Error!!".mysqli_error($db));
								}


							}

						}
						else if ($do == "Edit") {
							
							if (isset($_GET['edit_id'])) {

								$edit_id = $_GET['edit_id'];

								$catSql = "SELECT * FROM category WHERE cat_id = '$edit_id' " ;
								$catRes = mysqli_query($db, $catSql);
								while ($row = mysqli_fetch_assoc($catRes)) {

									$cat_id 		= $row['cat_id'];
									$cat_name 		= $row['cat_name'];
									$cat_desc 		= $row['cat_desc'];
									$is_parent 		= $row['is_parent'];
									$cat_status 	= $row['cat_status'];
									?>

									<div class="card card-primary">
										<div class="card-header">
											<h3 class="card-title">Edit Category</h3>
										</div>
										<!-- /.card-header -->
										<!-- form start -->
										<form action="category.php?do=Update" method="POST">
											<div class="card-body">
												<div class="form-group">
													<label for="exampleInputName">Category Name</label>
													<input type="text" class="form-control" id="exampleInputName" placeholder="Enter Category Name" name="cat_name" required="required" autocomplete="off" value="<?php echo $cat_name; ?>">
												</div>
												<div class="form-group">
													<label for="exampleInputName">Category Description</label>
													<textarea rows="5" class="form-control" name="cat_desc" required="required"><?php echo $cat_desc; ?></textarea>
												</div>
												<div class="form-group">
													<select class="form-control" name="is_parent">
														<option value="0">Please select category or sub category</option>
														<?php

															if ($is_parent == 0) {

																$parentSql = "SELECT cat_id AS 'p_cat_id', cat_name AS 'p_cat_name' FROM category WHERE is_parent = 0 ";
																$parentSqlRes = mysqli_query($db, $parentSql);
																while ($row = mysqli_fetch_assoc($parentSqlRes)) {
																	extract($row);
																	?>
																	<option <?php if ($p_cat_id == $cat_id) echo "selected"; ?> value = "0" ><?php echo $p_cat_name; ?></option>
																	<?php
																}

															}
															else {
																$parentSql = "SELECT cat_id AS 'p_cat_id', cat_name AS 'p_cat_name' FROM category WHERE is_parent = 0 ";
																$parentSqlRes = mysqli_query($db, $parentSql);
																while ($row = mysqli_fetch_assoc($parentSqlRes)) {
																	extract($row);
																	?>
																	<option <?php if ($p_cat_id == $is_parent) echo "selected"; ?> value="<?php echo $p_cat_id; ?>" ><?php echo $p_cat_name; ?></option>
																	<?php
																}
															}

														?>
													</select>
												</div>
												<div class="form-group">
													<select class="form-control" name="cat_status">
														<option value="1">Please select status</option>
														<option value="1" <?php if ($cat_status == 1) echo "selected"; ?> >Active</option>
														<option value="2" <?php if ($cat_status == 2) echo "selected"; ?> >Inactive</option>
													</select>
												</div>
												<div class="form-group">
													<input type="hidden" name="updatedId" value="<?php echo $cat_id; ?>">
													<input type="submit" class="btn btn-primary" value="Update Category" name="updateCat">
												</div>
											</div>
											<!-- /.card-body -->
											
										</form>
									</div>

									<?php
								}

							}

						}
						else if ($do == "Update") {
							
							if (isset($_POST['updateCat'])) {

								$updatedId 		= $_POST['updatedId'];
								$cat_name 		= $_POST['cat_name'];
								$cat_desc 		= $_POST['cat_desc'];
								$is_parent 		= $_POST['is_parent'];
								$cat_status 	= $_POST['cat_status'];

								$updateSql = "UPDATE category SET cat_name = '$cat_name', cat_desc = '$cat_desc', is_parent = '$is_parent', cat_status = '$cat_status' WHERE cat_id  = '$updatedId' ";
								$updateSqlRes = mysqli_query($db, $updateSql);

								if ($updateSqlRes) {
									header('Location: category.php?do=Manage');
								}
								else {
									die("Category Update Error!!".mysqli_error($db));
								}

							}

						}
						else if ($do == "Delete") {
							
							if (isset($_GET['delete_id'])) {

								$del_id = $_GET['delete_id'];

								$readSql = "SELECT * FROM category WHERE cat_id = '$del_id' ";
								$readSqlRes = mysqli_query($db, $readSql);
								while ($row = mysqli_fetch_assoc($readSqlRes)) {

									$cat_id 		= $row['cat_id'];
									$cat_name 		= $row['cat_name'];
									$cat_desc 		= $row['cat_desc'];
									$is_parent 		= $row['is_parent'];
									$cat_status 	= $row['cat_status'];

								}
								if ($is_parent != 0) {

									$subSql = "DELETE FROM category WHERE cat_id = '$del_id' ";
									$subSqlRes = mysqli_query($db, $subSql);
									if ($subSqlRes) {
										header('Location: category.php?do=Manage');
									}
									else {
										die("Sub Category delete error!!".mysqli_error($db));
									}
								}
								else if ($is_parent == 0) {
									//First delete the sub category related to parent
									$parentSub = "DELETE FROM category WHERE is_parent = '$del_id' ";
									$parentSubRes = mysqli_query($db, $parentSub);
									if ($parentSubRes) {
										header('Location: category.php?do=Manage');
									}
									else{
										die("Parent Sub Category delete error!!".mysqli_error($db));
									}
									//Then delete the parent category
									$parentDel = "DELETE FROM category WHERE cat_id = '$del_id' ";
									$parentDelRes = mysqli_query($db, $parentDel);
									if ($parentDelRes) {
										header('Location: category.php?do=Manage');
									}
									else{
										die("Parent Category delete error!!".mysqli_error($db));
									}

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