<?php
include_once 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['status'])) {
    header("Location: ../../logout.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superadmin - KlinikaPlus</title>
  <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#C62828',
                        'primary-dark': '#B71C1C',
                    }
                }
            }
        }
    </script>
    
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Top Navigation -->
    <header class="bg-primary text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-8">
                <h1 class="text-2xl font-bold">KlinikaPlus</h1>
                <nav class="hidden md:flex space-x-6">
                    <a href="index.php" class="hover:text-gray-200 transition">Dashboard</a>
                    <a href="allusers.php" class="hover:text-gray-200 transition">All Users</a>
                </nav>
            </div>
            <div class="flex items-center space-x-6">
                <span class="text-sm">Superadmin: <?php echo $_SESSION['username'] ?></span>
                <a href="../../logout.php" class="bg-white text-primary px-4 py-2 rounded-lg hover:bg-gray-100 transition font-medium">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <div class="max-w-7xl mx-auto px-6 py-8">