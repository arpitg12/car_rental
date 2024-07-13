<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Agency</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Changed to Roboto font */
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 800px;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            color: #343a40;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 30px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 15px;
        }

        li a {
            display: inline-block;
            padding: 15px 40px; /* Equal padding for all buttons */
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            transition: transform 0.2s ease-in-out;
            background-image: linear-gradient(to bottom right, #007bff, #0056b3);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
            font-family: 'Montserrat', sans-serif; /* Added Montserrat font */
            font-weight: 600; /* Adjusted font weight for emphasis */
            text-transform: uppercase; /* Uppercase text */
            letter-spacing: 1px; /* Increased letter spacing for readability */
            font-size: 1.1rem; /* Adjusted font size */
        }

        li a:hover {
            transform: scale(1.05);
            background-image: linear-gradient(to bottom right, #0056b3, #003a6d);
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Welcome to Car Rental Agency</h1>
        <p>Explore our services:</p>
        <ul>
            <li><a href="customer/customer_register.php">Customer Registration</a></li>
            <li><a href="customer/login.php">Customer Login</a></li>
            <li><a href="agency/agency_register.html">Agency Registration</a></li>
            <li><a href="agency/add_car.php">Add New Car (Agency)</a></li>
            <li><a href="agency/available_cars.php">Available Cars</a></li>
            <li><a href="agency/view_bookings.php">View Bookings (Agency)</a></li>
        </ul>
    </div>
</body>
</html>
