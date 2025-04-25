<?php
include 'db.php';

$success = "";
$error = "";

// --- Handle Form Submission ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hash
    $role     = $_POST['role']; // role_name (e.g., 'teacher' or 'student')

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $error = "Email already registered.";
    } else {
        // Insert into users table
        $stmt = $conn->prepare("INSERT INTO users (name, email, pass) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;

            // Get role ID from roles table
            $role_stmt = $conn->prepare("SELECT id FROM roles WHERE role_name = ?");
            $role_stmt->bind_param("s", $role);
            $role_stmt->execute();
            $role_result = $role_stmt->get_result();

            if ($role_result->num_rows > 0) {
                $role_row = $role_result->fetch_assoc();
                $role_id = $role_row['id'];

                // Insert into user_role table
                $ur_stmt = $conn->prepare("INSERT INTO user_role (user_id, role_id) VALUES (?, ?)");
                $ur_stmt->bind_param("ii", $user_id, $role_id);
                $ur_stmt->execute();
                $ur_stmt->close();
            }

            $role_stmt->close();
            $success = "Registration successful!";
        } else {
            $error = "Error: " . $conn->error;
        }

        $stmt->close();
    }

    $check->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - WebGrading</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Register</h4>
                </div>
                <div class="card-body">
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php elseif ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="register.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Role</label>
                            <select name="role" class="form-select" required>
                                <option value="">-- Select Role --</option>
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    Already have an account? <a href="login.php">Login here</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
