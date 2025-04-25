<?php
include 'db.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user info
    $stmt = $conn->prepare("SELECT id, name, pass FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['pass'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];

            // Get role
            $role_stmt = $conn->prepare("
                SELECT r.role_name FROM roles r
                JOIN user_role ur ON r.id = ur.role_id
                WHERE ur.user_id = ?
            ");
            $role_stmt->bind_param("i", $user['id']);
            $role_stmt->execute();
            $role_result = $role_stmt->get_result();

            if ($role_result->num_rows > 0) {
                $role = $role_result->fetch_assoc()['role_name'];
                $_SESSION['role'] = $role;

                // Redirect based on role
                if ($role === 'teacher') {
                    header("Location: teacher.php");
                    exit();
                } elseif ($role === 'student') {
                    header("Location: student.php");
                    exit();
                } else {
                    $error = "Unknown role.";
                }
            } else {
                $error = "No role assigned.";
            }
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - WebGrading</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-success text-white">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>

                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Login</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        Don't have an account? <a href="register.php">Register here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
