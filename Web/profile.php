<?php include 'includes/header.php'; ?>

<div class="content-header">
    <h1>Admin Profile</h1>
</div>

<div class="content-body">
    <h2>Change Password</h2>
    <p>Update your account's password here. Choose a strong password that you are not using elsewhere.</p>

    <?php if(isset($_GET['error'])): ?>
        <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>
    <?php if(isset($_GET['success'])): ?>
        <div class="success-message"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>

    <form action="change_password_process.php" method="POST" class="profile-form">
        <div class="input-group">
            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>
        <div class="input-group">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div class="input-group">
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn">Change Password</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
