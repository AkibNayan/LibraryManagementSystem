<?php

  include "inc/header.php";

?>
    <!-- Banner Content Start from here -->
    <section class="slider">
      <div class="fullslider">

        <div class="arrow l" onclick="prev()">
          <img src="admin/dist/img/slider/1.png" alt="1">
        </div>
        <div class="slide slide-1">
          <div class="caption">
            <h3>Our Library is Digital</h3>
            <p>Now library in your pocket. Signup</p>
          </div>
        </div>
        <div class="slide slide-2">
          <div class="caption">
            <h3>World Now in Your Own Hand</h3>
            <p>Enrich your knowledge.</p>
          </div>
        </div>
        <div class="slide slide-3">
          <div class="caption">
            <h3>As Gateways to Knowledge and Culture</h3>
            <p>Thanks for visiting to our site.</p>
          </div>
        </div>
        <div class="arrow r" onclick="next()">
          <img src="admin/dist/img/slider/2.png" alt="2">
        </div>

      </div>
    </section>
    <!-- Banner Content End from here -->


    <!-- Main Content Start From Here -->
    <section class="books" id="book-section">
      <div class="container">
        <h2>Available Books</h2>
        <p>A book is a medium for recording information in the form of writing or images, typically composed of many pages (made of papyrus, parchment, vellum, or paper) bound together and protected by a cover.[1] The technical term for this physical arrangement is codex (plural, codices). In the history of hand-held physical supports for extended written compositions or records, the codex replaces its predecessor, the scroll. A single sheet in a codex is a leaf and each side of a leaf is a page.</p>
        <div class="row shadow">
          <div class="col-lg-3">
            <ul class="category-section all-book-cat" >
              <li><a href="#book-section" >All Books</a></li>
            </ul>
            <?php

              $pCatSql = "SELECT cat_id AS 'pCatId', cat_name As 'pCatName' FROM category WHERE is_parent = 0 AND cat_status = 1";
              $pCatSqlRes = mysqli_query($db, $pCatSql);

              while ($row = mysqli_fetch_assoc($pCatSqlRes)) {
                extract($row);

                $sCatSql = "SELECT cat_id AS 'sCatId', cat_name As 'sCatName' FROM category WHERE is_parent = '$pCatId' AND cat_status = 1";
                $sCatSqlRes = mysqli_query($db, $sCatSql);
                $numOfSubCat = mysqli_num_rows($sCatSqlRes);
                if ($numOfSubCat == 0){
                  ?>

                  <ul class="category-section book-cat">
                    <li><a href="category-book.php?category_id=<?php echo $pCatId; ?>&#book-section" ><?php echo $pCatName; ?></a></li>
                  </ul>

                  <?php
                }
                else {
                  ?>

                  <ul class="category-section book-cat">
                    <li><a href="category-book.php?category_id=<?php echo $pCatId; ?>&#book-section" ><?php echo $pCatName; ?></a></li>
                  </ul>

                  <?php
                  while($row = mysqli_fetch_assoc($sCatSqlRes)) {
                    extract($row);
                    ?>

                    <ul class="category-section book-cat">
                      <li><a href="category-book.php?category_id=<?php echo $sCatId; ?>&#book-section" >--<?php echo $sCatName; ?></a></li>
                    </ul>

                    <?php
                  }
                }

              }

            ?>
            
          </div>
          <div class="col-lg-9">
            <!-- Search Section Start -->
            <form action="search.php#book-section" method="POST">
              <h4>Search Option</h4>
              <div class="mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search Your Book Here">
              </div>
              <div class="mb-3">
                <input type="submit" name="searchBtn" class="btn btn-success" value="Search">
              </div>
            </form>

           
            <!-- Search Section End -->

            <div class="allBooks">
              <div class="row">
                <?php

                    $bookSql = "SELECT * FROM book WHERE status = 1 ORDER BY id DESC";
                    $bookSqlRes = mysqli_query($db, $bookSql);
                    $numOfBooks = mysqli_num_rows($bookSqlRes);

                    if ($numOfBooks <= 0) {
                      echo "<span class='alert alert-danger'>Opps!! No books are availble in library</span>";
                    }
                    else {

                      while($row = mysqli_fetch_assoc($bookSqlRes)) {

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

                        <div class="col-lg-2 col-sm-3">
                          <div class="shelf_no">
                            <?php

                              if (!empty($shelf_no)) {
                                ?>
                                  <div class="shelf">Shelf No: <?php echo $shelf_no; ?></div>
                                <?php
                              }
                              else {
                                ?>
                                  <div class="shelf">Shelf No: --</div>
                                <?php
                              }

                            ?>
                          </div>
                          <div class="book-thumbnail">
                            <?php

                             if (!empty($image)) {
                              ?>
                                <a href="details.php?book_id=<?php echo $id; ?>"><img src="admin/dist/img/books/<?php echo $image; ?>" class="img"></a>
                              <?php
                             }

                            ?>
                          </div>
                          <div class="shelf_no">
                            <?php

                              if ($quantity > 1) {
                                ?>
                                <div class="shelf">Available</div>
                                <?php
                              }
                              else {
                                ?>
                                  <div class="shelf">Out of Stock</div>
                                <?php
                              }

                            ?>
                          </div>
                        </div>

                        <?php

                      }

                    }
                    

                  ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Main Content End From Here -->

    <!-- FAQ Section Start -->
    <section class="FAQ">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h4>A little more about us.</h4>

            <h2>Frequently Asked Questions About Our Site</h2>

            <div class="main-faq">
              <div class="card">
                <div class="card-header heading-1">
                  <a >Frequently Asked Question One</a>
                </div>
                <div class="content-1">
                  <div class="card-body">
                    <p class="card-text">Morbi Vehicula Arcu Et Pellentesque Tincidunt. Nunc Ligula Nulla, Lobortis A Elementum Non, Vulputate Ut Arcu. Aliquam Erat Volutpat. Nullam Lacinia Felis.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="main-faq">
              <div class="card">
                <div class="card-header heading-2">
                  <a >Frequently Asked Question Two</a>
                </div>
                <div class="content-2">
                  <div class="card-body">
                    <p class="card-text">Morbi Vehicula Arcu Et Pellentesque Tincidunt. Nunc Ligula Nulla, Lobortis A Elementum Non, Vulputate Ut Arcu. Aliquam Erat Volutpat. Nullam Lacinia Felis.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="main-faq">
              <div class="card">
                <div class="card-header heading-3">
                  <a >Frequently Asked Question Three</a>
                </div>
                <div class="content-3">
                  <div class="card-body">
                    <p class="card-text">Morbi Vehicula Arcu Et Pellentesque Tincidunt. Nunc Ligula Nulla, Lobortis A Elementum Non, Vulputate Ut Arcu. Aliquam Erat Volutpat. Nullam Lacinia Felis.</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-6">
            <div class="faq-banner">
              <img src="admin/dist/img/faq-banner.png" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- FAQ Section End -->
    <!-- Contact Section Start -->
    <section class="contact-section" id="contact-info">
      <div class="container">
        <h2>Contact</h2>
        <p>Cras ultricies ligula sed magna dictum porta. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Proin eget tortor risus.</p>
        <div class="row contact">
          <div class="col-lg-6">
            <h4 ><span><i class="far fa-envelope"></i></span>Leave A Message.</h4>
            <h5><span><i class="fas fa-map-marker-alt"></i></span>Address</h5>
            <span>Student of BGC Trust University Bangladesh, Chandanaish, Chattogram.</span>
            <div class="row mt-3">
              <div class="col-lg-6 mb-3">
                <h5><span><i class="far fa-envelope"></i></span>Email Address</h5>
                <span>akibnayan182@gmail.com</span>
              </div>
              <div class="col-lg-6 mb-3">
                <h5><span><i class="fas fa-phone-alt"></i></span>Fax Id</h5>
                <span>+1 (358) 389-2525</span>
              </div>
              <h5><span><i class="fas fa-phone-alt"></i></span>Contact Number</h5>
                <span>01723195116</span>
            </div>
            <div class="form">
              <form action="" method="POST">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label>Name</label>
                      <input type="text" name="fullname" class="form-control" placeholder="Name">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label>Subject</label>
                  <input type="text" name="fullname" class="form-control" placeholder="Subject">
                </div>
                <div class="mb-3">
                  <label>Message</label>
                  <textarea class="form-control" name="message" rows="5">Message</textarea>
                </div>
                <div class="mg-3">
                  <input type="submit" name="submit" class="btn btn-success" value="Submit">
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="map">
              <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59149.99433371192!2d92.0253038747896!3d22.092603755986538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ad117b14c2458f%3A0x610444c480af768b!2sSatkania%20Adarsa%20Mohila%20College!5e0!3m2!1sen!2sbd!4v1636854920817!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Contact Section End -->

    <?php

      include "inc/footer.php";

    ?>