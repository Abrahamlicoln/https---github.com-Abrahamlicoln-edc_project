<?php
session_start();
if (isset($_SESSION['login_in'])) {
  header("location:dashboard.php");
}
include 'database_connection.php';
if (isset($_POST['submit'])) {
  $email_address = filter_var(mysqli_real_escape_string($connection, $_POST['email_address']), FILTER_SANITIZE_EMAIL);
  $password = filter_var(mysqli_real_escape_string($connection, $_POST['password']), FILTER_SANITIZE_STRING);
  $sql = "SELECT * FROM customer where  email_address = '$email_address' and status='1' ";
  $query = mysqli_query($connection, $sql);
  $numRow = mysqli_num_rows($query);
  if ($numRow > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
      if (password_verify($password, $row['password'])) {
        $_SESSION['login_in'] = $row;
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "dashboard.php";
}, 4000);
            </script>';
      }
    }
  } else {
    $_SESSION['errorr'] = "Incorrect Credential";
    echo '<script>
            window.setTimeout(function() {
    window.location.href = "login.php";
}, 4000);
            </script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login to Synthesis Cafe</title>
  <!-- MDB icon -->
  <link rel="icon" href="../img/logo.png" type="image/png" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
  <div class="elfsight-app-6d2c57ce-281f-44db-b26c-14a15f7bc257"></div>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <!-- Sweet Alert -->

</head>

<body style="background-color:#FBFBFB;">
  <!-- Start your project here-->
  <?php
  if (isset($_SESSION['login_in'])) {
    echo "<script>
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3800,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})
</script>";
  } elseif (isset($_SESSION['errorr'])) {
    echo "<script>
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3800,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'error',
  title: 'Invalid Credentials'
})
</script>";
    unset($_SESSION['errorr']);
  }
  ?>

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
        <div class="container-fluid">
          <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 " style="margin-top:80px; margin-bottom:80px;">
            <!-- Grid column -->
            <div class="card shadow-2-strong">
              <div class="card-body">
                <!--Header-->
                <div class="shadow-2-strong rounded pt-4 pb-2" style="background-color:#1B5E20; margin-top:-50px;">
                  <h4 class="h4-responsive text-center text-white" style="margin-top:-10px;"><i class="fas fa-sign-in-alt"></i> Account Login</h4>
                </div>


                <form action="login.php" method="post">


                  <!-- Default input email -->
                  <div class="mt-4">
                    <label for="email" class="font-weight-bold">Your Email Address</label>

                    <div class="col-12">
                      <input type="email" name="email_address" value="" placeholder="Please Enter your Email Address here " class="form-control " required>
                    </div>
                    <div class="mt-3">
                      <!-- Default input password -->
                      <label for="password" class="font-weight-bold">Your Password</label>
                      <div class="col-12">
                        <input type="password" name="password" placeholder="Enter your Password here" value="" class="form-control mt-2 " required>
                      </div>
                      <div class="mt-2">
                        Not Yet Registered? <a class="text-warning" href="signup.php">Click Here</a>
                      </div>
                      <div class="mt-1 mb-2">
                        Forget Password? <a class="text-danger" href="reset.php">Click Here</a>
                      </div>
                      <div class="text-center mt-5">
                        <button class="btn btn" style="background-color:#1B5E20; color:white;" type="submit" name="submit" value="Search"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</button>
                      </div>
                    </div>
                  </div>
                </form>


              </div>

            </div>
            <!-- Grid column -->


          </div>
        </div>
    </div>



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