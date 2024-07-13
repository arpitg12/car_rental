<?php
session_start();
include '../backend/db.php'; // Adjust the path as necessary for your project

// Process car booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize form data
    $car_id = htmlspecialchars($_POST['car_id']);
    $start_date = htmlspecialchars($_POST['start_date']);
    $days = htmlspecialchars($_POST['days']);
    $customer_id = $_SESSION['user_id'];

    // Insert booking into database
    $sql = "INSERT INTO bookings (customer_id, car_id, start_date, days) 
            VALUES ('$customer_id', '$car_id', '$start_date', '$days')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='container'>";
        echo "<script>
            alert('Car booked successfully');
            window.location.href = 'available_cars.php';
          </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    exit; // Stop further execution after processing booking
}

// Regular HTML output for initial page load
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        /* Add custom CSS for card styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }

        .car-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            background-color: #fff;
        }

        .car-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .car-card h3 {
            margin-top: 0;
            font-size: 1.5rem;
            color: #333;
        }

        .car-card p {
            margin-bottom: 8px;
            font-size: 1rem;
            color: #666;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 1.2rem;
            color: #6c757d;
            margin-top: 10px;
        }

        input[type=date],
        input[type=number] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type=submit] {
            background-color: #007bff;
            color: white;
            padding: 14px 20px;
            margin: 20px 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
        }

        button[type=submit]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Available Cars</h1>
        <!-- Display available cars dynamically from backend -->
        <div id="available-cars">
            <?php
            // Fetch available cars from the database
            $sql = "SELECT * FROM cars";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="car-card">';
                    echo '<h3>' . htmlspecialchars($row['model']) . '</h3>';
                    echo '<p>Number: ' . htmlspecialchars($row['number']) . '</p>';
                    echo '<p>Capacity: ' . htmlspecialchars($row['capacity']) . '</p>';
                    echo '<p>Rent per Day: $' . number_format($row['rent_per_day'], 2) . '</p>';
                    echo '<form action="" method="POST">';
                    echo '<input type="hidden" name="car_id" value="' . $row['id'] . '">';
                    echo '<label for="start_date">Start Date:</label>';
                    echo '<input type="date" id="start_date" name="start_date" required>';
                    echo '<label for="days">Number of Days:</label>';
                    echo '<input type="number" id="days" name="days" min="0" required>';
                    echo '<button type="submit">Book Car</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No cars available</p>'; // Handle case where no cars are found
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/script.js"></script>

</body>

</html>