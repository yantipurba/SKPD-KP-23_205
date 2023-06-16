<?php
// Database configuration
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    // ... tambahkan field lain yang diinginkan

    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $errorMessage = "Username already exists";
    } else {
        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password, fullname, address, birthdate) 
                                VALUES (:username, :password, :fullname, :address, :birthdate)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->execute();

        // Redirect to user dashboard
        header('Location: user_dashboard.php');
        exit();
    }

    // Close the connection
    $conn = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
    <!-- CSS styles -->
    <style>
        body {
            background-image: url("bg.png");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Registration</h1>
        <!-- Registration form -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="form-group">
                <label for="birthdate">Date of Birth:</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>

            <!-- ... tambahkan field lain yang diinginkan -->

            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>

        <?php if (isset($errorMessage)) : ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>
