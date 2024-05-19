<?php
session_start();
include 'db.php'; // Ensure this file contains the mysqli connection setup.
if (!$conn) {
    die("Database connection not established.");
}

// Display all errors
error_reporting(E_ALL);

// Display errors on the webpage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['date_of_birth'];
    $phone = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO Patients (first_name, last_name, date_of_birth, phone_number, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $first_name, $last_name, $dob, $phone, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['logged_in'] = true;
            header("Location: manage_orders.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Joy Dental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo"><h1>Joy Dental</h1></div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Log In</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="form-container">
            <h2>Create Account</h2>
            <form action="signup.php" method="POST">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <input type="date" name="date_of_birth" required>
                <input type="text" name="phone_number" placeholder="Phone Number" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit">Create Account</button>
            </form>
        </div>
    </main>
    <footer>
        <p>Contact us at (787)-607-4477 | email: megretdental@gmail.com</p>
    </footer>
</body>
</html>