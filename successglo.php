<?php
session_start();
include 'database_connection.php';
if (!isset($_SESSION['login_in'])) {
    header("Location:../index.php");
}
$data = $_SESSION['login_in'];
$email_address = $data['email_address'];
$fullname = $data['fullname'];
$phone_number = $data['phone_number'];
$glo = $_SESSION['glo'];
$amount = $_SESSION['amount'];
$buyer_phone = $_SESSION['buyer_phone'];
$main_amount = $amount * 100;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Payment Success for Glo Data Plan | Synthesis Cafe</title>
    <!-- MDB icon -->
    <link rel="icon" href="../img/logo.png" type=" image/png" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-6d2c57ce-281f-44db-b26c-14a15f7bc257"></div>
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
                                            <a class=" mx-3 nav-link text-white active" aria-current="page" href="dashboard.php"><i class="fas fa-home" style="color:yellow"></i>&nbsp;Home</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class=" mx-3 nav-link text-white active" aria-current="page" href="#"><i class="fas fa-users" style="color:yellow"></i>&nbsp;Welcome back <?php echo strtoupper($data['fullname']); ?></a>
                                        </li>
                                        <li class="nav-item ">
                                            <form action="logout.php" method="post">
                                                <button style="background:none; border:none ;" type="submit" class=" mx-3 nav-link text-white active" aria-current="page"><i class="fas fa-sign-in-alt" style="color:yellow"></i>&nbsp;Logout</button>
                                            </form>
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
            <style>
                @media print {
                    body * {
                        visibility: hidden;
                    }

                    .print-container,
                    .print-container * {
                        visibility: visible;
                    }


                    .print-container {
                        position: absolute;
                        left: 0;
                        top: 0;
                    }
                }
            </style>

            <div class="container-fluid">
                <div class="row mt-5 mb-5">
                    <div class="col-md-3 ">
                        <!-- Grid column -->
                        <div class="card shadow-2-strong">
                            <div class="card-body ">
                                <!--Header-->
                                <div class="shadow-2-strong rounded pt-4 pb-2" style="background-color:#1B5E20; margin-top:-50px;">
                                    <h4 class="h4-responsive text-center text-white" style="margin-top:-10px;"><i class="fas fa-bars"></i> Quick Menu</h4>
                                </div>
                                <hr>
                                <a style="color:#275D2B;" href="dashboard.php"><i class="fas fa-landmark"></i>&nbsp;Dashboard</a>
                                <hr>
                                <a style="color:#275D2B;" href="waec.php"><i class="fas fa-won-sign"></i></i>&nbsp;WAEC Scratch Card</a>
                                <hr>
                                <a style="color:#275D2B;" href="neco.php"><i class="fab fa-neos"></i>&nbsp;NECO Token</a>
                                <hr>
                                <a style="color:#275D2B;" href="nabteb.php"><i class="fas fa-sticky-note"></i>&nbsp;NABTEB Scratch Card</a>
                                <hr>
                                <a style="color:#275D2B;" href="paymenthistory.php"><i class="fas fa-history"></i>&nbsp;Payment History</a>
                                <hr>
                                <a style="color:#275D2B;" href="setpassword.php"><i class="fas fa-lock-open"></i>&nbsp;Change Password</a>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 mt-2 print-container ">
                        <!-- Grid column -->
                        <div class="card shadow-2-strong">
                            <div class="card-body ">
                                <!--Header-->
                                <div class="card-body">
                                    <div class="row" style="margin-top:-10px;">
                                        <div class="col-12">
                                            <div class=" mb-3" style="margin-top:-40px;">
                                                <center>
                                                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                                                    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_ya4ycrti.json" background="transparent" speed="0.2" style="width: 200px; height: 200px;" loop autoplay></lottie-player>
                                                </center>
                                                <div class="mt-2 mb-5">
                                                    <center>
                                                        <h5>You are have Successfully Purchased
                                                            <b>
                                                                <?php
                                                                $select = "SELECT * FROM glo WHERE plan_type = '$glo'";
                                                                $result = mysqli_query($connection, $select);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $plan = $row['plan'];
                                                                    $_SESSION['theplan'] = $plan;
                                                                    echo $plan;
                                                                }
                                                                ?>

                                                            </b>
                                                            for <b>&#8358;<?php echo number_format($amount); ?> </b> to this Phone Number: <b><?php echo $buyer_phone; ?></b>.
                                                        </h5>
                                                    </center>
                                                    <div class="text-center mt-3">
                                                        <a class="btn btn-success" href="glodata.php">Return to Home</a>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid column -->

            <div data-draggable="true" class="text-white" style="position: relative; background-color:#275D2B;">
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
                                            <p class="fw-bold mb-1 text-white">Contact Us</p>
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
                                            <p class="fw-bold mb-1 text-white">Our Whatsapp Number</p>

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
                                            <p class="fw-bold mb-1">Our Bank Details</p>
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