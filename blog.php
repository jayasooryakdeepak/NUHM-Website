<!DOCTYPE html>
<html lang="en">

<head>
  <title>Events</title>
  <link rel="icon" type="image/x-icon" href="images/NUHM_Logo_Tra.png" />
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- <link
      href="../../../fonts.googleapis.com/cssd369.css?family=Poppins:200,300,400,500,600,700,800,900&amp;display=swap"
      rel="stylesheet"
    /> -->

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css" />
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/owl.carousel.min.css" />
  <link rel="stylesheet" href="css/owl.theme.default.min.css" />
  <link rel="stylesheet" href="css/magnific-popup.css" />
  <link rel="stylesheet" href="css/aos.css" />
  <link rel="stylesheet" href="css/ionicons.min.css" />
  <link rel="stylesheet" href="css/flaticon.css" />
  <link rel="stylesheet" href="css/icomoon.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <?php @include 'header.php'; ?>

  <section
    class="hero-wrap hero-wrap-2"
    style="background-image: url('images/bg_1.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div
        class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-2 bread">Events</h1>
          <p class="breadcrumbs">
            <span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span>
            <span>Events <i class="ion-ios-arrow-forward"></i></span>
          </p>
        </div>
      </div>
    </div>
  </section>
  <section class="ftco-section bg-light">
    <div class="container">
      <div class="row">
        <?php
        include('mysql_conn_1.php');
        $select_events = mysqli_query($conn, "SELECT MONTHNAME(Date),Event_Name,Event_Desc,Event_Image,Date,Institution_Name FROM Institutions_Table,Events_Table WHERE 
        Institutions_Table.Institution_Code = Events_Table.Institution_Code") or die('query failed');

        // $month_name = mysqli_query($conn, "SELECT MONTHNAME(Date) FROM Institutions_Table,Events_Table WHERE 
        // Institutions_Table.Institution_Code = Events_Table.Institution_Code") or die('query failed');

        foreach ($select_events as $fetch_event) {
        ?>
          <div class="col-md-6 col-lg-4 ftco-animate">
            <div class="blog-entry">
              <a
                href="blog-single.html"
                class="block-20 d-flex align-items-end"
                style="
                  background-image: url('admin/<?php echo $fetch_event['Event_Image']; ?>');
                ">
                <?php
                $orderdate = $fetch_event['Date'];
                //Monthname used fetching month as a name and is later changed to uppercase and only the 3 letters are taken
                $month_name = $fetch_event['MONTHNAME(Date)'];
                $month_name = strtoupper($month_name);

                $month = substr($month_name, 0, 3);

                $orderdate = explode('-', $orderdate);
                $year  = $orderdate[0];
                $day   = $orderdate[1];
                ?>
                <div class="meta-date text-center p-2">
                  <span class="day"><?php echo $day  ?></span>
                  <span class="mos"><?php echo $month ?></span>
                  <span class="yr"><?php echo $year ?></span>
                </div>
              </a>
              <div class="text bg-white p-4">
                <h3 class="heading">
                  <a href="#"><?php echo $fetch_event['Event_Name']; ?></a>
                </h3>
                <p>
                  <?php echo $fetch_event['Event_Desc']; ?>
                </p>

                <div class="d-flex align-items-center mt-4">
                  <!-- <p class="mb-0">
                    <button
                      onclick="myFunction()"
                      id="myBtn"
                      class="read-more-btn btn btn-primary"
                    >
                      Read more
                    </button>
                  </p> -->
                  <p class="ml-auto mb-0">
                    <a href="#" class="mr-2">
                      <a href="#" class="mr-2"><?php echo $fetch_event['Institution_Name']; ?></a>
                    </a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-6 col-lg-3">
          <div class="ftco-footer-widget mb-5">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li>
                  <span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California,
                    USA</span>
                </li>
                <li>
                  <a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a>
                </li>
                <li>
                  <a href="#"><span class="icon icon-envelope"></span><span class="text"><span
                        class="__cf_email__"
                        data-cfemail="89e0e7efe6c9f0e6fcfbede6e4e8e0e7a7eae6e4">[email&#160;protected]</span></span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="ftco-footer-widget mb-5">
            <h2 class="ftco-heading-2">Recent Blog</h2>
            <div class="block-21 mb-4 d-flex">
              <a
                class="blog-img mr-4"
                style="background-image: url(images/image_1.jpg)"></a>
              <div class="text">
                <h3 class="heading">
                  <a href="#">Even the all-powerful Pointing has no control about</a>
                </h3>
                <div class="meta">
                  <div>
                    <a href="#"><span class="icon-calendar"></span> June 27, 2019</a>
                  </div>
                  <div>
                    <a href="#"><span class="icon-person"></span> Thevara</a>
                  </div>
                  <div>
                    <a href="#"><span class="icon-chat"></span> 19</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-21 mb-5 d-flex">
              <a
                class="blog-img mr-4"
                style="background-image: url(images/image_2.jpg)"></a>
              <div class="text">
                <h3 class="heading">
                  <a href="#">Even the all-powerful Pointing has no control about</a>
                </h3>
                <div class="meta">
                  <div>
                    <a href="#"><span class="icon-calendar"></span> June 27, 2019</a>
                  </div>
                  <div>
                    <a href="#"><span class="icon-person"></span> Thevara</a>
                  </div>
                  <div>
                    <a href="#"><span class="icon-chat"></span> 19</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="ftco-footer-widget mb-5 ml-md-4">
            <h2 class="ftco-heading-2">Links</h2>
            <ul class="list-unstyled">
              <li>
                <a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Home</a>
              </li>
              <li>
                <a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>About</a>
              </li>
              <li>
                <a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Services</a>
              </li>
              <li>
                <a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Deparments</a>
              </li>
              <li>
                <a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Contact</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="ftco-footer-widget mb-5">
            <h2 class="ftco-heading-2">Subscribe Us!</h2>
            <form action="#" class="subscribe-form">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control mb-2 text-center"
                  placeholder="Enter email address" />
                <input
                  type="submit"
                  value="Subscribe"
                  class="form-control submit px-3" />
              </div>
            </form>
          </div>
          <div class="ftco-footer-widget mb-5">
            <h2 class="ftco-heading-2 mb-0">Connect With Us</h2>
            <ul
              class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
              <li class="ftco-animate">
                <a href="#"><span class="icon-twitter"></span></a>
              </li>
              <li class="ftco-animate">
                <a href="#"><span class="icon-facebook"></span></a>
              </li>
              <li class="ftco-animate">
                <a href="#"><span class="icon-instagram"></span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p>
            Copyright &copy;
            <script
              data-cfasync="false"
              src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script>
              document.write(new Date().getFullYear());
            </script>
            All rights reserved | This template is made with
            <i class="icon-heart" aria-hidden="true"></i> by
            <a href="https://colorlib.com/" target="_blank">Colorlib</a>
          </p>
        </div>
      </div>
    </div>
  </footer>

  <div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
      <circle
        class="path-bg"
        cx="24"
        cy="24"
        r="22"
        fill="none"
        stroke-width="4"
        stroke="#eeeeee" />
      <circle
        class="path"
        cx="24"
        cy="24"
        r="22"
        fill="none"
        stroke-width="4"
        stroke-miterlimit="10"
        stroke="#F96D00" />
    </svg>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&amp;sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

  <script
    async
    src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "UA-23581568-13");
  </script>
  <script
    defer
    src="https://static.cloudflareinsights.com/beacon.min.js/vedd3670a3b1c4e178fdfb0cc912d969e1713874337387"
    integrity="sha512-EzCudv2gYygrCcVhu65FkAxclf3mYM6BCwiGUm6BEuLzSb5ulVhgokzCZED7yMIkzYVg65mxfIBNdNra5ZFNyQ=="
    data-cf-beacon='{"rayId":"88301b929993f3e1","b":1,"version":"2024.4.1","token":"cd0b4b3a733644fc843ef0b185f98241"}'
    crossorigin="anonymous"></script>
</body>

</html>