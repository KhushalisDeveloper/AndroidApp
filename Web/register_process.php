<?php
include 'db/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_name = trim($_POST['admin_name']);
    $admin_id = trim($_POST['admin_id']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // 1. Validate that all fields are filled
    if (empty($admin_name) || empty($admin_id) || empty($email) || empty($password)) {
        header("location: register.php?error=Please fill in all fields");
        exit;
    }

    // Extra: Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: register.php?error=Invalid email format");
        exit;
    }

    // 2. Check if Admin ID already exists
    // 2. Check if Admin ID or Email already exists
    $stmt_check = $conn->prepare("SELECT admin_id, email FROM admins WHERE admin_id = ? OR email = ?");
    $stmt_check->bind_param("ss", $admin_id, $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $stmt_check->bind_result($found_admin_id, $found_email);
        $stmt_check->fetch();
        if ($found_admin_id === $admin_id) {
             header("location: register.php?error=Admin ID already exists. Please choose another.");
        } else if ($found_email === $email) {
             header("location: register.php?error=Email address is already in use.");
        }
        $stmt_check->close();
        exit;
    }
    $stmt_check->close();

    // 3. Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 4. Insert the new admin into the database
    // 4. Insert the new admin into the database
    $stmt_insert = $conn->prepare("INSERT INTO admins (admin_name, admin_id, email, password) VALUES (?, ?, ?, ?)");
    $stmt_insert->bind_param("ssss", $admin_name, $admin_id, $email, $hashed_password);

    if ($stmt_insert->execute()) {
        // On success, automatically update the database backup file
        include_once 'includes/db_backup_function.php';
        update_database_backup();

        // Then redirect to login page with a success message
        header("location: index.php?success=Registration successful! You can now log in.");
        exit;
    } else {
        header("location: register.php?error=Something went wrong. Please try again.");
        exit;
    }

    $stmt_insert->close();
    $conn->close();

} else {
    // Redirect if accessed directly
    header("location: register.php");
    exit;
}
?>
