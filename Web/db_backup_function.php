<?php
/**
 * This function executes the mysqldump command to create a fresh backup
 * of the entire 'admin_panel' database.
 */
function update_database_backup() {
    // Define the full path to mysqldump and the output file for reliability.
    $command = 'c:\\xampp\\mysql\\bin\\mysqldump.exe -u root admin_panel > c:\\xampp\\htdocs\\WEB\\admin_panel_backup.sql';

    // Wrap the command in 'cmd.exe /c' to ensure redirection works correctly on Windows.
    $full_command = 'cmd.exe /c "' . $command . '"';

    // Use @shell_exec to execute the command. The '@' suppresses errors from being output to the user.
    @shell_exec($full_command);
}
?>
