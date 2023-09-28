<?php

	include "inc/header.php";

?>

<!-- Book Details Section Start -->
<div class="book-details">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-1">
				 <?php

				 	if (isset($_GET['book_id'])) {

				 		$book_id = $_GET['book_id'];

				 		$bookSql = "SELECT * FROM book WHERE id = '$book_id' ";
				 		$bookSqlRes = mysqli_query($db, $bookSql);
				 		while ($row = mysqli_fetch_assoc($bookSqlRes)) {
				 			$id  			= $row['id'];
							$title 			= $row['title'];
							$quantity 		= $row['quantity'];
				 		}
				 		if ($quantity <=1) {
				 			?>
				 			<p class="alert alert-danger">Sorry!! This book isn't available right now. Please check this book later.</p>
				 			<?php
				 		}
				 		else {
				 			?>
				 			<h2>Please Fillup the information for booking confirmation - </h2>
				 			<?php

				 			$user_id = $_SESSION['user_id'];

				 			$userSql = "SELECT * FROM users WHERE user_id = '$user_id' ";
				 			$userSqlRes = mysqli_query($db, $userSql);
				 			while ($row = mysqli_fetch_assoc($userSqlRes)) {

				 				$user_id 	= $row['user_id'];
								$fullname 	= $row['fullname'];
								$email 		= $row['email'];
								$phone 		= $row['phone'];
								$address 	= $row['address'];

				 			}
				 			?>

				 			<div class="user-info">
				 				<table class="table table-bordered table-striped table-hover">
					 				<thead>
					 					<tr>
					 						<th>Full Name</th>
					 						<th>Email</th>
					 						<th>Phone</th>
					 						<th>Address</th>
					 					</tr>
					 				</thead>
					 				<tbody>
					 					<tr>
					 						<td><?php echo $fullname; ?></td>
					 						<td><?php echo $email; ?></td>
					 						<td><?php echo $phone; ?></td>
					 						<td><?php echo $address; ?></td>
					 					</tr>
					 				</tbody>
					 			</table>
				 			</div>

				 			<div class="booking-form">
				 				<form action="" method="POST" >
					 				<div class="row">
					 					<div class="col-lg-6 offset-3">
					 						<div class="mb-3">
					 							<label>Receive Date</label>
					 							<input type="text" name="rcv_date" id="datepicker" class="form-control" placeholder="Receive Date" required="required" autocomplete="off">
					 						</div>
					 						<div class="mb-3">
					 							<label>Return Date</label>
					 							<input type="text" name="rtn_date" id="rtndatepicker" class="form-control" placeholder="Return Date" required="required" autocomplete="off">
					 						</div>
					 						<div class="mb-3">
					 							<input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
					 							<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
					 							<button type="submit" name="placeOrder" class="book-btn">Proceed to Booking</button> 
					 						</div>
					 					</div>
					 				</div>
					 			</form>
					 			<?php

					 				if (isset($_POST['placeOrder'])) {

					 					$book_id 	= $_POST['book_id'];
					 					$user_id 	= $_POST['user_id'];
					 					$rcv_date 	= date('Y-m-d', strtotime($_POST['rcv_date']));
					 					$rtn_date 	= date('Y-m-d', strtotime($_POST['rtn_date']));

					 					$bookingSql = "INSERT INTO booking_list (book_id, user_id, rcv_date, rtn_date, booking_date) VALUES ('$book_id', '$user_id', '$rcv_date', '$rtn_date', now()) ";
					 					$bookingSqlRes = mysqli_query($db, $bookingSql);

					 					if ($bookingSqlRes) {
					 						$_SESSION['msg'] = "Your book is now in pending for admin approval. Please contact with the library admin to receive the book.";
					 						header('Location: order-history.php');
					 					}
					 					else {
					 						die("Booking Insert Sql!!".mysqli_error($db));
					 					}

					 				}

					 			?>
				 			</div>

				 			<?php

				 		}

				 	}

				 ?>
			</div>
		</div>
	</div>
</div>

<?php

	include "inc/footer.php";

?>