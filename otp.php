<?php
session_start();
include 'database_connection.php';
if (!isset($_SESSION['phone_number'])) {
    header("Location:index.php");
}
$phone = $_SESSION['phone_number'];
if (isset($_POST['submit'])) {
    $allotp = $_POST['otp'];
    $sql = "SELECT id,verification_code FROM customer where phone_number='$phone'";
    $query = mysqli_query($connection, $sql);
    if ($numRow = mysqli_num_rows($query)) {
        while ($row = mysqli_fetch_assoc($query)) {
            $newver = str_split($row['verification_code'], 1);
            $new_array = array_diff_assoc($allotp, $newver);
            if (!$new_array) {
                $_SESSION['pass'] = "Set";
                echo '<script>
    window.setTimeout(function() {
        window.location.href = "login.php";
    }, 5000);
</script>';
                $_SESSION['otp_match'] = "Success";
                $_SESSION['id'] = $row['id'];
                $id = $_SESSION['id'];
                $update = "UPDATE customer SET status= '1' WHERE id = '$id'";
                $main_query = mysqli_query($connection, $update);
                if ($main_query) {
                }
                $fullname = $_SESSION['fullname'];
                $phone = $_SESSION['phone_number'];
                $password = $_SESSION['password'];
                $email_address = $_SESSION['email_address'];
                $message = "Dear " . strtoupper($fullname) . " Please use your Email Address " . $email_address . " and this Password " . $password . " You can Change it When you Login.";
                $main_response = array();
                $headers = array('Content-Type: application/x-www-form-urlencoded');
                $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create';
                $arr_params = [
                    'from' => 'SYNTHESIS C',
                    'to' => $phone,
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
}
if (isset($_POST['resend'])) {
    $fullname = $_SESSION['fullname'];
    $phone = $_SESSION['phone_number'];
    $code = rand(100000, 999999);
    $message = "Dear " . strtoupper($fullname) . " Please use " . $code . " as your OTP to Complete your Registration. Thank you";
    $main_response = array();
    $headers = array('Content-Type: application/x-www-form-urlencoded');
    $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create';
    $arr_params = [
        'from' => 'EDC',
        'to' => $phone,
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
    $another = "UPDATE client SET verification_code = '$code' WHERE phone='$phone'";
    $another_query = mysqli_query($connection, $another);
    if ($another_query) {
        $_SESSION['otp_resend'] = 'Resend';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Two Step Verification | Synthesis Cafe</title>
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
                <div class="container-fluid">
                    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center" style="margin-top:80px; margin-bottom:80px;">
                        <!-- Grid column -->
                        <div class="card shadow-2-strong">
                            <div class="card-body">
                                <div class="shadow-2-strong rounded pt-4 pb-2" style="background-color:#1B5E20; margin-top:-50px;">
                                    <h4 class="h4-responsive text-center text-white" style="margin-top:-10px;"><i class="fas fa-shield-alt"></i> Two Step Verification</h4>
                                </div>
                                <div class="d-flex align-items-center justify-content-center fw-bold mt-3 mb-4">
                                    <span>Enter the OTP that was sent to +234<?php
                                                                                $main_phone = ltrim($phone, "0");
                                                                                echo substr($main_phone, 0, 4);
                                                                                ?></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                                        <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                                        <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                                        <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                                        <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                                        <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                                        <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                    </svg>
                                    <span>

                                    </span>
                                </div>
                                <form action="otp.php" method="post">
                                    <div class="otp_input text-start mb-2">
                                        <center> <label for="digit">Type your 6 digit OTP Verification code</label></center>
                                        <div class="d-flex align-items-center justify-content-between mt-2">
                                            <input type="text" id="first" name="otp[]" maxlength="1" class="form-control mx-2 py-2 text-center" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please Enter OTP')" placeholder="">
                                            <input type="text" id="second" name="otp[]" maxlength="1" class="form-control mx-2 py-2 text-center" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please Enter OTP')" placeholder="">
                                            <input type="text" id="three" name="otp[]" maxlength="1" class="form-control mx-2 py-2 text-center" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please Enter OTP')" placeholder="">
                                            <input type="text" id="four" name="otp[]" maxlength="1" class="form-control mx-2 py-2 text-center" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please Enter OTP')" placeholder="">
                                            <input type="text" id="five" name="otp[]" maxlength="1" class="form-control mx-2 py-2 text-center" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please Enter OTP')" placeholder="">
                                            <input type="text" id="six" name="otp[]" maxlength="1" class="form-control mx-2 py-2 text-center" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please Enter OTP')" placeholder="">

                                        </div>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn my-2" style="background-color:#254929; color:white;">Submit</button>

                                </form>
                                <form action="otp.php" method="post" class="mt-4">
                                    Didn’t get the code ?<input type="submit" name="resend" style="background-color:white; border:none; " value="Resend" class="text-success fw-bold text-decoration-none" style="color:#254929;" />
                                </form>
            </section>
            <?php
            if (isset($_SESSION['otp_match'])) { ?>
                <script>
                    swal({
                        title: "Success!",
                        text: "OTP Match the one that was Sent to Your Phone. A Temporarly Password will be Sent to your Phone Number +234<?php echo $_SESSION['phone_number']; ?>",
                        icon: "success",
                        button: "OK",
                    });
                </script>

            <?php
                unset($_SESSION['otp_match']);
            } elseif (isset($_SESSION['error1'])) { ?>
                <script>
                    swal({
                        title: "Error!",
                        text: "OTP does not Match. Please Try Again or Resend to get a New One",
                        icon: "error",
                        button: "OK",
                    });
                </script>

            <?php
                unset($_SESSION['error1']);
            }
            ?>
            <script>
                var a = document.getElementById("first"),
                    b = document.getElementById("second"),
                    c = document.getElementById("three");
                d = document.getElementById("four");
                e = document.getElementById("five");
                f = document.getElementById("six");
                a.onkeyup = function() {
                    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
                        b.focus();
                    }
                }
                b.onkeyup = function() {
                    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
                        c.focus();
                    }
                }
                c.onkeyup = function() {
                    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
                        d.focus();
                    }
                }
                d.onkeyup = function() {
                    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
                        e.focus();
                    }
                }
                e.onkeyup = function() {
                    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
                        f.focus();
                    }
                }
            </script>


        </div>

    </div>
    <!-- Grid column -->


    </div>
    </div>
    </div>

    <style>
        .swal-text {
            text-align: center;
        }
    </style>
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
                            <h4 class="mt-2">WELCOME TO NC</h4>
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