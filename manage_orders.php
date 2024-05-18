<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = trim($_POST['type']);  // Use trim to remove any whitespace
    $material = $_POST['material'];

    // Retrieve the denture_id for the selected type
    $stmt = $conn->prepare("SELECT denture_id FROM Dentures WHERE type = ?");
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $denture_id = $row['denture_id'];
    } else {
        echo "Denture type not found or no matching entry for type: " . htmlspecialchars($type);
        exit;
    }

    // Retrieve the material_id and price
    $stmt = $conn->prepare("SELECT material_id, cost FROM Materials WHERE name = ?");
    $stmt->bind_param("s", $material);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $material_id = $row['material_id'];
        $price = $row['cost'];  // Assuming cost is the price of the material
    } else {
        echo "Material not found or no matching entry for material: " . htmlspecialchars($material);
        exit;
    }

    $status = 'Pending';
    $order_date = date('Y-m-d');
    $due_date = date('Y-m-d', strtotime("+30 days"));

    $stmt = $conn->prepare("INSERT INTO Orders (patient_id, denture_id, material_id, order_date, due_date, status) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt->bind_param("iiisss", $_SESSION['user_id'], $denture_id, $material_id, $order_date, $due_date, $status)) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        exit;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        exit;
    } else {
        header("Location: payment_page.php");
        exit;
    }
    $stmt->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Joy Dental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo"><h1>Joy Dental</h1></div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="view_orders.php">View Order</a></li>
                <li><a href="login.php">Log In</a></li>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="payment_page.php">Payment Page</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="manage_orders.php" method="POST">
            <section>
                <h2>Type of Work</h2>
                <label><input type="radio" name="type" value="Partial" onclick="updateMaterials('Partial');" checked> Partial Denture</label>
                <label><input type="radio" name="type" value="Full" onclick="updateMaterials('Full');"> Full Denture</label>
            </section>
            <section id="materialsSection">
                <h2>Materials</h2>
                <!-- Materials options will be filled based on the selection of type of work -->
            </section>
            <section>
                <h2>Price</h2>
                <p id="price">Select a type and material to see price.</p>
            </section>
            <section>
                <h2>Logistics of the Work</h2>
                <ul>
                    <li>Patient chooses the type of Work they want.</li>
                    <li>Impression kit is sent to the patient.</li>
                    <li>Patient sends back their impressions and selections.</li>
                    <li>Teeth setup returned for try-in.</li>
                    <li>Adjustments and final production.</li>
                </ul>
                <p><strong>Timeline:</strong> 2 weeks testing + 1 month to finish.</p>
            </section>
            <button type="submit">Finalize Order</button>
        </form>
    </main>
    <footer>
        <p>Contact us at (787)-607-4477 | email: megretdental@gmail.com</p>
    </footer>
    <script>
        function updateMaterials(type) {
            let materialsHtml = '';
            if (type === 'Partial') {
                materialsHtml += '<label><input type="radio" name="material" value="Metal" onchange="updatePrice(550);"> Metal (chrome cobalt)</label>';
                materialsHtml += '<label><input type="radio" name="material" value="Nilon" onchange="updatePrice(550);"> Nilon (Flexible)</label>';
            } else if (type === 'Full') {
                materialsHtml += '<label><input type="radio" name="material" value="Acrylic" onchange="updatePrice(500);"> Acrylic (rigid)</label>';
            }
            document.getElementById('materialsSection').innerHTML = materialsHtml;
            updatePrice(type === 'Partial' ? 550 : 500);  // Default price based on type
        }

        // Initialize the materials section based on the default checked type
        document.addEventListener('DOMContentLoaded', function() {
            updateMaterials(document.querySelector('input[name="type"]:checked').value);
        });

        function updatePrice(price) {
            document.getElementById('price').textContent = 'Price: $' + price;
        }
    </script>
</body>
</html>