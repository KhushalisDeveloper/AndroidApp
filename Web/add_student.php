<?php include 'includes/header.php'; ?>

<div class="content-header">
    <h1>Add Student</h1>
</div>

<div class="content-body">
    
    <!-- Add Student Form -->
    <div class="form-container">
        <h2>Add New Student</h2>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if(isset($_GET['success'])): ?>
            <div class="success-message"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>

        <form action="add_student_process.php" method="POST" class="add-form">
            <div class="form-row">
                <div class="input-group">
                    <label for="student_department">Department</label>
                    <input type="text" id="student_department" name="student_department" required>
                </div>
                <div class="input-group">
                    <label for="student_full_name">Full Name</label>
                    <input type="text" id="student_full_name" name="student_full_name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="input-group">
                    <label for="student_enrollment_number">Enrollment Number</label>
                    <input type="text" id="student_enrollment_number" name="student_enrollment_number" required>
                </div>
                <div class="input-group">
                    <label for="student_email">Email ID</label>
                    <input type="email" id="student_email" name="student_email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="input-group">
                    <label for="student_sem">Semester</label>
                    <input type="number" id="student_sem" name="student_sem" required>
                </div>
                <div class="input-group">
                    <label for="student_div">Division</label>
                    <input type="text" id="student_div" name="student_div" required>
                </div>
                 <div class="input-group">
                    <label for="student_mobile_number">Mobile Number</label>
                    <input type="text" id="student_mobile_number" name="student_mobile_number" required>
                </div>
            </div>
            <button type="submit" class="btn">Add Student</button>
        </form>
    </div>

    <!-- Student List Table -->
    <div class="table-container">
        <h2>Existing Students</h2>

        <!-- Filter Form -->
        <div class="filter-container">
            <form action="add_student.php" method="GET" class="filter-form">
                <input type="text" name="department" placeholder="Department" value="<?php echo isset($_GET['department']) ? htmlspecialchars($_GET['department']) : ''; ?>">
                <input type="number" name="sem" placeholder="Semester" value="<?php echo isset($_GET['sem']) ? htmlspecialchars($_GET['sem']) : ''; ?>">
                <input type="text" name="div" placeholder="Division" value="<?php echo isset($_GET['div']) ? htmlspecialchars($_GET['div']) : ''; ?>">
                <input type="text" name="enrollment_number" placeholder="Enrollment Number" value="<?php echo isset($_GET['enrollment_number']) ? htmlspecialchars($_GET['enrollment_number']) : ''; ?>">
                <button type="submit" class="btn">Filter</button>
                <a href="add_student.php" class="btn btn-secondary">Clear</a>
            </form>
        </div>

        <table class="student-table">
            <thead>
                <tr>
                    <th>Enrollment No.</th>
                    <th>Full Name</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Semester</th>
                    <th>Division</th>
                    <th>Mobile</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include 'db/db_connection.php';
                
                // Base query
                $sql = "SELECT * FROM students WHERE 1=1";
                $params = [];
                $types = '';

                // Append filters to the query
                if (!empty($_GET['department'])) {
                    $sql .= " AND student_department LIKE ?";
                    $params[] = "%" . $_GET['department'] . "%";
                    $types .= 's';
                }
                if (!empty($_GET['sem'])) {
                    $sql .= " AND student_sem = ?";
                    $params[] = $_GET['sem'];
                    $types .= 'i';
                }
                if (!empty($_GET['div'])) {
                    $sql .= " AND student_div LIKE ?";
                    $params[] = "%" . $_GET['div'] . "%";
                    $types .= 's';
                }
                if (!empty($_GET['enrollment_number'])) {
                    $sql .= " AND student_enrollment_number = ?";
                    $params[] = $_GET['enrollment_number'];
                    $types .= 's';
                }

                $sql .= " ORDER BY student_full_name ASC";
                
                $stmt = $conn->prepare($sql);
                if (!empty($params)) {
                    $stmt->bind_param($types, ...$params);
                }
                $stmt->execute();
                $students_result = $stmt->get_result();

                if ($students_result->num_rows > 0):
                    while($row = $students_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['student_enrollment_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_full_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_department']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_email']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_sem']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_div']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_mobile_number']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No students found matching your criteria.</td>
                    </tr>
                <?php endif; 
                $stmt->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
