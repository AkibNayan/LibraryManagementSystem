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
					<h1 class="m-0">Manage All Orders</h1>
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

						if ($do == 'Manage') {
							?>

							<table class="table table-bordered table-striped table-hover" id="datatable">
								<thead>
									<tr>
										<th>#Sl.</th>
										<th>Book Title</th>
										<th>Username</th>
										<th>Order Date</th>
										<th>Receive Date</th>
										<th>Return Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php

										$bookingSql = "SELECT * FROM booking_list ORDER BY id DESC";
										$bookingSqlRes = mysqli_query($db, $bookingSql);
										$count = 0;

										while ($row = mysqli_fetch_assoc($bookingSqlRes)) {

											$id       		= $row['id'];
						                    $book_id    	= $row['book_id'];
						                    $user_id    	= $row['user_id'];
						                    $rcv_date     	= $row['rcv_date'];
						                    $rtn_date     	= $row['rtn_date'];
						                    $booking_date   = $row['booking_date'];
						                    $status     	= $row['status'];
						                    $count++;
						                    ?>

						                    <tr>
												<td><?php echo $count; ?></td>
												<td>
													<?php

														$bookSql = "SELECT title FROM book WHERE id = '$book_id' ";
														$bookSqlRes = mysqli_query($db, $bookSql);
														while ($row = mysqli_fetch_assoc($bookSqlRes)) {
															$title = $row['title'];
														}
														echo $title;

													?>
												</td>
												<td>
													<?php

														$userSql = "SELECT fullname FROM users WHERE user_id = '$user_id' ";
														$userSqlRes = mysqli_query($db, $userSql);
														while ($row = mysqli_fetch_assoc($userSqlRes)) {
															$fullname = $row['fullname'];
														}
														echo $fullname;

													?>
												</td>
												<td><?php echo $booking_date; ?></td>
												<td><span class="badge bg-warning"><?php echo $rcv_date; ?></span></td>
												<td><span class="badge bg-warning"><?php echo $rtn_date; ?></span></td>
												<td>
													<?php

														if ($status == 1) {
															echo "<span class='badge bg-info'>Active Booking</span>";
														}
														else if ($status ==2) {
															echo "<span class='badge bg-success'>Returned Book</span>";
														}
														else if ($status == 3) {
															echo "<span class='badge bg-danger'>Cancel</span>";
														}
														else if ($status == 4) {
															echo "<span class='badge bg-warning'>Pending</span>";
														}

													?>
												</td>
												<td class="order-action">
					                                <a href="order-details.php?do=Edit&edit_id=<?php echo $id; ?>" style="margin-right:6px;"><i class="fa fa-edit"></i></a>
					                                <a href="" data-toggle="modal" data-target="#deleteBooking<?php echo $id; ?>"><i class="fa fa-trash"></i></a>

					                              <!-- Vertically centered delete modal -->
					                          <div class="modal fade" id="deleteBooking<?php echo $id; ?>" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
					                            <div class="modal-dialog modal-sm">
					                              <div class="modal-content modal-filled bg-danger">
					                                <div class="modal-body p-4">
					                                  <div class="text-center text-light">
					                                    <i data-feather="x-octagon" class="fill-white feather-lg"></i>
					                                    <h5 class="mb-3">
					                                      Are you sure to delete this Booking!!
					                                    </h5>
					                                    <a type="button" class="btn btn-success my-2" data-dismiss="modal">Cancel</a>
					                                    <a href="order-details.php?do=Delete&delete_id=<?php echo $id; ?>" type="button" class="btn btn-light my-2">Confirm</a>
					                                  </div>
					                                </div>
					                              </div>
					                              <!-- /.modal-content -->
					                            </div>
					                          </div>

					                            </td>
											</tr>

						                    <?php

										}

									?>
									
								</tbody>
							</table>

							<?php
						}
						else if ($do == 'Edit') {

							if (isset($_GET['edit_id'])) {

								$order_id = $_GET['edit_id'];

								$bookingSql = "SELECT * FROM booking_list WHERE id = '$order_id'";
								$bookingSqlRes = mysqli_query($db, $bookingSql);
								while ($row = mysqli_fetch_assoc($bookingSqlRes)) {

									$id             = $row['id'];
				                    $book_id        = $row['book_id'];
				                    $user_id        = $row['user_id'];
				                    $rcv_date       = $row['rcv_date'];
				                    $rtn_date       = $row['rtn_date'];
				                    $booking_date   = $row['booking_date'];
				                    $status         = $row['status'];

				                    ?>

				                    <div class="booking-form">
						 				<form action="order-details.php?do=Update" method="POST" >
							 				<div class="row">
							 					<div class="col-lg-6 offset-3">
							 						<div class="mb-3">
							 							<label>Receive Date</label>
							 							<input type="text" name="rcv_date" id="datepicker" class="form-control" placeholder="Receive Date" value="<?php echo $rcv_date; ?>">
							 						</div>
							 						<div class="mb-3">
							 							<label>Return Date</label>
							 							<input type="text" name="rtn_date" id="rtndatepicker" class="form-control" placeholder="Return Date" value="<?php echo $rtn_date; ?>">
							 						</div>
							 						<div class="mb-3">
							 							<select name = "status" class="form-control">
							 								<option value="4">Please select booking status</option>
							 								<option value="1" <?php if ($status == 1) echo "selected"; ?> >Active</option>
							 								<option value="2" <?php if ($status == 2) echo "selected"; ?> >Returned</option>
							 								<option value="3" <?php if ($status == 3) echo "selected"; ?> >Cancel</option>
							 								<option value="4" <?php if ($status == 4) echo "selected"; ?> >Pending</option>
							 							</select>
							 						</div>
							 						<div class="mb-3">
							 							<input type="hidden" name="booking_id" value="<?php echo $id; ?>">
							 							<input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
							 							<button type="submit" name="updateOrder" class="book-btn">Save Changes</button> 
							 						</div>
							 					</div>
							 				</div>
							 			</form>
						 			</div>

				                    <?php
								}

							}

						}
						else if ($do == 'Update') {

							if (isset($_POST['updateOrder'])) {

								$booking_id 	= $_POST['booking_id'];
								$book_id 		= $_POST['book_id'];
								$rcv_date 		= date('Y-m-d', strtotime($_POST['rcv_date']));
								$rtn_date 		= date('Y-m-d', strtotime($_POST['rtn_date']));
								$status 		= $_POST['status'];

								if ($status == 1) {

									$updateSql = "UPDATE booking_list SET rcv_date = '$rcv_date', rtn_date = '$rtn_date', status = '$status' WHERE id = '$booking_id' ";
									$updateSqlRes = mysqli_query($db, $updateSql);

									$bookSql = "SELECT * FROM book WHERE id = '$book_id' ";
									$bookSqlRes = mysqli_query($db, $bookSql);
									while ($row = mysqli_fetch_assoc($bookSqlRes)) {
										$quantity = $row['quantity'];
										$quantity--;
									}
									$bookUpdate = "UPDATE book SET quantity = '$quantity' WHERE id = '$book_id' ";
									$bookUpdateRes = mysqli_query($db, $bookUpdate);

									if ($updateSqlRes) {
										header('Location: order-details.php?do=Manage');
									}
									else {
										die("Booking Order Error!!".mysqli_error($db));
									}

								}
								else if ($status == 2) {

									$updateSql = "UPDATE booking_list SET rcv_date = '$rcv_date', rtn_date = '$rtn_date', status = '$status' WHERE id = '$booking_id' ";
									$updateSqlRes = mysqli_query($db, $updateSql);

									$bookSql = "SELECT * FROM book WHERE id = '$book_id' ";
									$bookSqlRes = mysqli_query($db, $bookSql);
									while ($row = mysqli_fetch_assoc($bookSqlRes)) {
										$quantity = $row['quantity'];
										$quantity++;
									}
									$bookUpdate = "UPDATE book SET quantity = '$quantity' WHERE id = '$book_id' ";
									$bookUpdateRes = mysqli_query($db, $bookUpdate);

									if ($updateSqlRes) {
										header('Location: order-details.php?do=Manage');
									}
									else {
										die("Booking Order Error!!".mysqli_error($db));
									}

								}
								else if ($status == 3) {

									$updateSql = "UPDATE booking_list SET rcv_date = '$rcv_date', rtn_date = '$rtn_date', status = '$status' WHERE id = '$booking_id' ";
									$updateSqlRes = mysqli_query($db, $updateSql);

									if ($updateSqlRes) {
										header('Location: order-details.php?do=Manage');
									}
									else {
										die("Booking Order Error!!".mysqli_error($db));
									}

								}
								else if ($status == 4) {

									$updateSql = "UPDATE booking_list SET rcv_date = '$rcv_date', rtn_date = '$rtn_date', status = '$status' WHERE id = '$booking_id' ";
									$updateSqlRes = mysqli_query($db, $updateSql);

									if ($updateSqlRes) {
										header('Location: order-details.php?do=Manage');
									}
									else {
										die("Booking Order Error!!".mysqli_error($db));
									}

								}


							}

						}
						else if ($do == 'Delete') {

							if (isset($_GET['delete_id'])) {

								$del_id = $_GET['delete_id'];

								$delSql = "DELETE FROM booking_list WHERE id = '$del_id' ";
			                    $delSqlRes = mysqli_query($db, $delSql);

			                    if ($delSqlRes) {
			                      header('Location: order-details.php?do=Manage');
			                    }
			                    else {
			                      die("Booking Delete Error!!".mysqli_error($db));
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