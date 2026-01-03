

<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password_hash, role_id,status FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $password === $user['password_hash']) {

        if ($user['status'] == 0) {
            $error = "Your account is inactive. Contact administrator.";
            // Show error on login page
        } else {
            // Proceed with session set
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['role_name'] = $user['role_name'];  // or fetch from roles
            $_SESSION['username'] = $user['username'];
            $_SESSION['status'] = $user['status'];
            // Redirect based on role


            // Role-based redirect
            $redirects = [
                1 => 'superadmin/dashboard/index.php',  // Superadmin
                2 => 'admin/dashboard/index.php',       // Admin
                5 => 'user/dashboard/index.php'         // Patient
            ];
            $url = $redirects[$user['role_id']] ?? 'user/dashboard/index.php';
            header("Location: $url");
            exit;
        }

    } else {
        header("Location: lo3gin.php?error=1");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KlinikaPlus</title>
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
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-primary">KlinikaPlus</h1>
            <p class="text-gray-600 mt-2">Sign in to your account</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                Invalid username or password.
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Username</label>
                <input type="text" name="username" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <button type="submit" 
                    class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-4 rounded-lg transition duration-200">
                Sign In
            </button>
        </form>

        <!-- Demo Credentials -->
        <div class="mt-10 bg-gray-50 rounded-lg p-6 border border-gray-200">
            <h3 class="font-semibold text-gray-800 mb-3">Demo Credentials (Password: password123 for all)</h3>
            <ul class="text-sm text-gray-600 space-y-2">
                <li><strong>Superadmin:</strong> superadmin</li>
                <li><strong>Admin:</strong> admin</li>
                <li><strong>Patient 1:</strong> patient1</li>
                <li><strong>Patient 2:</strong> patient2</li>
                <li><strong>Patient 3:</strong> patient3</li>
            </ul>
        </div>

        <p class="text-center text-gray-500 text-sm mt-8">
            © 2026 KlinikaPlus
        </p>
    </div>
</body>
</html>