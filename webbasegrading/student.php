<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-success text-white p-4" style="width: 250px; min-height: 100vh;">
            <h4 class="mb-4">Student Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link text-white">My Grades</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link text-white">My Subjects</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-danger">Logout</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="p-5 flex-grow-1">
            <h2>Welcome, <?= htmlspecialchars($_SESSION['name']) ?> 🎓</h2>
            <p class="text-muted">This is your student dashboard. Track your grades and check the subjects you're enrolled in.</p>

            <div class="mt-5 row g-4">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Grades</h5>
                            <p class="card-text">See your grades across different subjects.</p>
                            <a href="#" class="btn btn-success">View Grades</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Subjects</h5>
                            <p class="card-text">Check what subjects you're enrolled in this semester.</p>
                            <a href="#" class="btn btn-success">My Subjects</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="mt-5">
                <h5>Your Grade Overview</h5>
                <canvas id="myChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['CCIM','CSDS','CSAC'],
            datasets: [{
                label: 'Your Grades',
                data: [88, 93, 75, 82, 95],
                backgroundColor: ['#198754', '#20c997', '#ffc107', '#0d6efd', '#dc3545'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
    </script> -->
</body>
</html>
