<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}
include 'layout/header.php';
include 'layout/navbar.php';
?>


        <!-- Content -->
        <div class="p-5 flex-grow-1">
            <h2>Welcome, <?= htmlspecialchars($_SESSION['name']) ?> 👨‍🏫</h2>
            <p class="text-muted">This is your teacher dashboard. From here, you can manage student grades and view assigned subjects.</p>

            <div class="mt-5 row g-4">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Grade Management</h5>
                            <p class="card-text">Enter and review student performance in each subject.</p>
                            <a href="#" class="btn btn-primary">Go to Grades</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Subjects</h5>
                            <p class="card-text">View and manage the subjects you're teaching.</p>
                            <a href="#" class="btn btn-primary">View Subjects</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="mt-5">
                <h5>Class Average Grades</h5>
                <canvas id="myChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['CCIM','CSDS','CSAC'],
            datasets: [{
                label: 'Average Grade',
                data: [85, 90, 78, 88, 92],
                backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#20c997'],
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
    </script>

<?php 
include 'layout/footer.php';
?>
