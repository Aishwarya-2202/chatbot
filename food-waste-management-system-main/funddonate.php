<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "demo"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $amount = htmlspecialchars($_POST['amount']);
    $name = htmlspecialchars($_POST['name']);
    $phoneno = htmlspecialchars($_POST['phoneno']);
    $email = htmlspecialchars($_POST['email']);
    $district = htmlspecialchars($_POST['district']);
    $address = htmlspecialchars($_POST['address']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO fund_donations (amount, name, phoneno, email, district, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("dsssss", $amount, $name, $phoneno, $email, $district, $address);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to thank you page
        header('Location: thankyou.html');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the home page if accessed directly
    header('Location: home.html');
    exit();
}
?>
