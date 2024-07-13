<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
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

        input[type=email],
        input[type=password] {
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

        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include '../backend/db.php'; // Adjust the path as necessary for your project
    
    // Initialize variables to avoid PHP notice errors
    $email = $password = '';

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Fetch form data and sanitize inputs
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];

        // Query database for user with provided email
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();  //fetch_assoc() method ek result set ki current row ko associative array ke roop mein fetch karta hai, aur us array ko $row variable mein store karta hai. Is 
            //tarah aap asaani se columns ke names se unki values ko access kar sakte hain, jaise $row['email'] se email address ko access karna.
    
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_role'] = $row['role'];
                echo "<div class='container'>";
                echo "<h1>Customer Login</h1>";
                echo "<script>
            alert('Login successful');
            window.location.href = '../index.php';
          </script>";
                // echo "Login successful";
                // echo "</div>";
                // // Redirect to another page or perform further actions
                // header('Location: ../index.php');
                exit;
            } else {
                echo "<div class='container'>";
                echo "<h1>Customer Login</h1>";
                echo "<div class='error'>Invalid password</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='container'>";
            echo "<h1>Customer Login</h1>";
            echo "<div class='error'>User not found</div>";
            echo "</div>";
        }
    }

    $conn->close();
    ?>

    <div class="container">
        <h1>Customer Login</h1>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>