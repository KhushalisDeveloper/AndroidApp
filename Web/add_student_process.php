<?php
session_start();
include 'db/db_connection.php';
include 'includes/session_check.php'; // Ensures admin is logged in

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Retrieve and sanitize form data
    $department = trim($_POST['student_department']);
    $full_name = trim($_POST['student_full_name']);
    $enrollment_no = trim($_POST['student_enrollment_number']);
    $email = trim($_POST['student_email']);
    $sem = trim($_POST['student_sem']);
    $div = trim($_POST['student_div']);
    $mobile = trim($_POST['student_mobile_number']);

    // 2. Validate inputs
    if (empty($department) || empty($full_name) || empty($enrollment_no) || empty($email) || empty($sem) || empty($div) || empty($mobile)) {
        header("location: add_student.php?error=All fields are required.");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: add_student.php?error=Invalid email format.");
        exit;
    }
    
    if (!is_numeric($sem)) {
        header("location: add_student.php?error=Semester must be a number.");
        exit;
    }

    // 3. Check for unique enrollment number
    $stmt_check = $conn->prepare("SELECT id FROM students WHERE student_enrollment_number = ?");
    $stmt_check->bind_param("s", $enrollment_no);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        header("location: add_student.php?error=Enrollment number already exists.");
        $stmt_check->close();
        exit;
    }
    $stmt_check->close();

    // 4. Insert new student into the database
    $stmt_insert = $conn->prepare("INSERT INTO students (student_department, student_full_name, student_enrollment_number, student_email, student_sem, student_div, student_mobile_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("ssssiss", $department, $full_name, $enrollment_no, $email, $sem, $div, $mobile);

    if ($stmt_insert->execute()) {
        // 5. On success, update the backup file and redirect
        include_once 'includes/db_backup_function.php';
        update_database_backup();
        
        header("location: add_student.php?success=Student added successfully!");
    } else {
        header("location: add_student.php?error=An error occurred. Please try again.");
    }
    $stmt_insert->close();
    exit;

} else {
    header("location: add_student.php");
    exit;
}
?>
