<?php
session_start();
include 'database_connection.php';
if (!isset($_SESSION['login_in'])) {
    header("Location:../index.php");
}
$data = $_SESSION['login_in'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Startimes Subscription | Synthesis Cafe</title>
    <!-- MDB icon -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="icon" href="../img/logo.png" type=" image/png" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                    <h4 class="h4-responsive text-center text-white" style="margin-top:-10px;"> Startimes Subscription <span style="font-size:16px;">(Scroll down to View your Tranx)</span></h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="startverify.php" method="post">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="fw-bold text-warning mt-2">Service Type</label>
                                                    <select class="form-select mb-3" name="" required="" readonly>
                                                        <option selected value="glo">Startimes Subscription</option>
                                                    </select>
                                                </div>
                                                <div class=" form-group">
                                                    <label class="fw-bold text-warning">Smart Card Number</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-credit-card " style="padding-top:5px; padding-bottom:5px;"></i></span>
                                                        </div>
                                                        <input type="number" required class="form-control mb-3" maxlength="11" inputmode="numeric" name="account_number" placeholder="Please Enter the IUC number you want to validate">
                                                    </div>
                                                </div>
                                                <div class=" form-group">
                                                    <label class="fw-bold text-warning">Subscriber Phone Number</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-phone-alt " style="padding-top:5px; padding-bottom:5px;"></i></span>
                                                        </div>
                                                        <input type="number" required class="form-control mb-3" maxlength="11" inputmode="numeric" name="phone_number" placeholder="Please Enter the Users Phone Number">
                                                    </div>
                                                </div>
                                                <div class=" form-group">
                                                    <label class="fw-bold text-warning">Bonquet</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-edit " style="padding-top:5px; padding-bottom:9px;"></i></span>
                                                        </div>
                                                        <select name="bonquet" onchange="GetDetail(this.value)" id="bonquet" class="form-select mb-3">
                                                            <option value="">-----Select-----</option>
                                                            <?php
                                                            $select = "SELECT * FROM startimes";
                                                            $result = mysqli_query($connection, $select);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $main_value = $row['plan_code'];
                                                                $main_option = $row['plan_name']; ?>
                                                                <option value="<?php echo $main_value; ?>"><?php echo $main_option; ?></option>
                                                            <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="fw-bold text-warning">Amount</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₦</span>
                                                        </div>
                                                        <input type="text" class="form-control mb-3" name="amount" id="amount" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="fw-bold text-warning">Payment Method</label>
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
                                        <button type="submit" name="buynow" class="btn btn-success"><i class="fas fa-credit-card"></i> Verify Now</button>
                                    </div>
                                    </form>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <!-- Grid column -->
                        <div class="card shadow-2-strong">
                            <div class="card-body ">
                                <!--Header-->
                                <div class="shadow-2-strong rounded pt-4 pb-2" style="background-color:#1B5E20; margin-top:-50px;">
                                    <h4 class="h4-responsive text-center text-white" style="margin-top:-10px;"><i class="fas fa-info-circle"></i></i> Guide</h4>
                                </div>
                                <h5 class="fw-bold mt-2">How it works:</h5>
                                <li>
                                    Enter the <b>Smart Card Number</b> of the Subscriber.
                                </li>
                                <li>
                                    Enter the <b><i>Phone Number</i></b> of the Subscriber
                                <li>
                                    Select the Desired Plan of the Subscriber.
                                </li>
                                <li>
                                    The Renewed Cycle for the Subscriber Plan
                                </li>
                                <li>
                                    Select your Preferred <b>Method of Payment</b>
                                </li>
                                <li>
                                    Click on <b>Verify Now</b>.
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
                            <div class="card-body ">
                                <!--Header-->
                                <div class="shadow-2-strong rounded pt-4 pb-2" style="background-color:#1B5E20; margin-top:-50px;">
                                    <h4 class="h4-responsive px-4 text-white" style="margin-top:-10px;"> Startimes Subcription History</h4>
                                </div>
                                <div class="mt-3">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>SUBSCRIBER PHONE NUMBER</th>
                                                    <th>SMART CARD NUMBER</th>
                                                    <th>PLAN TYPE</th>
                                                    <th>CYCLE</th>
                                                    <th>AMOUNT</th>
                                                    <th>DATE PURCHASED</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $customer_id = $data['customer_id'];
                                                $select = "SELECT * FROM startimespurchase WHERE customer_id='" . $customer_id . "' ORDER BY date_purchased DESC";
                                                $result = mysqli_query($connection, $select);
                                                if (mysqli_num_rows($result) > 0) {
                                                    $counter = 0;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $counter = $counter + 1;
                                                        $smart_card = $row['smart_card'];
                                                        $subscriber_phone = $row['subscriber_phone'];
                                                        $subscription_type = $row['subscription_type'];
                                                        $date = $row['date_purchased'];
                                                        $cycle = $row['cycle'];
                                                        $amount = $row['amount'];
                                                        $amount = number_format($amount);
                                                        $date = date("l, F j, Y", strtotime($date));
                                                ?>
                                                        <tr>
                                                            <td><?php echo $counter; ?></td>
                                                            <td><?php echo $subscriber_phone; ?></td>
                                                            <td><?php echo $smart_card; ?></td>
                                                            <td><?php echo $subscription_type; ?></td>
                                                            <td><?php echo $cycle; ?></td>
                                                            <td><?php echo "&#8358;" . $amount; ?></td>
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
                        <?php
                        if (isset($_SESSION['erorrr'])) {
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
  title: 'Please Check Your Smart Card Number Again'
})
</script>";
                            unset($_SESSION['erorrr']);
                        }

                        ?>
                        <?php

                        if (isset($_SESSION['main_success'])) {
                            $customer_name =  $_SESSION['name'];
                            echo "<script>
Swal.fire(
  'Subscription Successful',
  'Your Startimes Subscription to <b> $customer_name </b> is Successfully',
  'success'
)
</script>";
                            unset($_SESSION['main_success']);
                        } elseif (isset($_SESSION['main_error'])) {
                            echo "<script>
Swal.fire(
  'Subscription Failed',
  'Subscription Failed Please Try Again',
  'error'
)
</script>";
                        }
                        unset($_SESSION['main_error']);
                        ?>
                        <?php
                        if (isset($_SESSION['insuffient'])) {
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
                    title: 'You have Insufficient Balance to Purchase Startime Subscription.'
                })
            </script>";
                            unset($_SESSION['insuffient']);
                        }
                        ?>
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
    <script>
        function GetDetail(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var myObj = JSON.parse(this.responseText);
                    document.getElementById("amount").value = myObj[0];
                }
            }
            xmlhttp.open("GET", "fetch5.php?search=" + str, true);
            xmlhttp.send();
        }
    </script>
    <script>
        new SlimSelect({
            select: '#bonquet'
        })
    </script>
</body>

</html>