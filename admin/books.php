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
					<h1 class="m-0">All Books Management</h1>
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

						$do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;

						//Manage All Books
						if ($do == "Manage") {
							?>
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Manage All Books</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table class="table table-bordered table-striped table-hover" id="datatable">
										<thead class="table-info">
											<tr>
												<th >#</th>
												<th>Thumbnail</th>
												<th>Title</th>
												<th>Sub Title</th>
												<th>Author Name</th>
												<th>Category / Sub Category</th>
												<th>Quantity</th>
												<th>Shelf No</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php

												$bookSql = "SELECT * FROM book";
												$bookSqlRes = mysqli_query($db, $bookSql);
												$count = 0;
												while ($row = mysqli_fetch_assoc($bookSqlRes)) {

													$id  			= $row['id'];
													$title 			= $row['title'];
													$sub_title 		= $row['sub_title'];
													$description 	= $row['description'];
													$cat_id 		= $row['cat_id'];
													$shelf_no 		= $row['shelf_no'];
													$author_name 	= $row['author_name'];
													$quantity 		= $row['quantity'];
													$image 			= $row['image'];
													$status 		= $row['status'];

													$count++;
													?>

													<tr>
														<td><?php echo $count; ?></td>
														<td><?php

															if (!empty($image)) {
																?>
																<img src="dist/img/books/<?php echo $image?>" width="60">
																<?php
															}
															else {
																?>
																<p>NULL</p>
																<?php
															}

														?></td>
														<td><?php echo $title; ?></td>
														<td><?php echo $sub_title; ?></td>
														<td><?php echo $author_name; ?></td>
														<td><?php 

						                                    $catSql = "SELECT * FROM category WHERE cat_id = '$cat_id'";
						                                    $catRes = mysqli_query($db, $catSql);
						                                    while ($row = mysqli_fetch_assoc($catRes)) {
						                                      $cat_id     = $row['cat_id'];
						                                      $cat_name   = $row['cat_name'];
						                                      ?>
						                                      <span class="badge badge-info"><?php echo $cat_name; ?></span>
						                                      <?php
						                                    }


						                                  ?></td>
														<td><?php echo $quantity; ?> PCs</td>
														<td><?php echo $shelf_no; ?></td>
														<td><?php

															if ($status == 1) {
																echo "<span class='badge badge-success'>Active</span>";
															}
															else if ($status == 2) {
																echo "<span class='badge badge-danger'>Inactive</span>";
															}

														?></td>
														<td>
															<a href="books.php?do=Edit&edit_id=<?php echo $id; ?>" ><i class="fa fa-edit"></i></a>
															<a href="" data-toggle="modal" data-target="#delete<?php echo $id; ?>" class="text-danger"><i class="fa fa-trash"></i></a>
															<!-- Vertically centered modal -->
                    <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true" >
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content modal-filled bg-light-warning" >
                          <div class="modal-body p-4">
                            <div class="text-center text-warning">
                              <i data-feather="alert-octagon" class="fill-white feather-lg" ></i>
                              <h4 class="mt-2">Are you sure to delete this category or sub category?</h4>
                              <a href="" type="button" class="btn btn-warning my-2" data-dismiss="modal" > Cancel </a>
                              <a href="books.php?do=Delete&delete_id=<?php echo $id; ?>" type="button" class="btn btn-warning my-2" > Confirm </a>
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
						//Create New Book
						else if ($do == "Create") {
							?>

							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Add New Book</h3>
								</div>
								<!-- /.card-header -->
								<!-- form start -->
								<form action="books.php?do=Store" method="POST" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label for="exampleInputTitle">Title</label>
													<input type="text" class="form-control" id="exampleInputTitle" placeholder="Enter Title" name="title" required="required" autocomplete="off">
												</div>
												<div class="form-group">
													<label >Sub Title</label>
													<input type="text" class="form-control" placeholder="Enter Sub Title" name="subtitle" >
												</div>
												<div class="form-group">
													<label for="exampleInputAuthor">Author Name</label>
													<input type="text" class="form-control" id="exampleInputAuthor" placeholder="Enter Author Name" name="author" >
												</div>
												<div class="form-group">
				                                    <label>Quantity</label>
				                                    <input type="text" name="quantity" class="form-control" placeholder="Quantity" required="required" autocomplete="off">
				                                </div>
												<div class="form-group">
													<label>Category / Sub Category</label>
													<select class="form-control" name="category">
														<option value="">Please select category / sub category</option>
														<?php

															$pCatSql = "SELECT * FROM category WHERE is_parent = 0 ORDER BY cat_name ASC ";
															$pCatSqlRes = mysqli_query($db, $pCatSql);
															while ($row = mysqli_fetch_assoc($pCatSqlRes)) {

																$pCatId 	= $row['cat_id'];
																$pCatName 	= $row['cat_name'];
																?>

																<option value="<?php echo $pCatId; ?>"><?php echo $pCatName; ?></option>

																<?php

																$sCatSql = "SELECT * FROM category WHERE is_parent = '$pCatId' ORDER BY cat_name ASC ";
																$sCatSqlRes = mysqli_query($db, $sCatSql);
																while ($row = mysqli_fetch_assoc($sCatSqlRes)) {

																	$sCatId 	= $row['cat_id'];
																	$sCatName 	= $row['cat_name'];
																	?>

																	<option value="<?php echo $sCatId; ?>">--<?php echo $sCatName; ?></option>

																	<?php
																}

															}

														?>
														
													</select>
												</div>
												<div class="form-group">
				                                    <label>Shelf No</label>
				                                    <input type="text" name="shelf_no" class="form-control" placeholder="Shelf NO" >
				                                </div>

											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Description</label>
													<textarea class="form-control" name="ckeditor"></textarea>
												</div>
												<div class="form-group">
													<label>Status</label>
													<select class="form-control" name="status">
														<option value="1">Please select status</option>
														<option value="1">Active</option>
														<option value="2">Inactive</option>
													</select>
												</div>
												<div class="form-group">
													<label>Profile Picture</label>
													<input type="file" name="image" class="form-control-file" >
												</div>
												<div class="form-group">
													<input type="submit" class="btn btn-primary" value="Register New Book" name="addBook">
												</div>
											</div>
										</div>
										
										
									</div>
									<!-- /.card-body -->
									
								</form>
							</div>

							<?php
						}
						//Store new book in database
						else if ($do == "Store") {

							if (isset($_POST['addBook'])) {

								$title 			= mysqli_real_escape_string($db, $_POST['title']);
								$subtitle 		= mysqli_real_escape_string($db, $_POST['subtitle']);
								$author 		= $_POST['author'];
								$quantity 		= $_POST['quantity'];
								$category 		= $_POST['category'];
								$shelf_no 		= $_POST['shelf_no'];
								$description 	= mysqli_real_escape_string($db, $_POST['ckeditor']);
								$status 		= $_POST['status'];

								$image_name 	= $_FILES['image']['name'];
								$tmp_name 		= $_FILES['image']['tmp_name'];

								if(!empty($image_name)) {

									$split = explode('.', $_FILES['image']['name']);
									$extn = strtolower(end($split));

									$extension = array("jpg", "jpeg", "png");
									if (in_array($extn, $extension) === true) {

										$random = rand(1, 9999999999);
										$updated_name = $random."_".$image_name;
										move_uploaded_file($tmp_name, "dist/img/books/$updated_name");

										$bookSql = "INSERT INTO book (title, sub_title, description, cat_id, shelf_no, author_name, quantity, image, status) VALUES ('$title', '$subtitle', '$description', '$category', '$shelf_no', '$author', '$quantity', '$updated_name', '$status') ";
										$bookSqlRes = mysqli_query($db, $bookSql);
										if($bookSqlRes) {
											header('Location: books.php?do=Manage');
										}
										else {
											die("Book Insert Error!!".mysqli_error($db));
										}

									}
									else {
										echo "<span class='alert bg-danger'>File Type is not an image!!</span>";
									}

								}
								else {

									$bookSql = "INSERT INTO book (title, sub_title, description, cat_id, shelf_no, author_name, quantity, status) VALUES ('$title', '$subtitle', '$description', '$category', '$shelf_no', '$author', '$quantity', '$status') ";
									$bookSqlRes = mysqli_query($db, $bookSql);
									if($bookSqlRes) {
										header('Location: books.php?do=Manage');
									}
									else {
										die("Book Insert Error!!".mysqli_error($db));
									}

								}

							}

						}
						//Edit existing book
						else if ($do == "Edit") {

							if (isset($_GET['edit_id'])) {

								$edit_id = $_GET['edit_id'];

								$bookSql = "SELECT * FROM book WHERE id = '$edit_id' ";
								$bookSqlRes = mysqli_query($db, $bookSql);
								while ($row = mysqli_fetch_assoc($bookSqlRes)) {

									$id  			= $row['id'];
									$title 			= $row['title'];
									$sub_title 		= $row['sub_title'];
									$description 	= $row['description'];
									$cat_id 		= $row['cat_id'];
									$shelf_no 		= $row['shelf_no'];
									$author_name 	= $row['author_name'];
									$quantity 		= $row['quantity'];
									$image 			= $row['image'];
									$status 		= $row['status'];
									?>

									<div class="card card-primary">
										<div class="card-header">
											<h3 class="card-title">Edit Existing Book</h3>
										</div>
										<!-- /.card-header -->
										<!-- form start -->
										<form action="books.php?do=Update" method="POST" enctype="multipart/form-data">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="exampleInputTitle">Title</label>
															<input type="text" class="form-control" id="exampleInputTitle" placeholder="Enter Title" name="title" value="<?php echo $title; ?>">
														</div>
														<div class="form-group">
															<label >Sub Title</label>
															<input type="text" class="form-control" placeholder="Enter Sub Title" name="subtitle" value="<?php echo $sub_title; ?>" >
														</div>
														<div class="form-group">
															<label for="exampleInputAuthor">Author Name</label>
															<input type="text" class="form-control" id="exampleInputAuthor" placeholder="Enter Author Name" name="author" value="<?php echo $author_name; ?>" >
														</div>
														<div class="form-group">
						                                    <label>Quantity</label>
						                                    <input type="text" name="quantity" class="form-control" placeholder="Quantity" value="<?php echo $quantity; ?>" >
						                                </div>
														<div class="form-group">
															<label>Category / Sub Category</label>
															<select class="form-control" name="category">
																<option value="">Please select category / sub category</option>
																<?php

																	$pCatSql = "SELECT * FROM category WHERE is_parent = 0 ORDER BY cat_name ASC ";
																	$pCatSqlRes = mysqli_query($db, $pCatSql);
																	while ($row = mysqli_fetch_assoc($pCatSqlRes)) {

																		$pCatId 	= $row['cat_id'];
																		$pCatName 	= $row['cat_name'];
																		?>

																		<option value="<?php echo $pCatId; ?>" <?php if ($cat_id == $pCatId) echo "selected"; ?> ><?php echo $pCatName; ?></option>

																		<?php

																		$sCatSql = "SELECT * FROM category WHERE is_parent = '$pCatId' ORDER BY cat_name ASC ";
																		$sCatSqlRes = mysqli_query($db, $sCatSql);
																		while ($row = mysqli_fetch_assoc($sCatSqlRes)) {

																			$sCatId 	= $row['cat_id'];
																			$sCatName 	= $row['cat_name'];
																			?>

																			<option value="<?php echo $sCatId; ?>" <?php if ($cat_id == $sCatId) echo "selected"; ?> >--<?php echo $sCatName; ?></option>

																			<?php
																		}

																	}

																?>
																
															</select>
														</div>
														<div class="form-group">
						                                    <label>Shelf No</label>
						                                    <input type="text" name="shelf_no" class="form-control" placeholder="Shelf NO" value="<?php echo $shelf_no; ?>" >
						                                </div>

													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label>Description</label>
															<textarea class="form-control" name="ckeditor"><?php echo $description; ?></textarea>
														</div>
														<div class="form-group">
															<label>Status</label>
															<select class="form-control" name="status">
																<option value="1">Please select status</option>
																<option value="1"<?php if ($status == 1) echo "selected"; ?>>Active</option>
																<option value="2"<?php if ($status == 2) echo "selected"; ?>>Inactive</option>
															</select>
														</div>
														<div class="form-group">
															<label>Profile Picture</label><br/>
															<?php

																if (!empty($image)) {
																	?>
																	<img src="dist/img/books/<?php echo $image; ?>" width="50">
																	<?php
																}
																else {
																	?>
																	<p>No Image Found for this book. Please insert an image.</p>
																	<?php
																}

															?>
															
															<input type="file" name="image" class="form-control-file" >
														</div>
														<div class="form-group">
															<input type="hidden" name="updateId" value="<?php echo $edit_id; ?>">
															<input type="submit" class="btn btn-primary" value="Update Existing Book" name="updateBook">
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
						//Update existing book
						else if ($do == "Update") {

							if (isset($_POST['updateBook'])) {

								$updateId 		= $_POST['updateId'];
								$title 			= $_POST['title'];
								$subtitle 		= $_POST['subtitle'];
								$author 		= $_POST['author'];
								$quantity 		= $_POST['quantity'];
								$category 		= $_POST['category'];
								$shelf_no 		= $_POST['shelf_no'];
								$description 	= $_POST['ckeditor'];
								$status 		= $_POST['status'];

								$image_name 	= $_FILES['image']['name'];
								$tmp_name 		= $_FILES['image']['tmp_name'];

								if (!empty($image_name)) {

									$split = explode('.', $_FILES['image']['name']);
									$extn = strtolower(end($split));

									$extension = array("jpg", "jpeg", "png");
									if (in_array($extn, $extension) === true) {

										$random = rand(1, 9999999999);
										$updated_name = $random."_".$image_name;
										move_uploaded_file($tmp_name, "dist/img/books/$updated_name");

										$oldImg = "SELECT image FROM book WHERE id = '$updateId' ";
				                        $oldImgRes = mysqli_query($db, $oldImg);
				                        while ($row = mysqli_fetch_assoc($oldImgRes)) {
				                          $imgName = $row['image'];
				                        }
				                        if (!empty($imgName)) {
				                        	unlink('dist/img/books/'.$imgName);
				                        }

				                        $updateBook = "UPDATE book SET title = '$title', sub_title = '$subtitle', description = '$description', cat_id ='$category', shelf_no = '$shelf_no', author_name = '$author', quantity = '$quantity', image = '$updated_name', status = '$status' WHERE id = '$updateId' ";
				                        $updateRes = mysqli_query($db, $updateBook);
				                        if ($updateRes) {
				                          header('Location: books.php?do=Manage');
				                        }
				                        else {
				                          die("Book Update Error!!".mysqli_error($db));
				                        }

									}
									else {
										echo "<span class='alert bg-danger'>File Type is not an image!!</span>";
									}

								}
								else {

									$updateBook = "UPDATE book SET title = '$title', sub_title = '$subtitle', description = '$description', cat_id ='$category', shelf_no = '$shelf_no', author_name = '$author', quantity = '$quantity', status = '$status' WHERE id = '$updateId' ";
			                        $updateRes = mysqli_query($db, $updateBook);
			                        if ($updateRes) {
			                          header('Location: books.php?do=Manage');
			                        }
			                        else {
			                          die("Book Update Error!!".mysqli_error($db));
			                        }

								}

							}

						}
						//Delete a specific book
						else if ($do == "Delete") {

							if (isset($_GET['delete_id'])) {

								$del_id = $_GET['delete_id'];

								$oldImg = "SELECT image FROM book WHERE id = '$del_id' ";
			                    $oldImgRes = mysqli_query($db, $oldImg);
			                    while ($row = mysqli_fetch_assoc($oldImgRes)) {
			                      $imgName = $row['image'];
			                    }
			                    if (!empty($imgName)) {
			                    	unlink('dist/img/books/'.$imgName);
			                    }

			                    $delSql = "DELETE FROM book WHERE id = '$del_id' ";
			                    $delRes = mysqli_query($db, $delSql);

			                    if ($delRes) {
			                      header('Location: books.php?do=Manage');
			                    }
			                    else {
			                      die("Book Delete error!!".mysqli_error($db));
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