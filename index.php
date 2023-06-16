<?php
session_start();

// Fungsi untuk memeriksa apakah pengguna telah login
function isLoggedIn()
{
    return isset($_SESSION['user']);
}

// Fungsi untuk memeriksa apakah pengguna adalah admin
function isAdmin()
{
    return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin';
}

// Fungsi untuk memeriksa apakah pengguna adalah admin dengan jabatan tertentu
function isAdminWithRole($role)
{
    return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin' && $_SESSION['user']['admin_role'] == $role;
}

// Fungsi untuk menampilkan pesan kesalahan
function displayErrorMessage($message)
{
    echo '<div style="color: red;">' . $message . '</div>';
}

// Fungsi untuk menampilkan pesan sukses
function displaySuccessMessage($message)
{
    echo '<div style="color: green;">' . $message . '</div>';
}

// Fungsi untuk logout
function logout()
{
    session_destroy();
    header('Location: login.php');
    exit();
}
