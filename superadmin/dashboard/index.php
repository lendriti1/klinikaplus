<?php require_once '../../includes/header_superadmin.php'; ?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    <!-- Quick Stats Cards -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
        <p class="text-3xl font-bold text-primary mt-2">
            <?php
            $stmt = $pdo->query("SELECT COUNT(*) FROM users");
echo $stmt->fetchColumn();
?>
        </p>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-700">Total Clinics</h3>
        <p class="text-3xl font-bold text-primary mt-2">
            <?php
$stmt = $pdo->query("SELECT COUNT(*) FROM clinics");
echo $stmt->fetchColumn();
?>
        </p>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-700">Total Doctors</h3>
        <p class="text-3xl font-bold text-primary mt-2">
            <?php
$stmt = $pdo->query("SELECT COUNT(*) FROM doctors");
echo $stmt->fetchColumn();
?>
        </p>
    </div>
</div>

<!-- Management Sections -->
<h2 class="text-2xl font-bold text-gray-800 mb-6">System Management</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <!-- Users -->
    <a href="../user-management/list.php" class="block bg-white rounded-xl shadow hover:shadow-lg transition p-8 text-center">
        <div class="text-primary text-5xl mb-4">👥</div>
        <h3 class="text-xl font-semibold text-gray-800">Manage Users</h3>
        <p class="text-gray-600 mt-2">Superadmin, Admin & Patients</p>
    </a>

    <!-- Clinics -->
    <a href="../clinic-management/list.php" class="block bg-white rounded-xl shadow hover:shadow-lg transition p-8 text-center">
        <div class="text-primary text-5xl mb-4">🏥</div>
        <h3 class="text-xl font-semibold text-gray-800">Manage Clinics</h3>
        <p class="text-gray-600 mt-2">Add, edit, or remove clinics</p>
    </a>

    <!-- Doctors -->
    <a href="../doctors/index.php" class="block bg-white rounded-xl shadow hover:shadow-lg transition p-8 text-center">
        <div class="text-primary text-5xl mb-4">🩺</div>
        <h3 class="text-xl font-semibold text-gray-800">Manage Doctors</h3>
        <p class="text-gray-600 mt-2">View and manage all doctors</p>
    </a>

    <!-- Assistants -->
    <a href="../assistants/index.php" class="block bg-white rounded-xl shadow hover:shadow-lg transition p-8 text-center">
        <div class="text-primary text-5xl mb-4">🩹</div>
        <h3 class="text-xl font-semibold text-gray-800">Manage Assistants</h3>
        <p class="text-gray-600 mt-2">View and manage assistants</p>
    </a>

    <!-- Messages -->
    <a href="inbox.php" class="block bg-white rounded-xl shadow hover:shadow-lg transition p-8 text-center">
        <div class="text-primary text-5xl mb-4">✉️</div>
        <h3 class="text-xl font-semibold text-gray-800">Messages</h3>
        <p class="text-gray-600 mt-2">Inbox, Sent & Compose</p>
    </a>

    <!-- Roles Overview -->
    <div class="block bg-white rounded-xl shadow hover:shadow-lg transition p-8 text-center">
        <div class="text-primary text-5xl mb-4">🔐</div>
        <h3 class="text-xl font-semibold text-gray-800">System Roles</h3>
        <ul class="text-left text-gray-600 mt-4 space-y-1 text-sm">
            <li>✓ Superadmin (Full access)</li>
            <li>✓ Admin (Limited management)</li>
            <li>✓ User (Patient portal)</li>
            <li>• Doctor (Managed entity)</li>
            <li>• Assistant (Managed entity)</li>
        </ul>
    </div>
</div>

<?php require_once '../../includes/footer.php'; // if you have one?>
