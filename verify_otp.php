<?php
session_start();
include("connection/connect.php");

if (!isset($_SESSION['otp']) || !isset($_SESSION['registration_data'])) {
    header("Location: registration.php");
    exit();
}

if (isset($_POST['verify'])) {
    $entered_otp = $_POST['otp'];
    $otp_from_session = $_SESSION['otp'];

    if ($entered_otp == $otp_from_session) {
        // OTP verification successful, proceed with registration
        $registration_data = $_SESSION['registration_data'];

        // Insert user data into database
        $username = $registration_data['username'];
        $firstname = $registration_data['firstname'];
        $lastname = $registration_data['lastname'];
        $email = $registration_data['email'];
        $phone = $registration_data['phone'];
        $password = $registration_data['password'];
        $address = $registration_data['address'];

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Perform insertion query
        $query = "INSERT INTO users (username, f_name, l_name, email, phone, password, address, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $status = 1; // Set status to 1 for verified users
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "sssssssi", $username, $firstname, $lastname, $email, $phone, $hashed_password, $address, $status);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Unset session variables
            unset($_SESSION['otp']);
            unset($_SESSION['registration_data']);

            header("Location: login.php?registration=success");
            exit();
        } else {
            $message = "Registration failed!";
        }
    } else {
        $message = "Invalid OTP!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>OTP Verification</title>
</head>
<body>
    <h2>OTP Verification</h2>
    <form method="post">
        <div>
            <label for="otp">Enter OTP:</label>
            <input type="text" id="otp" name="otp" required>
        </div>
        <?php if (isset($message)) : ?>
            <div><?php echo $message; ?></div>
        <?php endif; ?>
        <div>
            <button type="submit" name="verify">Verify OTP</button>
        </div>
    </form>
</body>
</html>
