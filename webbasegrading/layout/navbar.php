<?php
$isTeacher = isset($_SESSION['role']) && $_SESSION['role'] === 'teacher';
$isStudent = isset($_SESSION['role']) && $_SESSION['role'] === 'student';

include 'header.php';
?>
<!-- Sidebar Navigation -->
<style>
    .sidebar {
    width: 300px;
    min-height: 100vh;
    background-color: #0d6efd;
    color: white;
    transition: width 0.3s ease;
    overflow: hidden;
}

.sidebar.collapsed {
    width: 70px;
}

.sidebar .nav-link {
    color: white;
    padding: 10px 15px;
    display: flex;
    align-items: center;
    white-space: nowrap;
}

.nav-text {
    margin-left: 10px;
    opacity: 1;
    transition: opacity 0.3s ease;
    display: inline-block;
}

.sidebar.collapsed .nav-text {
    opacity: 0;
    width: 0;
    overflow: hidden;
}

.sidebar h4 {
    padding: 10px 15px;
    font-size: 20px;
    transition: opacity 0.3s ease;
}

.sidebar.collapsed h4 {
    opacity: 0;
    width: 0;
    overflow: hidden;
}

.toggle-btn {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    padding: 10px 15px;
    cursor: pointer;
    width: 100%;
    text-align: left;
}

</style>


<div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <h4><?= ucfirst($_SESSION['role']) ?> Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link"><span class="nav-text">Dashboard</span></a>
            </li>
            <?php if ($_SESSION['role'] === 'teacher'): ?>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="nav-text">Manage Grades</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="nav-text">Subjects</span></a>
                </li>
            <?php elseif ($_SESSION['role'] === 'student'): ?>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="nav-text">My Grades</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="nav-text">My Subjects</span></a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a href="logout.php" class="nav-link text-danger"><span class="nav-text">Logout</span></a>
            </li>
        </ul>
    </div>


<?php 
include 'footer.php';
?>