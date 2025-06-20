<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign-Up</title>
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box" style="width: 400px;">
            <h2>Admin Registration</h2>
            <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error-message">' . htmlspecialchars($_GET['error']) . '</p>';
                }
                if (isset($_GET['success'])) {
                    echo '<p class="success-message">' . htmlspecialchars($_GET['success']) . '</p>';
                }
            ?>
            <form id="registerForm" action="register_process.php" method="POST">
                <div class="input-group">
                    <label for="admin_name">Admin Name</label>
                    <input type="text" id="admin_name" name="admin_name" required>
                </div>
                <div class="input-group">
                    <label for="admin_id">Admin ID</label>
                    <input type="text" id="admin_id" name="admin_id" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Create Account</button>
            </form>
            <p style="margin-top: 20px;">Already have an account? <a href="index.php">Login Here</a></p>
        </div>
    </div>
</body>
</html>
