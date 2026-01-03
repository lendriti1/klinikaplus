<?php
session_start();
if (isset($_SESSION['user_id'])) {
    // Redirect logged-in users to their role dashboard
    $role_redirect = [
        1 => 'superadmin/dashboard/index.php',
        2 => 'admin/dashboard/index.php',
        // Add others when implemented
        5 => 'user/dashboard/index.php'
    ];
    $redirect = $role_redirect[$_SESSION['role_id']] ?? '/user/dashboard/index.php';
    header("Location: $redirect");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KlinikaPlus - Healthcare Management System</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <!-- Logo -->
        <div class="mb-8">
            <h1 class="text-6xl font-bold text-primary mb-2">KlinikaPlus</h1>
            <p class="text-gray-600 text-xl">Modern Healthcare Management System</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-12">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Welcome to KlinikaPlus</h2>
            <p class="text-gray-600 mb-10 leading-relaxed">
                Manage clinics, doctors, assistants, and patients efficiently with role-based access.<br>
                Secure, modern, and built for healthcare professionals.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="login.php" class="bg-primary hover:bg-primary-dark text-white font-semibold py-4 px-10 rounded-lg transition duration-200 shadow-lg">
                    Login to Dashboard
                </a>
                <a href="#" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-4 px-10 rounded-lg transition duration-200">
                    Learn More
                </a>
            </div>
        </div>

        <footer class="mt-16 text-gray-500 text-sm">
            © 2026 KlinikaPlus. All rights reserved.
        </footer>
    </div>
</body>
</html>