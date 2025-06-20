<?php
include 'session_check.php';
$current_page = basename($_SERVER['PHP_SELF']);
$admin_name = htmlspecialchars($_SESSION['admin_name']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo ucfirst(str_replace('_', ' ', pathinfo($current_page, PATHINFO_FILENAME))); ?></title>
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-user-shield"></i> <span class="link-name"><?php echo $admin_name; ?></span></h3>
            <i class="fas fa-bars" id="menu-toggle"></i>
        </div>
        <ul class="nav-links">
            <li>
                <a href="admin_home.php" class="<?php echo ($current_page == 'admin_home.php') ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="link-name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="add_student.php" class="<?php echo ($current_page == 'add_student.php') ? 'active' : ''; ?>">
                    <i class="fas fa-user-plus"></i>
                    <span class="link-name">Add Student</span>
                </a>
            </li>
            <li>
                <a href="timetable.php" class="<?php echo ($current_page == 'timetable.php') ? 'active' : ''; ?>">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="link-name">Timetable</span>
                </a>
            </li>
            <li>
                <a href="profile.php" class="<?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
                    <i class="fas fa-user-cog"></i>
                    <span class="link-name">Profile</span>
                </a>
            </li>
            <li class="logout-link">
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="link-name">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
