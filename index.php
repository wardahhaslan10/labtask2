<?php
session_start();

// Jika ada error dari process.php, ambil dan paparkan
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Booking System</title>

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
            max-width: 750px;
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

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        .btn {
            width: 100%;
            padding: 13px;
            background-color: #1f4e78;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #163a5c;
        }

        .error {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .required {
            color: red;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>Service Booking System</h1>
    <p>Online Service Booking Form</p>
</div>

<div class="container">

    <h2 class="title">Customer Booking Form</h2>

    <?php if ($error != ''): ?>
        <div class="error">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="process.php" method="POST">

        <!-- 1. Full Name -->
        <div class="form-group">
            <label>
                Full Name <span class="required">*</span>
            </label>

            <input
                type="text"
                name="fullName"
                placeholder="Enter your full name"
                required
            >
        </div>

        <!-- 2. IC Number -->
        <div class="form-group">
            <label>
                IC Number <span class="required">*</span>
            </label>

            <input
                type="text"
                name="icNumber"
                placeholder="Example: 010203-04-5678"
                required
            >
        </div>

        <!-- 3. Email -->
        <div class="form-group">
            <label>
                Email <span class="required">*</span>
            </label>

            <input
                type="email"
                name="email"
                placeholder="example@gmail.com"
                required
            >
        </div>

        <!-- 4. Phone Number -->
        <div class="form-group">
            <label>
                Phone Number <span class="required">*</span>
            </label>

            <input
                type="text"
                name="phone"
                placeholder="Example: 012-3456789"
                required
            >
        </div>

        <!-- 5. Service Package -->
        <div class="form-group">
            <label>
                Service Package <span class="required">*</span>
            </label>

            <select name="package" required>
                <option value="">-- Select Package --</option>
                <option value="Basic">Basic - RM50/hour</option>
                <option value="Premium">Premium - RM80/hour</option>
                <option value="Gold">Gold - RM120/hour</option>
            </select>
        </div>

        <!-- 6. Duration -->
        <div class="form-group">
            <label>
                Duration (Hours) <span class="required">*</span>
            </label>

            <input
                type="number"
                name="duration"
                min="1"
                max="24"
                placeholder="Enter duration"
                required
            >
        </div>

        <!-- 7. Address -->
        <div class="form-group">
            <label>
                Address <span class="required">*</span>
            </label>

            <textarea
                name="address"
                placeholder="Enter your address"
                required
            ></textarea>
        </div>

        <!-- 8. State -->
        <div class="form-group">
            <label>
                State <span class="required">*</span>
            </label>

            <select name="state" required>
                <option value="">-- Select State --</option>
                <option value="Johor">Johor</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Penang">Penang</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Selangor">Selangor</option>
                <option value="Terengganu">Terengganu</option>
                <option value="Kuala Lumpur">Kuala Lumpur</option>
                <option value="Putrajaya">Putrajaya</option>
                <option value="Labuan">Labuan</option>
            </select>
        </div>

        <button type="submit" class="btn">
            Submit Booking
        </button>

    </form>

</div>

</body>
</html>