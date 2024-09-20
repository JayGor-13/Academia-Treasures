<?php
$loginError = ""; // Initialize login error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $con = mysqli_connect("localhost","root","mysql","test");

        // Check connection
        if (!$con) {
            throw new Exception("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM registration WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            throw new Exception("Error in SQL query: " . mysqli_error($con));
        }

        $num = mysqli_num_rows($result);
        if ($num == 1) {
            header("Location: main.html");
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            exit();
        } else {
            $loginError = "Invalid Credentials"; // Set error message for invalid credentials
        }
    } catch (Exception $e) {
        // Handle the exception, e.g., log it, display a generic error message, etc.
        $loginError = "An error occurred. Please try again later.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .register-link {
            text-align: center;
            margin-top: 10px;
        }
        .register-link a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        
        <input type="submit" value="Login">
    </form>
    <?php 
        if($loginError === "Invalid Credentials"){
            echo "<p style='color:red; padding-left:800px'>$loginError</p>";
        }
    ?>
    <div class="register-link">
        <p>Not registered yet? <a href="register.html">Register here</a></p>
    </div>
</body>
</html>
