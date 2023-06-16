<?php
session_start();
require_once 'index.php';

// Memeriksa apakah pengguna sudah login, jika belum akan diarahkan ke halaman login
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Welcome, <?php echo $_SESSION['user']['username']; ?></h1>

    <?php if (isAdmin()): ?>
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="dis_dashboard.php">Admin DIS</a></li>
            <li><a href="sekretaris_dashboard.php">Admin Sekretaris</a></li>
            <li><a href="kadis_dashboard.php">Admin Kadis</a></li>
            <li><a href="kabid_aptika_dashboard.php">Admin Kabid Aptika</a></li>
            <li><a href="seksi_aplikasi_dashboard.php">Admin Seksi Aplikasi</a></li>
        </ul>
    <?php else: ?>
        <p>User Menu</p>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
</body>

</html>
