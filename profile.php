<?php

session_start();

/*
    Direct Access Prevention

    Jika tiada booking session,
    redirect kembali ke Page 1.
*/
if (!isset($_SESSION['booking'])) {

    header("Location: index.php");
    exit();
}


/*
    Ambil data daripada Session
*/
$booking = $_SESSION['booking'];

$fullName = $booking['fullName'];
$icNumber = $booking['icNumber'];
$email = $booking['email'];
$phone = $booking['phone'];
$package = $booking['package'];
$duration = $booking['duration'];
$address = $booking['address'];
$state = $booking['state'];
$totalCost = $booking['totalCost'];


/*
    Generate Booking ID

    First 4 characters of Name
    +
    Last 4 digits of IC
    +
    First 2 letters of Package
*/


$namePart = strtoupper(substr(
    preg_replace("/[^A-Za-z]/", "", $fullName),
    0,
    4
));


$icPart = substr(
    preg_replace("/[^0-9]/", "", $icNumber),
    -4
);


$packagePart = strtoupper(
    substr($package, 0, 2)
);


$bookingID = $namePart . $icPart . $packagePart;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Booking Profile</title>

    <style>

        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background-color: #f4f6f8;
        }

        .header {
            background-color: #1f4e78;
            color: white;
            padding: 25px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
        }

        .header p {
            margin: 8px 0 0;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .title {
            text-align: center;
            color: #1f4e78;
            margin-bottom: 25px;
        }

        .booking-id {
            text-align: center;
            background-color: #e8f1f8;
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .booking-id h3 {
            margin: 0 0 8px;
            color: #1f4e78;
        }

        .booking-id p {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 13px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            width: 35%;
            background-color: #f1f1f1;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            color: #1f4e78;
        }

        .logout {
            display: block;
            text-align: center;
            margin-top: 25px;
            padding: 13px;
            background-color: #c0392b;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .logout:hover {
            background-color: #962d22;
        }

    </style>

</head>

<body>

<div class="header">

    <h1>Service Booking System</h1>

    <p>Booking Profile</p>

</div>


<div class="container">

    <h2 class="title">
        Booking Summary
    </h2>


    <!-- Booking ID -->

    <div class="booking-id">

        <h3>Booking ID</h3>

        <p>
            <?php echo htmlspecialchars($bookingID); ?>
        </p>

    </div>


    <!-- Customer Information -->

    <table>

        <tr>
            <th>Full Name</th>

            <td>
                <?php echo htmlspecialchars($fullName); ?>
            </td>
        </tr>


        <tr>
            <th>IC Number</th>

            <td>
                <?php echo htmlspecialchars($icNumber); ?>
            </td>
        </tr>


        <tr>
            <th>Email</th>

            <td>
                <?php echo htmlspecialchars($email); ?>
            </td>
        </tr>


        <tr>
            <th>Phone Number</th>

            <td>
                <?php echo htmlspecialchars($phone); ?>
            </td>
        </tr>


        <tr>
            <th>Service Package</th>

            <td>
                <?php echo htmlspecialchars($package); ?>
            </td>
        </tr>


        <tr>
            <th>Duration</th>

            <td>
                <?php echo htmlspecialchars($duration); ?> hour(s)
            </td>
        </tr>


        <tr>
            <th>Address</th>

            <td>
                <?php echo nl2br(htmlspecialchars($address)); ?>
            </td>
        </tr>


        <tr>
            <th>State</th>

            <td>
                <?php echo htmlspecialchars($state); ?>
            </td>
        </tr>


        <tr>
            <th>Total Cost</th>

            <td class="total">
                RM <?php echo number_format($totalCost, 2); ?>
            </td>
        </tr>

    </table>


    <!-- Logout -->

    <a href="logout.php" class="logout">
        Logout
    </a>

</div>

</body>

</html>