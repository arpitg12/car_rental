<?php
session_start();
include '../backend/db.php'; // Adjust the path as necessary for your project

// Check if user is authorized as an agency
if ($_SESSION['user_role'] !== 'agency') {
    echo "<script>
    alert('Unauthorized access');
    window.location.href = '../index.php';
  </script>";
    //die("Unauthorized access");
}

// Initialize variables to avoid PHP notice errors
$model = $number = $capacity = $rent_per_day = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data and sanitize inputs
    $model = htmlspecialchars($_POST['model']);
    $number = htmlspecialchars($_POST['number']);
    $capacity = intval($_POST['capacity']); // Ensure capacity is an integer
    $rent_per_day = floatval($_POST['rent_per_day']); // Ensure rent_per_day is a float

    // Retrieve agency ID from session
    $agency_id = $_SESSION['user_id'];

    // Insert new car into database
    $sql = "INSERT INTO cars (model, number, capacity, rent_per_day, agency_id) 
            VALUES ('$model', '$number', '$capacity', '$rent_per_day', '$agency_id')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to homepage after successful insertion
        header('Location: ../index.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Car</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 2.5rem;
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            font-size: 1.2rem;
            color: #6c757d;
        }
        input[type=text], input[type=number] {
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
        <h1>Add New Car</h1>
        <form action="add_car.php" method="POST">
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" value="<?php echo $model; ?>" required>
            <label for="number">Vehicle Number:</label>
            <input type="text" id="number" name="number" value="<?php echo $number; ?>" required>
            <label for="capacity">Seating Capacity:</label>
            <input type="number" id="capacity" min="0" name="capacity" value="<?php echo $capacity; ?>" required>
            <label for="rent_per_day">Rent per Day:</label>
            <input type="number" id="rent_per_day" name="rent_per_day" value="<?php echo $rent_per_day; ?>" required>
            <button type="submit">Add Car</button>
        </form>
    </div>
</body>
</html>
