<?php

session_start();

/*
    Function untuk validate IC dan Phone
*/
function validateFormat($icNumber, $phone)
{
    $icPattern = "/^[0-9]{6}-[0-9]{2}-[0-9]{4}$/";
    $phonePattern = "/^01[0-9]-[0-9]{7,8}$/";

    if (!preg_match($icPattern, $icNumber)) {
        return "Invalid IC Number format. Please use XXXXXX-XX-XXXX.";
    }

    if (!preg_match($phonePattern, $phone)) {
        return "Invalid Phone Number format. Please use 01X-XXXXXXX.";
    }

    return "";
}


/*
    Function untuk calculate booking cost
*/
function calculateBooking($package, $duration)
{
    switch ($package) {

        case "Basic":
            $pricePerHour = 50;
            break;

        case "Premium":
            $pricePerHour = 80;
            break;

        case "Gold":
            $pricePerHour = 120;
            break;

        default:
            return 0;
    }

    return $pricePerHour * $duration;
}


/*
    Pastikan data dihantar menggunakan POST
*/
if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: index.php");
    exit();
}


/*
    Ambil data daripada form
*/
$fullName = trim($_POST['fullName'] ?? '');
$icNumber = trim($_POST['icNumber'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$package = trim($_POST['package'] ?? '');
$duration = trim($_POST['duration'] ?? '');
$address = trim($_POST['address'] ?? '');
$state = trim($_POST['state'] ?? '');


/*
    Validation
*/
if (
    $fullName == '' ||
    $icNumber == '' ||
    $email == '' ||
    $phone == '' ||
    $package == '' ||
    $duration == '' ||
    $address == '' ||
    $state == ''
) {

    $_SESSION['error'] = "Please fill in all required fields.";

    header("Location: index.php");
    exit();
}


/*
    Validate email
*/
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $_SESSION['error'] = "Invalid email address.";

    header("Location: index.php");
    exit();
}


/*
    Validate duration
*/
if (!is_numeric($duration) || $duration <= 0) {

    $_SESSION['error'] = "Duration must be a valid number greater than 0.";

    header("Location: index.php");
    exit();
}


/*
    Validate package
*/
$validPackages = ["Basic", "Premium", "Gold"];

if (!in_array($package, $validPackages)) {

    $_SESSION['error'] = "Invalid service package selected.";

    header("Location: index.php");
    exit();
}


/*
    Validate IC dan Phone menggunakan Regex Function
*/
$formatError = validateFormat($icNumber, $phone);

if ($formatError != '') {

    $_SESSION['error'] = $formatError;

    header("Location: index.php");
    exit();
}


/*
    Calculate total cost
*/
$totalCost = calculateBooking($package, $duration);


/*
    Simpan semua data ke dalam Session
*/
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


/*
    Redirect ke Page 3
*/
header("Location: profile.php");
exit();

?>