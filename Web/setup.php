<?php
// --- IMPORTANT ---
// This script is for one-time setup only.
// Run it once to create the database and admin table.
// After running, you should delete this file or move it out of the web root for security.

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Create Database
$sql_db = "CREATE DATABASE IF NOT EXISTS admin_panel";
if ($conn->query($sql_db) === TRUE) {
    echo "Database 'admin_panel' created successfully or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error . "<br>");
}

// Select the database
$conn->select_db('admin_panel');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Create Database
$sql_db = "CREATE DATABASE IF NOT EXISTS admin_panel";
if ($conn->query($sql_db) === TRUE) {
    echo "Database 'admin_panel' created successfully or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error . "<br>");
}

// Select the database
$conn->select_db('admin_panel');

// 2. Create Table
$sql_table = "CREATE TABLE IF NOT EXISTS admins (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    admin_name VARCHAR(50) NOT NULL,
    admin_id VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if ($conn->query($sql_table) === TRUE) {
    echo "Table 'admins' created successfully or already exists.<br>";
} else {
    echo "Error creating table 'admins': " . $conn->error . "<br>";
}

// 3. Create Students Table
$sql_students_table = "CREATE TABLE IF NOT EXISTS students (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_department VARCHAR(100) NOT NULL,
    student_full_name VARCHAR(100) NOT NULL,
    student_enrollment_number VARCHAR(50) NOT NULL UNIQUE,
    student_email VARCHAR(100) NOT NULL,
    student_sem INT(2) NOT NULL,
    student_div VARCHAR(5) NOT NULL,
    student_mobile_number VARCHAR(15) NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_students_table) === TRUE) {
    echo "Table 'students' created successfully or already exists.<br>";
} else {
    echo "Error creating table 'students': " . $conn->error . "<br>";
}

$conn->close();

echo "<hr>Setup complete. The database and table are ready. Please delete this file and use the sign-up page to create your first admin.";

?>
