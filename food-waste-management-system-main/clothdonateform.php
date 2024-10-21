<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $cloth_name = $_POST['clothname'];
    $cloth_type = $_POST['clothType'];
    $quantity = $_POST['quantity'];
    $name = $_POST['name'];
    $phoneno = $_POST['phoneno'];
    $district = $_POST['district'];
    $address = $_POST['address'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into cloth_donations table
    $sql = "INSERT INTO cloth_donations (cloth_name, cloth_type, quantity, name, phoneno, district, address)
            VALUES ('$cloth_name', '$cloth_type', '$quantity', '$name', '$phoneno', '$district', '$address')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a thank you page
        header('Location: thankyou.html');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // Redirect to the home page if accessed directly
    header('Location: home.html');
    exit();
}
?>
