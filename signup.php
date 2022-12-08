<?php
session_start();
include 'database_connection.php';
if (isset($_POST['register'])) {
  $fullname = filter_var(mysqli_real_escape_string($connection, $_POST['fullname']), FILTER_SANITIZE_STRING);
  $email_address = filter_var(mysqli_real_escape_string($connection, $_POST['email_address']), FILTER_SANITIZE_EMAIL);
  $phone_number = filter_var(mysqli_real_escape_string($connection, $_POST['phone_number']), FILTER_SANITIZE_STRING);
  $address = filter_var(mysqli_real_escape_string($connection, $_POST['address']), FILTER_SANITIZE_STRING);
  $random_number = rand(100000, 999999);
  $customer_id = "SYN/USER/" . $random_number;
  define("RAND_PASSWORD", "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVXYZ1234567890");
  $main_random = str_shuffle(RAND_PASSWORD);
  $sub_random = substr($main_random, 0, 6);
  $password = password_hash($sub_random, PASSWORD_DEFAULT);
  $verification_code = rand(100000, 999999);
  $select = "SELECT * FROM customer WHERE email_address = '$email_address' and phone_number = '$phone_number'";
  $result = mysqli_query($connection, $select);
  if (mysqli_num_rows($result) > 0) {
    $_SESSION['error'] = "Set";
    echo '<script>
            window.setTimeout(function() {
    window.location.href = "signup.php";
}, 4000);
            </script>';
  } else {
    $insert = "INSERT INTO customer(customer_id,fullname,email_address,phone_number,address,password,verification_code) VALUES('$customer_id','$fullname','$email_address','$phone_number','$address','$password','$verification_code')";
    $result = mysqli_query($connection, $insert);
    if ($result) {
      $insert = "INSERT INTO customer_wallet(customer_id,wallet_balance) VALUES('$customer_id','0')";
      $result = mysqli_query($connection, $insert);
      $_SESSION['success'] = "set";
      echo '<script>
            window.setTimeout(function() {
    window.location.href = "otp.php";
}, 4000);
            </script>';
      $_SESSION['phone_number'] = $phone_number;
      $_SESSION['email_address'] = $email_address;
      $_SESSION['password'] = $sub_random;
      $_SESSION['fullname'] = $fullname;
      $message = "Dear " . strtoupper($fullname) . " Your One Time Password (OTP) is " . $verification_code . ".";
      $main_response = array();
      $headers = array('Content-Type: application/x-www-form-urlencoded');
      $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create';
      $arr_params = [
        'from' => 'SYNTHESIS C',
        'to' => $phone_number,
        'body' => $message,

        'append_sender' => 2, // Choose your Append Sender ID Option:
        //1 for none,
        // 2 for Hosted SIM Only
        // and 3 for all

        'api_token' => 'AcsZ1x1wNGgkIQieXPq54utCuRqE4NgsZUuxn04kJHYy9d58e8sr9wkTfZ8o', //Todo: Replace with your API Token

        'dnd' => 6, //Choose your preferred DND Management Option:
        // 1 for Get a refund,
        // 2 for Direct hosted SIM,
        // 3 for Hosted SIM Only,
        // 4 for Dual-Backup and
        // 5 for Dual-Dispatch
      ];
      if (is_array($arr_params)) {
        $final_url_data = http_build_query($arr_params, '', '&');
      }
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $final_url_data);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
      curl_setopt($ch, CURLOPT_VERBOSE, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      $main_response['body'] = curl_exec($ch);
      $main_response['code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
    } else {
      $_SESSION['error1'] = 'Eror';
    }
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Welcome to Synthesis Cafe</title>
  <!-- MDB icon -->
  <link rel="icon" href="../img/logo.png" type="image/png" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
  <div class="elfsight-app-6d2c57ce-281f-44db-b26c-14a15f7bc257"></div>
  <!-- Sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
</head>

<body style="background-color:#FBFBFB;">
  <!-- Start your project here-->

  <div id="preview" class="preview">
    <div style="display: none;">
    </div>
    <div>
      <div data-draggable="true" class="shadow-4" style="position: relative;">
        <!---->
        <!---->
        <section draggable="false" class="overflow-hidden pt-0" data-v-271253ee="">
          <section class="" style="padding-bottom: 1px;">
            <!-- Navbar -->

            <nav class="navbar navbar-expand-lg  navbar-light shadow-2" style="background-color:#275D2B; ">
              <!-- Container wrapper -->
              <div class="container">
                <!-- Navbar brand -->

                <a class="navbar-brand me-2" href="index.php">
                  <img src="../img/logo.png" height="30" alt="logo" loading="lazy" style="margin-top: -1px;" /> &nbsp; <b class="text-white">SYNTHESIS CAFE</b>
                </a>

                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarLeftAlignExample" aria-controls="navbarLeftAlignExample" aria-expanded="false" aria-label="Toggle navigation">
                  <i class=" text-white fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                  <!-- Left links -->
                  <ul class="navbar-nav ms-auto mx-3 mb-2 mb-lg-0 ">
                    <li class="nav-item ">
                      <a class=" mx-3 nav-link text-white active" aria-current="page" href="../index.php"><i class="fas fa-home" style="color:yellow"></i>&nbsp;Home</a>
                    </li>
                    <li class="nav-item ">
                      <a class=" mx-3 nav-link text-white active" aria-current="page" href="signup.php"><i class="fas fa-users" style="color:yellow"></i>&nbsp;Sign Up</a>
                    </li>
                    <li class="nav-item ">
                      <a class=" mx-3 nav-link text-white active" aria-current="page" href="login.php"><i class="fas fa-sign-in-alt" style="color:yellow"></i>&nbsp;Login</a>
                    </li>
                  </ul>
                  <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->
              </div>
              <!-- Container wrapper -->
            </nav>
            <!-- Navbar -->
          </section>
        </section>
        <!---->
      </div>

      <section class="wrapper">

        <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 " style="margin-top:80px; margin-bottom:80px;">
          <!-- Grid column -->
          <div class="card shadow-2-strong">
            <div class="card-body ">
              <!--Header-->
              <div class="shadow-2-strong rounded pt-4 pb-2" style="background-color:#1B5E20; margin-top:-50px;">
                <h4 class="h4-responsive text-center text-white" style="margin-top:-10px;"><i class="fas fa-users"></i> Account Creation</h4>
              </div>

              <form action="signup.php" method="post">

                <div class="mt-3">
                  <!-- Default input email -->
                  <label for="fullname" class="font-weight-bold"> Full Name</label>

                  <div class="col-12">
                    <input type="text" name="fullname" value="" placeholder="Full name " class="form-control  " required>
                  </div>
                  <div class="mt-3">
                    <!-- Default input Email Address -->
                    <label for="email" class="font-weight-bold">Email Address</label>
                    <div class="col-12">
                      <input type="email" name="email_address" placeholder="example@exmple.com" value="" class="form-control " required>
                    </div>
                    <div class="mt-3">
                      <!-- Default input Email Address -->
                      <label for="phone" class="font-weight-bold">Phone Number</label>
                      <div class="col-12">
                        <input type="text" name="phone_number" placeholder="E.g 08123456789" value="" class="form-control " required>
                      </div>
                      <div class="mt-3">
                        <!-- Default input Address -->
                        <label for="address" class="font-weight-bold">Contact Address</label>
                        <div class="col-12">
                          <input type="text" name="address" placeholder="E.g Center for Cyberspace, NSUK" value="" class="form-control " required>
                        </div>
                        <div class="mt-2 mb-2">
                          Already Registered? <a class="text-success" href="login.php">Click Here</a>
                        </div>
                        <div class="text-center mt-4">
                          <button class="btn btn" style="background-color:#1B5E20; color:white;" type="submit" name="register" value="Search"><i class="fas fa-forward"></i>&nbsp;SIGN UP</button>
                        </div>
                      </div>

              </form>

            </div>
          </div>
        </div>
        <!-- Grid column -->


    </div>
  </div>
  </div>
  <?php
  if (isset($_SESSION['success'])) { ?>
    <script>
      swal({
        title: "Success!",
        text: "Dear <?php echo $fullname; ?> An OTP has been sent to this Phone Number + 234<?php echo  ltrim($phone_number, "0"); ?>",
        icon: "success",
        button: "OK",
      });
    </script>
  <?php
  } elseif (isset($_SESSION['error'])) { ?>
    <script>
      swal({
        title: "Error!",
        text: "Dear <?php echo $fullname; ?> This Email Address <?php echo $email_address; ?> and Phone Number +234<?php echo  ltrim($phone_number, "0"); ?> Already Exist",
        icon: "error",
        button: "OK",
      });
    </script>

  <?php

  }
  ?>



  <div data-draggable="true" class="text-white" style="position: relative; background-color:#275D2B;">
    <!---->
    <!---->
    <section draggable="false" class="container pt-5" data-v-271253ee="">
      <section>
        <div class="row gx-lg-5">
          <div class="col-lg-4 col-md-5 mb-4 mb-lg-0" ">
                <div class=" col-md-8">
            <center><img src="../img/logo.png" height="100" width="100" alt="Logo"></center>
            <center>
              <h4 class="mt-2">WELCOME TO SC</h4>
            </center>
          </div>
          <div class="col-md-4">

          </div>


        </div>
        <div class="col-lg-8 cold-md-7 mb-4 mb-md-0">
          <div class="row gx-lg-5">
            <div class="col-md-6 mb-5">
              <div class="d-flex align-items-start">
                <div class="flex-shrink-0">
                  <div class="p-3 rounded-4 shadow-2-strong" style="background-color:#208728"> <i class="fas fa-headset fa-lg text-white fa-fw" aria-controls="#picker-editor"></i> </div>
                </div>
                <div class="flex-grow-1 ms-4">
                  <p class=" mb-1 text-white">Contact Us</p>
                  <p class="text-white mb-0"><i class="fas fa-envelope-square"></i>&nbsp;info@synthesiscafe.com.ng</p>
                  <p class="text-white mb-0"><i class="fas fa-phone-alt"></i>&nbsp;+234 7016409616</p>
                  <p class="text-white mb-0"><i class="fas fa-phone-alt"></i>&nbsp;+234 8066178827</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-5">
              <div class="d-flex align-items-start">
                <div class="flex-shrink-0">
                  <div class="p-3 rounded-4 shadow-2-strong" style="background-color:#208728"> <i class="fab fa-whatsapp fa-lg text-white fa-fw" aria-controls="#picker-editor"></i> </div>
                </div>
                <div class="flex-grow-1 ms-4">
                  <p class=" mb-1 text-white">Our Whatsapp Number</p>

                  <p class="text-white mb-0"><b><i class="fas fa-phone-alt"></i>&nbsp;+234 8066178827</p>

                </div>
              </div>
            </div>
            <div class="col-md-12 mb-5">
              <div class="d-flex align-items-start">
                <div class="flex-shrink-0">
                  <div class="p-3  rounded-4 shadow-2-strong" style="background-color:#208728"> <i class="fas fa-university fa-lg text-white fa-fw" aria-controls="#picker-editor"></i> </div>
                </div>
                <div class="flex-grow-1 ms-4">
                  <p class=" mb-1">Our Bank Details</p>
                  <p class="text-white mb-0"><b>Bank Name: </b>Access Bank</p>
                  <p class="text-white mb-0"><b>Account Number: </b>0782435755</p>
                  <p class="text-white mb-0"><b>Account Name: </b>Joseph Abraham Dangana</p>

                </div>
              </div>
            </div>

          </div>
        </div>
  </div>
  </section>
  </section>
  <!---->
  </div>
  </div>

  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>