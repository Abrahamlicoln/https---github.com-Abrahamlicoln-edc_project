<?php
session_start();
include 'database_connection.php';
$data = $_SESSION['login_in'];
if ($_GET['parametersvalue']) {
    $id = $_GET['parametersvalue'];
    $sql = "SELECT * FROM purchase_id";
    $query = mysqli_query($connection, $sql);
    if ($numRow = mysqli_num_rows($query)) {
        while ($row = mysqli_fetch_assoc($query)) {
            $mainid = $row['id'];
            if (md5($mainid) == $id) {
                $serial_number = $row['serial_number'];
                $pin = $row['pin'];
            }
?>

<?php
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
    <title>NABTEB PIN Purchased | Synthesis Cafe</title>
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
                                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
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
            <div class="container-fluid">
                <div class="row mt-5 mb-5">
                    <div class="col-md-3 ">
                        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse">
                            <!-- Grid column -->
                            <div class="card shadow-2-strong">
                                <div class="card-body">
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
                                    <a style="color:#275D2B;" href="logout.php"><i class="fas fa-lock-open"></i>&nbsp;Logout</a>
                                    <hr>
                                </div>
                            </div>
                        </nav>
                    </div>

                    <div class="col-md-9 mt-2 print-container ">
                        <!-- Grid column -->
                        <div class="card shadow-2-strong">
                            <div class="card-body ">
                                <div class="row" style="margin-top:-10px;">
                                    <div class="col-md-8 col-sm-12">
                                        <h4 class="text-success">Synthesis Cafe</h4>
                                        <span>Center for Cyberspace,<br>Nasarawa State University, Keffi

                                        </span><br><br>
                                        <span><b>To: </b><?php echo $data['fullname']; ?><br>

                                        </span>
                                        <span><?php echo $data['address']; ?>

                                        </span>

                                    </div>
                                    <div class="col-md-4 ml-auto col-sm-12">
                                        <p class="float-right mt-4"> Printed on: <b> <?php echo date("l F j, Y"); ?></b></p>

                                    </div>
                                    <div class="col-md-5 mt-3">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead style="background-color:#EEEEEE;">
                                                    <tr>
                                                        <th scope="col"><b>DESCRIPTION</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="font-size:18px;"><b>NABTEB RESULT CHECKER PIN</b></th>

                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead style="background-color:#EEEEEE;">
                                                    <tr>
                                                        <th scope="col"><b>S/N</b></th>
                                                        <th scope="col"><b>PIN</b></th>
                                                        <th scope="col"><b>SERIAL NUMBER</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="font-size:18px;"><b>1</b></th>
                                                        <th scope="row" style="font-size:18px;"><b><?php echo $pin; ?></h5>
                                                                </center></b></th>
                                                        <th scope="row" style="font-size:18px;"><b><?php echo $serial_number; ?></b></th>

                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" onclick="window.print();" class="btn btn-success mt-4"><i class="fas fa-print"></i> PRINT</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            <!-- Gsrid column -->

            <div data-draggable="true" class="text-white" style="position: relative; background-color:#275D2B;">
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
                                            <p class="fw-bold mb-1 text-white">Contact Us</p>
                                            <p class="text-white mb-0"><i class="fas fa-envelope-square"></i>&nbsp;info@nsukcombination.com.ng</p>
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