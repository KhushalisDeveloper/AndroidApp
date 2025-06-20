<?php
session_start();
include 'db/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT admin_name, password FROM admins WHERE admin_id = ?");
    $stmt->bind_param("s", $admin_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($admin_name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Password is correct, start the session
            $_SESSION['loggedin'] = true;
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;

            header("location: admin_home.php");
            exit;
        } else {
            // Incorrect password
            header("location: index.php?error=Invalid ID or Password");
            exit;
        }
    } else {
        // Incorrect admin ID
        header("location: index.php?error=Invalid ID or Password");
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    // If not a POST request, redirect to login page
    header("location: index.php");
    exit;
}
?>
