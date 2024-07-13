<?php
session_start();
include '../backend/db.php'; // Adjust the path as necessary for your project
 
// Check if user is authorized
if ($_SESSION['user_role'] !== 'customer') {
    echo "<script>
    alert('Unauthorized access (Agency do not allowed to book cars)');
    window.location.href = '../index.php';
  </script>";
    //die("Agency do not allowed to book cars");
}

// Fetch customer ID from session
$customer_id = $_SESSION['user_id'];

// Construct SQL query
$sql = "SELECT b.id, c.model, c.number, b.start_date, b.days 
        FROM bookings b 
        INNER JOIN cars c ON b.car_id = c.id 
        WHERE b.customer_id = '$customer_id'";

// Execute SQL query
$result = $conn->query($sql);

if ($result === false) {
    echo "Error: " . $conn->error;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        /* Additional or modified CSS for card styling */
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-body {
            padding: 16px;
        }
        .card-title {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 8px;
        }
        .card-text {
            font-size: 1rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>View Bookings</h1>
        <!-- Display bookings dynamically from backend -->
        <div id="bookings">
            <?php
            // Check if any bookings found
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>Booking ID: " . $row['id'] . "</h5>";
                    echo "<p class='card-text'>Car Model: " . $row['model'] . "<br>";
                    echo "Car Number: " . $row['number'] . "<br>";
                    echo "Start Date: " . $row['start_date'] . "<br>";
                    echo "Days: " . $row['days'] . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No bookings found.</p>";
            }

            // Close database connection
            $conn->close();
            ?>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>
