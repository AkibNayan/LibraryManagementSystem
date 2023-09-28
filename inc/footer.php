<!-- Footer Section Start -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h4 class="library">Library Management System</h2>
          <p class="about">The library management system allows a library to keep track of all its books, and also manage its members. Some of the services offered by a library management system include book requests by the members of the library, and denial or issuance of the requests by the librarian.</p>
      </div>
      <div class="col-lg-3">
        <h4 class="social_heading">Follow Up</h4>
        <div class="social">
          <a href=""><i class="fab fa-facebook"></i></a>
          <a href=""><i class="fab fa-twitter"></i></a>
          <a href=""><i class="fab fa-google"></i></a>
          <a href=""><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <div class="col-lg-3">
        <h4 class="library">Contact Us</h2>
          <p class="about">Fill in your Email-Address and stay in contact with us.</p>
          <form>
            <div class="mb-3">
              <input type="email" name="email" class="form-control subscribe" placeholder="Enter Email Address" autocomplete="off">
            </div>
            <div class="mb-3">
              <input type="submit" name="subscribe" class="subscribeBtn" value="Subscribe">
            </div>
          </form>
      </div>
    </div>
  </div>
</footer>
<!-- Footer Section End -->

<script>
  let slide = document.querySelectorAll('.slide');

  var current = 0;

  function cls() {
    for (let i = 0; i < slide.length; i++) {
      slide[i].style.display = 'none';
    }
  }

  function next() {
    cls();
    if (current === slide.length - 1) current = -1;
    current++;
    slide[current].style.display = 'block';
    slide[current].style.opacity = 0.4;

    var x = 0.4;
    var intX = setInterval(function() {
      x += 0.1;
      slide[current].style.opacity = x;
      if (x >= 1) {
        clearInterval(intX);
        x = 0.4;
      }
    }, 100);

  }

  function prev() {
    cls();
    if (current === 0) current = slide.length;
    current--;
    slide[current].style.display = 'block';
    slide[current].style.opacity = 0.4;

    var x = 0.4;
    var intX = setInterval(function() {
      x += 0.1;
      slide[current].style.opacity = x;
      if (x >= 1) {
        clearInterval(intX);
        x = 0.4;
      }
    }, 100);

  }

  function start() {
    cls();
    slide[current].style.display = 'block';
  }
  start();
</script>
<!-- jQuery UI datepicker -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

<script>
  $(function() {
    $("#datepicker").datepicker();
    $("#rtndatepicker").datepicker();
  });
</script>

<script>
  //jQuery
  $(document).ready(function() {

    $('.content-2').hide();
    $('.content-3').hide();

    $('.content-1').addClass('active-color');
    //if heading-2 is active
    $('.heading-2').click(function() {

      $('.content-1').hide();
      $('.content-2').show();
      $('.content-3').hide();

      $('.content-1').removeClass('active-color');
      $('.content-2').addClass('active-color');
      $('.content-3').removeClass('active-color');

    });
    //if heading-3 is active
    $('.heading-3').click(function() {

      $('.content-1').hide();
      $('.content-2').hide();
      $('.content-3').show();

      $('.content-1').removeClass('active-color');
      $('.content-2').removeClass('active-color');
      $('.content-3').addClass('active-color');

    });
    //if heading-1 is active
    $('.heading-1').click(function() {

      $('.content-1').show();
      $('.content-2').hide();
      $('.content-3').hide();

      $('.content-1').addClass('active-color');
      $('.content-2').removeClass('active-color');
      $('.content-3').removeClass('active-color');

    });


  });
</script>


<!-- Category jQuery End-->

<!-- Book Section Category jQuery Start -->
<script>
  $(document).ready(function() {

    $('.all-book-cat').addClass('active-cat-color');




  });
</script>
<!-- Book Section Category jQuery End -->
<!-- Book Sort Start -->
<script>
  $(document).ready(function() {
    const element = document.getElementById("catBooks");
    element.addEventListener("click", function() {
      $.ajax({
        type: "GET",
        url: "../admin/inc/db.php",
        dataType: "html",
        success: function(data) {
          $(".allBooks").html(data)
        }
      })
    })
  })
</script>
<!-- Book Sort End -->

<!-- Sticky Class -->
<!--    stick up code -->
<script type="">
  window.addEventListener("scroll",function(){
        var header=document.querySelector("header");
        header.classList.toggle("sticky",window.scrollY>0);
      });
    </script>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<?php

ob_end_flush();

?>


</body>

</html>