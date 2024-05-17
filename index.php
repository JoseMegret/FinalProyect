<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joy Dental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1> Testing </h1>
        <div class="logo">
            <h1>Joy Dental</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage_orders.php">Manage Orders</a></li>
                <li><a href="view_orders.php">View Order</a></li>
                <li><a href="login.php">Log In</a></li>
                <li><a href="signup.php">Sign Up</a></li>
                
            </ul>
        </nav>
    </header>
    <main>
        <div class="mission-statement">
            <p>
                <h1>Mission & Vision: Joy dental we restore your smile for you to express a joyful life.</h1>
              
            </p>
        </div>
        <div class="container">
        <section>
            <h2>General Information</h2>
            <p>Joy Dental specializes exclusively in removable dentures, focusing on Full and Partial denture solutions. We are deeply committed to providing the highest quality dental restorations, ensuring that each patient enjoys a fulfilling life with a smile they can be proud of. Our lab utilizes the latest in dental technology and materials to craft dentures that are not only aesthetically pleasing but also functional and comfortable. At Joy Dental, we believe that a great smile supports a joyful life, and we dedicate ourselves to achieving this outcome for every patient.</p>
        </section>

        <section>
            <h2>Types of Work We Do</h2>
            <ul>
                <li><strong>Full Dentures:</strong> These are complete sets of prosthetic teeth designed to replace all natural teeth on either the upper or lower jaw. Our full dentures are customized for comfort and to enhance the facial features of our patients.</li>
                <li><strong>Partial Dentures:</strong> Ideal for patients who still retain some of their natural teeth, partial dentures are crafted to fill in gaps and blend seamlessly with the existing teeth. We offer various types of partial dentures, including those made from metal frameworks and more aesthetic, flexible materials for superior comfort and fit.</li>
                <li><strong>Customization and Adjustments:</strong> Each denture is tailored to meet the specific dental and aesthetic needs of our patients. Adjustments are meticulously made to ensure the best fit and to address any changes in the patient’s dental structure over time.</li>
                <li><strong>Repairs and Maintenance:</strong> We provide prompt and efficient repair services for any issues that may arise with your dentures, as well as routine maintenance to extend the life of the product.</li>
            </ul>
        </section>
    </div>
    </main>
    <footer>
        <p>Contact us at (787)-607-4477 | email: megretdental@gmail.com</p>
    </footer>
</body>
</html>

<?php

$host = "localhost";
$user = "jose.megret";
$pass = "801217986";
$db = "jose.megret";

$conn = new mysqli("localhost", "jose.megret", "801217986", "jose.megret");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
