<?php
include 'db.php'; // Database connection script

// Initialize variables to avoid PHP notice errors
$agency_name = $email = $password = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data and sanitize inputs
    $agency_name = htmlspecialchars($_POST['agency_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'agency';

    // Check if email already exists in the database
    $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_email_sql);

    if ($check_result->num_rows > 0) {
        echo "Error: Email already exists";
    } else {
        // Insert agency into database
        $insert_sql = "INSERT INTO users (name, email, password, role) VALUES ('$agency_name', '$email', '$password', '$role')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<script>
            alert('New agency registered successfully');
            window.location.href = '../index.php';
          </script>";
            // echo "New agency registered successfully";
            // header('Location: ../index.php');
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
