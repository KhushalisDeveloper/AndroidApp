<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Admin Login</h2>
            <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error-message">' . htmlspecialchars($_GET['error']) . '</p>';
                }
            ?>
            <?php
                if (isset($_GET['success'])) {
                    echo '<p class="success-message">' . htmlspecialchars($_GET['success']) . '</p>';
                }
            ?>
            <form id="loginForm" action="login.php" method="POST">

                <div class="input-group">
                    <label for="admin_id">Admin ID</label>
                    <input type="text" id="admin_id" name="admin_id" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required>
                        <i class="fas fa-eye-slash" id="togglePassword"></i>
                    </div>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
            <p style="margin-top: 20px;">Don't have an account? <a href="register.php">Sign Up Here</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            togglePassword.addEventListener('click', function () {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the icon
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });

            const form = document.getElementById('loginForm');
            form.addEventListener('submit', function(e) {
                const adminId = document.getElementById('admin_id').value.trim();
                const pass = document.getElementById('password').value.trim();

                if (adminId === '' || pass === '') {
                    e.preventDefault();
                    alert('All fields are required!');
                }
            });
        });
    </script>
</body>
</html>
