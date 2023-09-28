<?php

	include "inc/header.php";

?>

<!-- Banner Section Start -->
<div class="banner">
	<img src="admin/dist/img/book_details_bg.png">
</div>
<!-- Banner Section End -->

<!-- Book Details Section Start -->
<div class="book-details">
	<div class="container">
		<?php

			if (isset($_GET['book_id'])) {

				$book_id = $_GET['book_id'];

				$bookSql = "SELECT * FROM book WHERE id = '$book_id' ";
            	$bookSqlRes = mysqli_query($db, $bookSql);
            	while ($row = mysqli_fetch_assoc($bookSqlRes)) {

            		$id             = $row['id'];
	                $title          = $row['title'];
	                $sub_title      = $row['sub_title'];
	                $description    = $row['description'];
	                $cat_id         = $row['cat_id'];
	                $shelf_no       = $row['shelf_no'];
	                $author_name    = $row['author_name'];
	                $quantity       = $row['quantity'];
	                $image          = $row['image'];
	                $status         = $row['status'];

	                ?>

	                <div class="row">
						<div class="col-lg-4">
							<div class="book-thumbnail">
								<?php

									if (!empty($image)) {
										?>
										<img src="admin/dist/img/books/<?php echo $image; ?>">
										<?php
									}
									else {
										?>
											<img src="admin/dist/img/user8-128x128.jpg">
										<?php
									}

								?>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="details">
								<h1><?php echo $title; ?></h1>
								<h4><?php echo $sub_title; ?></h4>
								<h4>Written By -- <span><?php echo $author_name; ?></span></h4>
								<h4>Category / Sub Category -- <?php

									$catSql = "SELECT cat_name FROM category WHERE cat_id  = '$cat_id'";
									$catSqlRes = mysqli_query($db, $catSql);
									while ($row = mysqli_fetch_assoc($catSqlRes)) {
										$cat_name = $row['cat_name'];
									}
									echo "<span class='badge bg-primary'>$cat_name</span>";

								?></h4>
								<?php

									if ($quantity > 1) {
										?>
										<h4>Book Quantity -- <?php echo "<span class='badge bg-success'>$quantity PCs available with us.</span> ";?></h4>
										<?php
									}
									else {
										?>
										<h4>Book Quantity -- <?php echo "<span class='badge bg-success'>$quantity PC available with us.</span> ";?></h4>
										<?php
									}

								?>
								<?php

									if ($status == 1) {
										?>
										<h4>Book Status -- <?php echo "<span class='badge bg-success'>Active</span>" ;?></h4>
										<?php
									}
									else {
										?>
											<h4>Book Status -- <?php echo "<span class='badge bg-success'>Active</span>" ;?></h4>
										<?php
									}

								?>
								<?php

									if ($shelf_no == 0) {
										?>
											<h4>Shelf No -- <?php echo "<span class='badge bg-success'>$shelf_no</span>" ;?></h4>
										<?php
									}
									else {
										?>
										<h4>Shelf No -- <?php echo "<span class='badge bg-success'>$shelf_no</span>" ;?></h4>
										<?php
									}

								?>

								<h4>Book Info -- </h4><p><?php echo $description; ?></p>

								<div class="book-btn">
									<?php

										if (empty($_SESSION['email'])) {
											?>
											<a href="login.php">Please Login to Reserve Your Book.</a>
											<?php
										}
										else {
											if ($quantity > 1) {
												?>
												<a href="booking.php?book_id=<?php echo $id; ?>">Book Now</a>
												<?php
											}
											else {
												?>
												<a>Out of Stock</a>
												<?php
											}
										}

									?>
								</div>
								
							</div>
						</div>
					</div>

	                <?php

            	}

			}

		?>
		
	</div>
</div>
<!-- Book Details Section End -->

<?php

	include "inc/footer.php";

?>