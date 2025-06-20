<?php
session_start();
include 'db/db_connection.php';
include 'includes/session_check.php'; // Ensures the user is logged in

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $admin_id = $_SESSION['admin_id'];

    // 1. Validate inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        header("location: profile.php?error=Please fill in all fields.");
        exit;
    }

    if ($new_password !== $confirm_password) {
        header("location: profile.php?error=New passwords do not match.");
        exit;
    }

    // 2. Get current password from DB
    $stmt = $conn->prepare("SELECT password FROM admins WHERE admin_id = ?");
    $stmt->bind_param("s", $admin_id);
    $stmt->execute();
    $stmt->bind_result($hashed_password_from_db);
    $stmt->fetch();
    $stmt->close();

    // 3. Verify current password
    if (password_verify($current_password, $hashed_password_from_db)) {
        // 4. Hash new password and update DB
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_stmt = $conn->prepare("UPDATE admins SET password = ? WHERE admin_id = ?");
        $update_stmt->bind_param("ss", $new_hashed_password, $admin_id);

        if ($update_stmt->execute()) {
            // On success, automatically update the database backup file
            include_once 'includes/db_backup_function.php';
            update_database_backup();
            
            header("location: profile.php?success=Password changed successfully!");
        } else {
            header("location: profile.php?error=An error occurred. Please try again.");
        }
        $update_stmt->close();
    } else {
        header("location: profile.php?error=Incorrect current password.");
    }
    exit;
} else {
    header("location: profile.php");
    exit;
}
?>
