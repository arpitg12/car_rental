<?php
include '../backend/db.php'; // Adjust the path as necessary

// Initialize variables to avoid PHP notice errors
$name = $email = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data and sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'customer';

    // Check if email already exists in the database
    $check_email_sql = "SELECT * FROM users WHERE email = '$email'";

// Yeh line ek SQL query banati hai jo users table se un sabhi records ko chunta hai jinka email column ka value $email ke barabar hota hai.
// $email ek variable hai jisme user ka email address hota hai jo aap check karna chahte hain.
// $check_result = $conn->query($check_email_sql);

// Yeh line SQL query ko database mein execute karti hai.
// $conn ek connection object hai jo database se connected hai.
// query() method query ko execute karta hai aur result ko $check_result variable mein store karta hai.
// if ($check_result->num_rows > 0) {

// Yeh line check karti hai ki query ke result mein kitni rows (records) return hui hain.
// num_rows property bataati hai ki result set mein kitni rows hain.
// Agar num_rows 0 se zyada hoti hai, to iska matlab hai ki email address database mein pehle se maujood hai.
// echo "Error: Email already exists";

// Agar if condition true hoti hai (matlab email address already exists), to yeh line ek error message print karti hai: "Error: Email already exists".



    $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_email_sql);

    if ($check_result->num_rows > 0) {
        echo "Error: Email already exists";
    } else {
        // Insert user into database
        $insert_sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
        
        if ($conn->query($insert_sql) === TRUE) {
            echo "<div class='container'>";
            echo "<h1>Customer Registration</h1>";
            echo "<script>
            alert('New customer registered successfully');
            window.location.href = '../index.php';
          </script>";
    } 
            // echo "New customer registered successfully";
            // echo "</div>";
            // // Redirect or display a success message
            // header('Location: ../index.php');
         else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
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
        input[type=text], input[type=email], input[type=password] {
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
        <h1>Customer Registration</h1>
        <form action="customer_register.php" method="POST"> <!-- Ensure the action is correct -->
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
