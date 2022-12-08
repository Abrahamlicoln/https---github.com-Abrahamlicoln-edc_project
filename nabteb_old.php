<?php
session_start();
include 'database_connection.php';
if (!isset($_SESSION['login_in'])) {
    header("Location:../index.php");
}
$data = $_SESSION['login_in'];
if (isset($_POST['buynow'])) {
    $nabteb_pin = filter_var(mysqli_real_escape_string($connection, $_POST['nabteb_pin']), FILTER_SANITIZE_STRING);
    $amount = filter_var(mysqli_real_escape_string($connection, $_POST['amount']), FILTER_SANITIZE_STRING);
    $payment_method = filter_var(mysqli_real_escape_string($connection, $_POST['payment_method']), FILTER_SANITIZE_STRING);
    $buyer_phone = filter_var(mysqli_real_escape_string($connection, $_POST['buyer_phone']), FILTER_SANITIZE_STRING);
    $quantity = filter_var(mysqli_real_escape_string($connection, $_POST['quantity']), FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['nabteb_pin'] = $nabteb_pin;
    $_SESSION['amount'] = $amount;
    $_SESSION['buyer_phone'] = $buyer_phone;
    $_SESSION['quantity'] = $quantity;
    if ($payment_method == "e-wallet") {
        $select = "SELECT * FROM customer_wallet WHERE customer_id='" . $data['customer_id'] . "'";
        $result = mysqli_query($connection, $select);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $wallet_balance = $row['wallet_balance'];
                if ($wallet_balance >= $amount_total) {
                    $new_amount = $wallet_balance - $amount_total;
                    $update = "UPDATE customer_wallet SET wallet_balance = '$new_amount' WHERE customer_id='" . $data['customer_id'] . "'";
                    $result = mysqli_query($connection, $update);
                    echo '<script>
    window.location.href = "walletactivate3.php";
            </script>';
                } else {
                    $_SESSION['insuffient'] = "Set";
                }
            }
        }
    } else {
        echo '<script>
    window.location.href = "payment3.php";
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
    <title>Buy NABTEB PIN | Synthesis Cafe</title>
    <!-- MDB icon -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
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
                    <div class="col-md-5 mb-5 ">
                        <!-- Grid column -->
                        <div class="card shadow-2-strong">
                            <div class="card-body ">
                                <!--Header-->
                                <div class="shadow-2-strong rounded pt-4 pb-2" style="background-color:#1B5E20; margin-top:-50px;">
                                    <h4 class="h4-responsive text-center text-white" style="margin-top:-10px;"> Buy NABTEB PIN<span style="font-size:16px;">(Scroll down to View your PIN)</span></h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        n
                                        <form action="nabteb.php" method="post">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="fw-bold text-warning">Card Type</label>
                                                    <select class="form-select mb-3" name="nabteb_pin" required="" readonly>
                                                        <option value="NABTEB Pin">NABTEB Pin</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="fw-bold text-warning">Unit Amount</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₦</span>
                                                        </div>
                                                        <input type="text" class="form-control mb-3" name="amount" value="750" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="fw-bold text-warning">Enter the Phone Number to Received PIN/Token</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-phone-alt " style="padding-top:5px; padding-bottom:5px;"></i></span>
                                                        </div>
                                                        <input type="text" required class="form-control mb-3" name="buyer_phone" placeholder="Please Enter the Phone Number of the buyer here">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="fw-bold text-warning">Quantity</label>
                                                    <select class="form-select mb-2" name="quantity" required="">
                                                        <option value="1">1</option>

                                                        <!-- <option value="2">2</option>

                                                        <option value="3">3</option>

                                                        <option value="4">4</option>

                                                        <option value="5">5</option>

                                                        <option value="6">6</option>

                                                        <option value="7">7</option>

                                                        <option value="8">8</option>

                                                        <option value="9">9</option> -->
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Payment Method</label>
                                                    <div role="radiogroup" aria-required="true">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="i0" class="custom-control-input" name="payment_method" value="e-wallet" required="">
                                                            <label class="custom-control-label" for="i0">e-Wallet</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="i1" class="custom-control-input" name="payment_method" value="debit-card" required="">
                                                            <label class="custom-control-label" for="i1">Debit Card</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="buynow" class="btn btn-success"><i class="fas fa-credit-card"></i> Buy Now</button>
                                    </div>
                                    </form>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <!-- Grid column -->
                        <div class="card shadow-2-strong">
                            <div class="card-body">
                                <!--Header-->
                                <div class="shadow-2-strong rounded pt-4 pb-2" style="background-color:#1B5E20; margin-top:-50px;">
                                    <h4 class="h4-responsive text-center text-white" style="margin-top:-10px;"><i class="fas fa-info-circle"></i></i> Guide</h4>
                                </div>
                                <h5 class="fw-bold mt-2">How to Check Your NABTEB Result:</h5>
                                <li>
                                    Login to WAEC Result Checker website via <b><a style="text-decoration:none; color:green;" href="https://eworld.nabteb.gov.ng/">https://eworld.nabteb.gov.ng/</a></b>
                                </li>
                                <li>
                                    Enter your Candidates Identification Number <b>e.g. 38001178</b>
                                </li>
                                <li>
                                    Select the Type of Examination
                                </li>
                                <li>
                                    Enter the 4 digits of your Examination Year e.g. 2002
                                </li>
                                <li>
                                    Enter the Card Serial Number found on the reverse side of your Scratch card. The Card Serial Number has an alphabet prefix followed by digits <b> e.g. N123456789</b>
                                </li>
                                <li>
                                    Enter the 12-digit Personal Identification Number (PIN) on your Scratch card <b> eg. 012345678912</b>
                                </li>
                                <li>
                                    Click Submit and wait for the results window to come up
                                </li>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container-fluid">
                <div class="row mt-5 mb-5">
                    <div class="col-md-12 mt-3">
                        <!-- Grid column -->
                        <div class="card shadow-2-strong">
                            <div class="card-body">
                                <!--Header-->
                                <div class="shadow-2-strong rounded pt-4 pb-2" style="background-color:#1B5E20; margin-top:-50px;">
                                    <h4 class="h4-responsive px-4 text-white" style="margin-top:-10px;"> NABTEB PIN Purchase History</h4>
                                </div>
                                <div class="mt-3">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>BUYER'S PHONE NUMBER</th>
                                                    <th>SERIAL NUMBER</th>
                                                    <th>PIN</th>
                                                    <th>PRINT</th>
                                                    <th>DATE</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $customer_id = $data['customer_id'];
                                                $select = "SELECT * FROM purchase_id WHERE customer_id='" . $customer_id . "' and card_type='NABTEB Pin' and payment_status='Successful' ORDER BY date_purchase DESC";
                                                $result = mysqli_query($connection, $select);
                                                if (mysqli_num_rows($result) > 0) {
                                                    $counter = 0;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $counter = $counter + 1;
                                                        $id = $row['id'];
                                                        $phone_number = $row['buyer_phone'];
                                                        $serial_number = $row['serial_number'];
                                                        $pin = $row['pin'];
                                                        $date = $row['date_purchase'];
                                                        $hash = md5($id);
                                                        $date = date("l, F j, Y", strtotime($date));
                                                ?>
                                                        <tr>
                                                            <td><?php echo $counter; ?></td>
                                                            <td><?php echo $phone_number; ?></td>
                                                            <td><?php echo $serial_number; ?></td>
                                                            <td><?php echo $pin; ?></td>
                                                            <td> <a class="btn btn-success" href="printout3.php?parametersvalue=<?php echo $hash; ?>">Print PIN</a></td>
                                                            <td><?php echo $date; ?></td>

                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_SESSION['succeed'])) {
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
  title: 'You have Successfully Purchase NABTEB PIN from Your Wallet Scroll Down to Print it.'
})
</script>";
                unset($_SESSION['succeed']);
            } elseif (isset($_SESSION['nabtebsuccess'])) {
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
  title: 'You have Successfully Purchase NABTEB PIN from Your Wallet Scroll Down to Print it.'
})
</script>";
                unset($_SESSION['nabtebsuccess']);
            } elseif (isset($_SESSION['insuffient'])) {
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
  title: 'You have Insufficient Balance to Purchase NABTEB PIN.'
})
</script>";
                unset($_SESSION['insuffient']);
            } elseif (isset($_SESSION['main_error'])) {
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
  title: 'Error Occured.'
})
</script>";
                unset($_SESSION['main_error']);
            }
            ?>
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
        </div>
        </section>
        </section>
        <!---->
    </div>
    </div>

    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>