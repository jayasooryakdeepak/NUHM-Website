<!DOCTYPE html>
<html lang="en">

<head>
  <title>NUHM Ernakulam</title>
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
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>
  <?php
  @include 'header.php';
  include('mysql_conn_1.php');
  $inst_code = $_GET["inst_code"];


  $select_institution = mysqli_query($conn, "SELECT * FROM Institutions_Table,Institutions_Details_Table WHERE 
        $inst_code = Institutions_Table.Institution_Code and
        Institutions_Table.Institution_Code = Institutions_Details_Table.Institution_Code") or die('query failed');

  if (mysqli_num_rows($select_institution) > 0) {
    while ($fetch_inst = mysqli_fetch_assoc($select_institution)) {

  ?>
      <section
        class="hero-wrap hero-wrap-2"
        style="background-image: url('images/bg_1.jpg')">
        <div class="overlay"></div>
        <div class="container">
          <div
            class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
              <h1 class="mb-2 bread"><?php echo $fetch_inst['Institution_Name']; ?></h1>
              <p class="breadcrumbs">
                <span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span>
                <span class="mr-2"><a href="index.html"><?php echo $fetch_inst['Category']; ?> <i class="ion-ios-arrow-forward"></i></a></span>
                <span><?php echo $fetch_inst['Institution_Name']; ?> <i class="ion-ios-arrow-forward"></i></span>
              </p>
            </div>
          </div>
        </div>
      </section>
      <section class="ftco-section">
        <div class="container">
          <div class="row">

            <div class="col-lg-8 ftco-animate">
              <p>
                <img src="admin/<?php echo $fetch_inst['Main_Img']; ?>" alt class="img-fluid" />
              </p>
              <p>
                <?php echo $fetch_inst['About']; ?>
              </p>
              <h2 class="mb-3">CLINICAL SERVICES –TIMING OF SERVICES</h2>

              <p>
                Outpatient care, specialist services, laboratory services, vision
                testing, universal immunization sessions, outreach sessions, ANC
                Clinic, NCD Clinic, Family planning services, disease management,
                health screenings.
              </p>

              <?php
              $select_service_time = mysqli_query($conn, "SELECT * FROM InstitutionServices,Services_Table WHERE 
        $inst_code = Institution_Code and Services_Table.Service_Code = InstitutionServices.Service_Code") or die('query failed');

              if (mysqli_num_rows($select_service_time) > 0) {
              ?>
                <table>
                  <tr>
                    <th>SERVICES</th>
                    <th>DAY</th>
                    <th>TIME</th>
                  </tr>
                  <?php
                  while ($fetch_serv_time = mysqli_fetch_assoc($select_service_time)) {

                    $optime1 = $fetch_serv_time['Service_Time_Start'];
                    $serv_Time_1 = date('h:i A', strtotime($optime1));
                    $cltime1 = $fetch_serv_time['Service_Time_End'];
                    $serv_Time_2 = date('h:i A', strtotime($cltime1));
                  ?>
                    <tr>
                      <td><?php echo $fetch_serv_time['Service_Name']; ?></td>
                      <td><?php echo $fetch_serv_time['Service_Days']; ?></td>
                      <td><?php echo $serv_Time_1, '-', $serv_Time_2; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </table>
              <?php
              }
              ?>


              <?php
              $select_service = mysqli_query($conn, "SELECT * FROM InstitutionServices,Services_Table WHERE 
        $inst_code = Institution_Code and Services_Table.Service_Code = InstitutionServices.Service_Code") or die('query failed');



              if (mysqli_num_rows($select_service) > 0) {
                while ($fetch_serv = mysqli_fetch_assoc($select_service)) {

              ?>

                  <div class="about-author d-lg-flex d-md-flex d-xl-flex p-4">
                    <div class="bio mr-5">
                      <img
                        src="admin/<?php echo $fetch_serv['Service_Img']; ?>"
                        alt="Image placeholder"
                        class="img-fluid mb-4" />
                    </div>
                    <div class="desc">
                      <h3><?php echo $fetch_serv['Service_Name']; ?></h3>
                      <p>
                        <?php echo $fetch_serv['Service_Desc']; ?>
                      </p>
                    </div>
                  </div>
            </div>

        <?php }
              } ?>

        <div class="col-lg-4 sidebar ftco-animate">
          <!-- Maps -->
          <div class="sidebar-box ftco-animate">
            <iframe
              src="<?php echo $fetch_inst['Location']; ?>"
              width="300"
              height="250"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
            <!-- <img src="/images/map.png" alt="" style="width:300px;height:250px"> -->
          </div>
          <?php
          $optime = $fetch_inst['Opening_Time'];
          $new_OP_Time_1 = date('h:i A', strtotime($optime));
          $cltime = $fetch_inst['Closing_Time'];
          $new_OP_Time_2 = date('h:i A', strtotime($cltime));
          ?>
          <div class="time-tab">
            <table>
              <tr>
                <th>Company</th>
                <th>Timing</th>
              </tr>
              <tr>
                <td>OP</td>
                <td><?php echo $new_OP_Time_1, "-", $new_OP_Time_2; ?></td>
              </tr>
              <tr>
                <td>LAB</td>
                <td>8.00AM TO 3.30PM</td>
              </tr>
            </table>
          </div>

          <div class="time-tab">
            <table>
              <tr>
                <th>HR POSITION</th>
                <th>NUMBER</th>
              </tr>
              <tr>
                <td>Medical Officers</td>
                <td>2</td>
              </tr>
              <tr>
                <td>Specialist doctors</td>
                <td>1</td>
              </tr>
              <tr>
                <td>Staff Nurse</td>
                <td>2</td>
              </tr>
              <tr>
                <td>Pharmacist</td>
                <td>1</td>
              </tr>
              <tr>
                <td>Lab Technician</td>
                <td>1</td>
              </tr>
              <tr>
                <td>JPHN</td>
                <td>5</td>
              </tr>
              <tr>
                <td>Support staff (DEO)</td>
                <td>1</td>
              </tr>
              <tr>
                <td>Cleaning staff</td>
                <td>1</td>
              </tr>
              <tr>
                <td>LHV</td>
                <td>1</td>
              </tr>
              <tr>
                <td>Palliative nurse</td>
                <td>1</td>
              </tr>
            </table>
          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Address</h3>
            <p>
              <?php echo $fetch_inst['Address_Line_1']; ?> <br />
              <?php echo $fetch_inst['Address_Line_2']; ?><br />
              <?php echo $fetch_inst['Address_Line_3']; ?><br />
              <?php echo $fetch_inst['Pincode']; ?><br />
            </p>
            <h3>Contact number</h3>
            <p><?php echo $fetch_inst['Phone']; ?></p>
            <h3>Email</h3>
            <p><?php echo $fetch_inst['Email']; ?></p>
          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Paragraph</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Ducimus itaque, autem necessitatibus voluptate quod mollitia
              delectus aut, sunt placeat nam vero culpa sapiente consectetur
              similique, inventore eos fugit cupiditate numquam!
            </p>
          </div>
        </div>
          </div>
      <?php
      // }
    }
  } else {
    echo '<p class="empty">no products added yet!</p>';
  }
      ?>
        </div>
      </section>

      <!-- 
    
    Gallery 
    
    <section>
    <div class="container">
      <div class="row">
        <h3>Gallery</h3>
        <div class="col-lg-12 ftco-animate">
          <div class="wrapper-gal">
            <div class="media-gal">
              <div class="layer-gal">
                <p>+ Paul Gilmore</p>
              </div>
              <img
                src="https://images.unsplash.com/photo-1431818563807-927945852ab6?dpr=1&auto=format&fit=crop&w=1199&h=899&q=80&cs=tinysrgb&crop="
                alt=""
              />
            </div>
            <div class="media-gal">
              <div class="layer-gal">
                <p>+ M. O' Neil</p>
              </div>
              <img
                src="https://images.unsplash.com/photo-1443397646383-16272048780e?dpr=1&auto=format&fit=crop&w=1199&h=899&q=80&cs=tinysrgb&crop="
                alt=""
              />
            </div>
            <div class="media-gal">
              <div class="layer-gal">
                <p>+ N. Mehta</p>
              </div>
              <img
                src="https://images.unsplash.com/photo-1442965416224-f6a7eca980fa?dpr=1&auto=format&fit=crop&w=1199&h=799&q=80&cs=tinysrgb&crop="
                alt=""
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

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
                            data-cfemail="2d44434b426d5442585f4942404c4443034e4240">[email&#160;protected]</span></span></a>
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
                        <a href="#"><span class="icon-person"></span> Admin</a>
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
                        <a href="#"><span class="icon-person"></span> Admin</a>
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
        data-cf-beacon='{"rayId":"88301d79ece6420c","version":"2024.4.1","token":"cd0b4b3a733644fc843ef0b185f98241"}'
        crossorigin="anonymous"></script>
</body>

</html>


<!-- I want all the services to be available at all institutions as default in the InstitutionServices table

You want to populate your InstitutionServices table so that every institution offers every service by default. This is a good starting point for managing service availability. Here's how you can do it using SQL:

-- Assuming your tables are named 'Institutions', 'Services', and 'InstitutionServices'

INSERT INTO InstitutionServices (Institution_ID, Service_ID, Service_Time, Service_Days)
SELECT i.Institution_ID, s.Service_ID, 'Not Available Yet', 'Not Available Yet' -- Set default values for Service_Time and Service_Days
FROM Institutions i
CROSS JOIN Services s;
Explanation:

INSERT INTO InstitutionServices ...: This part of the query inserts data into the InstitutionServices table.

SELECT i.Institution_ID, s.Service_ID, 'Not Available Yet', 'Not Available Yet' ...: This selects the data to be inserted.

i.Institution_ID and s.Service_ID will fetch all combinations of institution and service IDs.
'Not Available Yet' sets a default value for Service_Time and Service_Days, indicating that the specific timings and days are not yet defined. You can change this default as needed.
FROM Institutions i CROSS JOIN Services s;: This performs a CROSS JOIN between the Institutions and Services tables. A CROSS JOIN creates all possible combinations of rows from the two tables.

Important Considerations:

Existing Data: If your InstitutionServices table already has data, this query will add new rows, potentially creating duplicates. If you want to replace existing data, you'll need to clear the table first using TRUNCATE TABLE InstitutionServices; (be very careful with TRUNCATE as it deletes all data without the ability to rollback).

Default Values: Consider what default values make sense for Service_Time and Service_Days. You might want to use placeholders like "To be determined" or leave them NULL initially.

Application Logic: After running this query, you'll likely want to provide a way for administrators to update the Service_Time and Service_Days in your application to reflect the actual availability of services at each institution.

Example:

Let's say you have these tables:

Institutions:

Institution_ID	Institution_Name
1	Hospital A
2	Clinic B
Services:

Service_ID	Service_Name
1	General Checkup
2	X-ray
After running the SQL query, your InstitutionServices table would look like this:

Institution_ID	Service_ID	Service_Time	Service_Days
1	1	Not Available Yet	Not Available Yet
1	2	Not Available Yet	Not Available Yet
2	1	Not Available Yet	Not Available Yet
2	2	Not Available Yet	Not Available Yet
Now, all institutions have all services listed, and you can update the timings and days as needed. -->