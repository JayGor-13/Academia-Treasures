<?php
// Retrieve form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$collegeName = $_POST['collegeName'];
$number = $_POST['number'];
$password = $_POST['password'];

// Database connection
$conn = new mysqli('localhost', 'root', 'mysql', 'test');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind statement
$stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, email, collegeName, number, password) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $firstName, $lastName, $email, $collegeName, $number, $password);

// Execute statement
if ($stmt->execute()) {
    echo "Registration successful";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
