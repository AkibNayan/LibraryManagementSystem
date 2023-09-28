<?php

	include "inc/header.php";

?>

<section class="book-details">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-1">
				<h2>Booking History</h2>
				<?php

					if (!empty($_SESSION['msg'])) {
						?>
						<div class="alert alert-info">
							<?php
								echo $_SESSION['msg'];
							?>
						</div>
						<?php
					}

					$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

					if ($do == 'Manage') {
						?>

						<table class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th>#Sl.</th>
									<th>Book Title</th>
									<th>Booking Date</th>
									<th>Receive Date</th>
									<th>Return Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php

									if (!empty($_SESSION['user_id'])) {

										$user_id = $_SESSION['user_id'];

										$sql = "SELECT * FROM booking_list WHERE user_id = '$user_id' ORDER BY id ASC";
										$allBookList = mysqli_query($db, $sql);

										$numOfBooking = mysqli_num_rows($allBookList);
										$count = 0;
										if ($numOfBooking == 0) {
											echo "<span class='alert alert-info'>No Booking List Found Yet.</span>";
										}
										else {
											while ($row = mysqli_fetch_assoc($allBookList)) {

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
													<td><?php echo $booking_date; ?></td>
													<td><?php echo $rcv_date; ?></td>
													<td><?php echo $rtn_date; ?></td>
													<td>
														<?php

															if ($status == 1) {
																echo "<span class='badge bg-primary'>Active Booking</span>";
															}
															else if ($status == 2) {
																echo "<span class='badge bg-success'>Boook Returned</span>";
															}
															else if ($status == 3) {
																echo "<span class='badge bg-danger'>Booking Cancel</span>";
															}
															else if ($status == 4) {
																echo "<span class='badge bg-warning'>Booking Pending</span>";
															}

														?>
													</td>
													<td class="table-action">
							                          <ul>
							                            <li><a href="order-history.php?do=Edit&edit_id=<?php echo $id; ?>"><i class="fas fa-edit"></i></a></li>
							                          </ul>           
							                        </td>
												</tr>

							                    <?php

											}
										}

									}

								?>
								
							</tbody>
						</table>

						<?php
					}
					else if ($do == 'Edit') {

						if (isset($_GET['edit_id'])) {

							$edit_id = $_GET['edit_id'];

							$bookingSql = "SELECT * FROM booking_list WHERE id = '$edit_id' ";
							$bookingSqlRes = mysqli_query($db, $bookingSql);
							while ($row = mysqli_fetch_assoc($bookingSqlRes)) {
								$id       		= $row['id'];
			                    $book_id    	= $row['book_id'];
			                    $user_id    	= $row['user_id'];
			                    $rcv_date     	= $row['rcv_date'];
			                    $rtn_date     	= $row['rtn_date'];
			                    $booking_date   = $row['booking_date'];
			                    $status     	= $row['status'];
							}
							if ($status == 4) {
								?>

								<div class="edit-form">
									<div class="row">
										<div class="col-lg-6">
											<form action="order-history.php?do=Update" method="POST">
												<div class="mb-3">
													<label>Booking Status</label>
						 							<select class="form-control" name="status">
						 								<option value="4">Please select status</option>
						 								<option value="3" <?php if ($status == 3) echo "selected";?> >Cancel</option>
						 								<option value="4" <?php if ($status == 4) echo "selected";?> >Pending</option>
						 							</select>
						 						</div>
						 						<div class="mb-3">
						 							<input type="hidden" name="order_id" value="<?php echo $id; ?>">
                              						<input type="submit" name="updateStatus" class="btn btn-success mt-3" value="Save Changes">
						 						</div>
											</form>
										</div>
									</div>
								</div>

								<?php
							}
							else {
								header('Location: order-history.php?do=Manage');
							}

						}

					}
					else if ($do == 'Update') {

						if (isset($_POST['updateStatus'])) {

							$order_id 	= $_POST['order_id'];
							$status 	= $_POST['status'];

							$updateSql = "UPDATE booking_list SET status = '$status' WHERE id = '$order_id' ";
							$updateSqlRes = mysqli_query($db, $updateSql);

							if ($updateSqlRes) {
								header('Location: order-history.php?do=Manage');
							}
							else {
								die("Status Update Error!!".mysqli_error($db));
							}

						}

					}

				?>

				
			</div>
		</div>
	</div>
</section>


<?php

	unset($_SESSION['msg']);

	include "inc/footer.php";

?>