<?php
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">

<head>

  <title>Car Rental Portal</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
  <link href="assets/css/slick.css" rel="stylesheet">
  <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHJyTJzGwj0yIrOrOMdd2Tt-YEJYDjgSo&callback=initmap" async="" defer="defer" type="text/javascript"></script>
  <script>
    function showPosition() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showMap, showError);
      } else {
        alert("Sorry, your browser does not support HTML5 geolocation.");
      }
    }

    // Define callback function for successful attempt
    function showMap(position) {
      // Get location data
      lat = position.coords.latitude;
      long = position.coords.longitude;
      var latlong = new google.maps.LatLng(lat, long);

      var myOptions = {
        center: latlong,
        zoom: 16,
        mapTypeControl: true,
        navigationControlOptions: {
          style: google.maps.NavigationControlStyle.SMALL
        }
      }

      var map = new google.maps.Map(document.getElementById("embedMap"), myOptions);
      var marker = new google.maps.Marker({
        position: latlong,
        map: map,
        title: "You are here!"
      });
    }

    // Define callback function for failed attempt
    function showError(error) {
      if (error.code == 1) {
        result.innerHTML = "You've decided not to share your position, but it's OK. We won't ask you again.";
      } else if (error.code == 2) {
        result.innerHTML = "The network is down or the positioning service can't be reached.";
      } else if (error.code == 3) {
        result.innerHTML = "The attempt timed out before it could get the location data.";
      } else {
        result.innerHTML = "Geolocation failed due to unknown error.";
      }
    }
  </script>
</head>

<body>

  <!-- Start Switcher -->

  <!-- /Switcher -->

  <!--Header-->
  <?php include('includes/header.php'); ?>
  <!-- /Header -->

  <!-- Banners -->
  <section id="banner" class="banner-section">
    <div class="container">
      <div class="div_zindex">
        <div class="row">
          <div class="col-md-5 col-md-push-7">
            <div class="banner_content">
              <h1>&nbsp;</h1>
              <p>&nbsp; </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Banners -->


  <!-- Resent Cat-->
  <section class="section-padding gray-bg" style="display:none;">
    <div class="container">
      <div class="section-header text-center">
        <h2>Find the Best <span>CarForYou</span></h2>
        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
      </div>
      <div class="row">

        <!-- Nav tabs -->
        <div class="recent-tab">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">New Car</a></li>
          </ul>
        </div>
        <!-- Recently Listed New Cars -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="resentnewcar">

            <?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand limit 9";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
              foreach ($results as $result) {
            ?>

                <div class="col-list-3">
                  <div class="recent-car-list">
                    <div class="car-info-box"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive" alt="image"></a>
                      <ul>
                        <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?></li>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear); ?> Model</li>
                        <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?> seats</li>
                      </ul>
                    </div>
                    <div class="car-title-m">
                      <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"> <?php echo htmlentities($result->VehiclesTitle); ?></a></h6>
                      <span class="price">$<?php echo htmlentities($result->PricePerDay); ?> /Day</span>
                    </div>
                    <div class="inventory_info_m">
                      <p><?php echo substr($result->VehiclesOverview, 0, 70); ?></p>
                    </div>
                  </div>
                </div>
            <?php }
            } ?>

          </div>
        </div>
      </div>
  </section>
  <!-- /Resent Cat -->

  <!-- Fun Facts-->
  <section class="fun-facts-section" id="embedMap">

    <!-- Dark Overlay-->

  </section>

  <section class="fun-facts-section">
    <div class="share_vehicle">
      <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
    </div>
    <div class="sidebar_widget">
      <div class="widget_heading">
        <h5><i class="fa fa-envelope" aria-hidden="true"></i>Request a Truck</h5>
      </div>
      <form method="post">
        <div class="form-group">
          <label> Date:</label>
          <input type="date" class="form-control" name="fromdate" placeholder="From Date" required>
        </div>
        <div class="form-group">
          <label>Time:</label>
          <input type="time" class="form-control" name="todate" placeholder="To Date" required>
        </div>
        <div class="form-group">
          <label>Request for:</label>
          <select class="form-control">
            <option value="0">Select Your Cause:</option>
            <option value="gar">Gardening</option>
            <option value="fun">Furniture Shipment</option>
            <option value="yw">Yard Waste</option>
            <option value="other">Other</option>

          </select>
        </div>
        <div class="form-group">
          <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
        </div>
        <?php if ($_SESSION['login']) { ?>
          <div class="form-group">
            <input type="submit" class="btn" name="submit" value="Book Now">
          </div>
        <?php } else { ?>
          <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>

        <?php } ?>
      </form>
    </div>
  </section>
  <!-- /Fun Facts-->


  <!--Testimonial -->
  <section class="section-padding testimonial-section parallex-bg" style="display:none;">
    <div class="container div_zindex">
      <div class="section-header white-text text-center">
        <h2>Our Satisfied <span>Customers</span></h2>
      </div>
      <div class="row">
        <div id="testimonial-slider">
          <?php
          $tid = 1;
          $sql = "SELECT tbltestimonial.Testimonial,tblusers.FullName from tbltestimonial join tblusers on tbltestimonial.UserEmail=tblusers.EmailId where tbltestimonial.status=:tid limit 4";
          $query = $dbh->prepare($sql);
          $query->bindParam(':tid', $tid, PDO::PARAM_STR);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $result) {  ?>


              <div class="testimonial-m">

                <div class="testimonial-content">
                  <div class="testimonial-heading">
                    <h5><?php echo htmlentities($result->FullName); ?></h5>
                    <p><?php echo htmlentities($result->Testimonial); ?></p>
                  </div>
                </div>
              </div>
          <?php }
          } ?>



        </div>
      </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
  </section>
  <!-- /Testimonial-->


  <!--Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- /Footer-->

  <!--Back to top-->
  <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
  <!--/Back to top-->

  <!--Login-Form -->
  <?php include('includes/login.php'); ?>
  <!--/Login-Form -->

  <!--Register-Form -->
  <?php include('includes/registration.php'); ?>

  <!--/Register-Form -->

  <!--Forgot-password-Form -->
  <?php include('includes/forgotpassword.php'); ?>
  <!--/Forgot-password-Form -->

  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/interface.js"></script>
  <!--Switcher-->
  <script src="assets/switcher/js/switcher.js"></script>
  <!--bootstrap-slider-JS-->
  <script src="assets/js/bootstrap-slider.min.js"></script>
  <!--Slider-JS-->
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

</html>