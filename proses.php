<?php

session_start();


// ==========================================
// FUNCTION 1: VALIDATE IC NUMBER
// Format: XXXXXX-XX-XXXX
// ==========================================

function validateIC($ic)
{
    return preg_match('/^\d{6}-\d{2}-\d{4}$/', $ic);
}


// ==========================================
// FUNCTION 2: VALIDATE PHONE NUMBER
// Format: 01X-xxxxxxx
// ==========================================

function validatePhone($phone)
{
    return preg_match('/^01\d-\d{7,8}$/', $phone);
}


// ==========================================
// FUNCTION 3: CALCULATE BOOKING
// ==========================================

function calculateBooking($package, $duration)
{
    $rates = [
        "Basic" => 50,
        "Premium" => 80,
        "Gold" => 120
    ];

    if (!isset($rates[$package])) {
        return 0;
    }

    return $rates[$package] * $duration;
}


// ==========================================
// CHECK FORM SUBMISSION
// ==========================================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: index.php");
    exit();

}


// ==========================================
// GET FORM DATA
// ==========================================

$fullName = trim($_POST['fullName'] ?? '');
$icNumber = trim($_POST['icNumber'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$package = trim($_POST['package'] ?? '');
$duration = trim($_POST['duration'] ?? '');
$address = trim($_POST['address'] ?? '');
$state = trim($_POST['state'] ?? '');


// ==========================================
// VALIDATION
// ==========================================

// Check empty fields

if (
    empty($fullName) ||
    empty($icNumber) ||
    empty($email) ||
    empty($phone) ||
    empty($package) ||
    empty($duration) ||
    empty($address) ||
    empty($state)
) {

    $_SESSION['error'] = "Please fill in all required fields.";

    header("Location: index.php");
    exit();

}


// ==========================================
// VALIDATE FULL NAME
// ==========================================

if (strlen($fullName) < 2) {

    $_SESSION['error'] = "Full Name must contain at least 2 characters.";

    header("Location: index.php");
    exit();

}


// ==========================================
// VALIDATE IC
// ==========================================

if (!validateIC($icNumber)) {

    $_SESSION['error'] =
        "Invalid IC Number. Please use format XXXXXX-XX-XXXX.";

    header("Location: index.php");
    exit();

}


// ==========================================
// VALIDATE EMAIL
// ==========================================

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $_SESSION['error'] =
        "Invalid email address.";

    header("Location: index.php");
    exit();

}


// ==========================================
// VALIDATE PHONE
// ==========================================

if (!validatePhone($phone)) {

    $_SESSION['error'] =
        "Invalid Phone Number. Please use format 01X-xxxxxxx.";

    header("Location: index.php");
    exit();

}


// ==========================================
// VALIDATE PACKAGE
// ==========================================

$allowedPackages = [
    "Basic",
    "Premium",
    "Gold"
];

if (!in_array($package, $allowedPackages)) {

    $_SESSION['error'] =
        "Invalid service package.";

    header("Location: index.php");
    exit();

}


// ==========================================
// VALIDATE DURATION
// ==========================================

if (!filter_var($duration, FILTER_VALIDATE_INT) || $duration < 1) {

    $_SESSION['error'] =
        "Duration must be a valid number greater than 0.";

    header("Location: index.php");
    exit();

}


// ==========================================
// CALCULATE TOTAL COST
// ==========================================

$totalCost = calculateBooking($package, $duration);


// ==========================================
// STORE DATA IN SESSION
// ==========================================

$_SESSION['booking'] = [

    'fullName' => $fullName,

    'icNumber' => $icNumber,

    'email' => $email,

    'phone' => $phone,

    'package' => $package,

    'duration' => $duration,

    'address' => $address,

    'state' => $state,

    'totalCost' => $totalCost

];


// ==========================================
// REDIRECT TO PAGE 3
// ==========================================

header("Location: profile.php");
exit();

?>