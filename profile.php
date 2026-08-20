<?php

session_start();


// ==========================================
// DIRECT ACCESS PREVENTION
// ==========================================

if (!isset($_SESSION['booking'])) {

    header("Location: index.php");
    exit();

}


// ==========================================
// GET BOOKING DATA
// ==========================================

$booking = $_SESSION['booking'];


// ==========================================
// ASSIGN DATA
// ==========================================

$fullName = $booking['fullName'];
$icNumber = $booking['icNumber'];
$email = $booking['email'];
$phone = $booking['phone'];
$package = $booking['package'];
$duration = $booking['duration'];
$address = $booking['address'];
$state = $booking['state'];
$totalCost = $booking['totalCost'];


// ==========================================
// GENERATE BOOKING ID
//
// First 4 characters of Name
// +
// Last 4 digits of IC
// +
// First 2 letters of Package
// ==========================================

$namePart = strtoupper(substr(
    preg_replace('/\s+/', '', $fullName),
    0,
    4
));


// Remove '-' from IC

$cleanIC = str_replace("-", "", $icNumber);

$icPart = substr($cleanIC, -4);


$packagePart = strtoupper(substr($package, 0, 2));


$bookingID = $namePart . $icPart . $packagePart;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Booking Profile</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="style.css">

</head>


<body>


<header class="header">

    <div class="container">

        <h1>Service Booking System</h1>

        <p>Booking Profile</p>

    </div>

</header>


<div class="container mt-5 mb-5">


    <div class="card booking-card">


        <div class="card-header">

            <h3>Booking Summary</h3>

        </div>


        <div class="card-body">


            <!-- BOOKING ID -->

            <div class="booking-id">

                <p>Booking ID</p>

                <h2>
                    <?php echo htmlspecialchars($bookingID); ?>
                </h2>

            </div>


            <hr>


            <!-- CUSTOMER INFORMATION -->

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Full Name</strong>
                </div>

                <div class="col-md-8">
                    <?php echo htmlspecialchars($fullName); ?>
                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>IC Number</strong>
                </div>

                <div class="col-md-8">
                    <?php echo htmlspecialchars($icNumber); ?>
                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Email</strong>
                </div>

                <div class="col-md-8">
                    <?php echo htmlspecialchars($email); ?>
                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Phone Number</strong>
                </div>

                <div class="col-md-8">
                    <?php echo htmlspecialchars($phone); ?>
                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Service Package</strong>
                </div>

                <div class="col-md-8">
                    <?php echo htmlspecialchars($package); ?>
                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Duration</strong>
                </div>

                <div class="col-md-8">
                    <?php echo htmlspecialchars($duration); ?> day(s)
                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Address</strong>
                </div>

                <div class="col-md-8">
                    <?php echo nl2br(htmlspecialchars($address)); ?>
                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>State</strong>
                </div>

                <div class="col-md-8">
                    <?php echo htmlspecialchars($state); ?>
                </div>

            </div>


            <hr>


            <!-- TOTAL -->

            <div class="total-box">

                <h4>Total Booking Cost</h4>

                <h2>
                    RM <?php echo number_format($totalCost, 2); ?>
                </h2>

            </div>


            <!-- LOGOUT -->

            <div class="text-center mt-4">

                <a
                    href="logout.php"
                    class="btn btn-danger"
                >
                    Logout
                </a>

            </div>


        </div>

    </div>

</div>


<footer class="footer">

    <p>
        Service Booking System &copy; 2026
    </p>

</footer>


</body>

</html>