<?php
session_start();

// Clear previous error message
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Booking System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="header">
    <div class="container">
        <h1>Service Booking System</h1>
        <p>Professional Service Booking Form</p>
    </div>
</header>

<div class="container mt-5 mb-5">

    <div class="card booking-card">

        <div class="card-header">
            <h3>Service Booking Form</h3>
        </div>

        <div class="card-body">

            <?php if (!empty($error)): ?>

                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>

            <?php endif; ?>


            <form action="proses.php" method="POST">

                <!-- Full Name -->
                <div class="mb-3">
                    <label for="fullName" class="form-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="fullName"
                        name="fullName"
                        placeholder="Enter your full name"
                        required
                    >
                </div>


                <!-- IC Number -->
                <div class="mb-3">
                    <label for="icNumber" class="form-label">
                        IC Number
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="icNumber"
                        name="icNumber"
                        placeholder="e.g. 010203-08-1099"
                        required
                    >

                    <small class="text-muted">
                        Format: XXXXXX-XX-XXXX
                    </small>
                </div>


                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="example@email.com"
                        required
                    >
                </div>


                <!-- Phone -->
                <div class="mb-3">
                    <label for="phone" class="form-label">
                        Phone Number
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="phone"
                        name="phone"
                        placeholder="e.g. 012-3456789"
                        required
                    >

                    <small class="text-muted">
                        Format: 01X-xxxxxxx
                    </small>
                </div>


                <!-- Service Package -->
                <div class="mb-3">
                    <label for="package" class="form-label">
                        Service Package
                    </label>

                    <select
                        class="form-select"
                        id="package"
                        name="package"
                        required
                    >

                        <option value="">-- Select Package --</option>

                        <option value="Basic">
                            Basic - RM50/day
                        </option>

                        <option value="Premium">
                            Premium - RM80/day
                        </option>

                        <option value="Gold">
                            Gold - RM120/day
                        </option>

                    </select>
                </div>


                <!-- Duration -->
                <div class="mb-3">
                    <label for="duration" class="form-label">
                        Duration (Days)
                    </label>

                    <input
                        type="number"
                        class="form-control"
                        id="duration"
                        name="duration"
                        min="1"
                        placeholder="Enter duration"
                        required
                    >
                </div>


                <!-- Address -->
                <div class="mb-3">
                    <label for="address" class="form-label">
                        Address
                    </label>

                    <textarea
                        class="form-control"
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="Enter your address"
                        required
                    ></textarea>
                </div>


                <!-- State -->
                <div class="mb-4">
                    <label for="state" class="form-label">
                        State
                    </label>

                    <select
                        class="form-select"
                        id="state"
                        name="state"
                        required
                    >

                        <option value="">-- Select State --</option>

                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Penang">Penang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Putrajaya">Putrajaya</option>
                        <option value="Labuan">Labuan</option>

                    </select>
                </div>


                <!-- Submit -->
                <div class="d-grid">

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg"
                    >
                        Submit Booking
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<footer class="footer">
    <p>Service Booking System &copy; 2026</p>
</footer>

</body>
</html>