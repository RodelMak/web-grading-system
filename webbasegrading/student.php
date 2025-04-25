<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}
include 'layout/header.php';
include 'layout/navbar.php';
?>


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

<?php 
include 'layout/footer.php';
?>
