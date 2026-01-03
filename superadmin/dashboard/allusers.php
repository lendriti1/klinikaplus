<?php
require_once '../../includes/header_superadmin.php';


$message = '';
$message_type = ''; // 'success' or 'error'

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Toggle Status
    if (isset($_GET['action']) && $_GET['action'] === 'toggle_status' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];

        try {
            // Get current status
            $stmt = $pdo->prepare("SELECT status FROM users WHERE id = ?");
            $stmt->execute([$id]);
            $current = $stmt->fetchColumn();

            if ($current === false) {
                $message = 'User not found.';
                $message_type = 'error';
            } else {
                $new_status = $current == 1 ? 0 : 1;

                $update = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
                $update->execute([$new_status, $id]);

                $message = 'User status updated successfully.';
                $message_type = 'success';
            }
        } catch (Exception $e) {
            $message = 'Error updating status.';
            $message_type = 'error';
        }
    }

    // Delete User
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];

        // Prevent self-deletion (Superadmin protecting himself)
        if ($id === $_SESSION['user_id']) {
            $message = 'You cannot delete your own account!';
            $message_type = 'error';
        } else {
            try {
                $delete = $pdo->prepare("DELETE FROM users WHERE id = ?");
                $delete->execute([$id]);

                $message = 'User deleted permanently.';
                $message_type = 'success';
            } catch (Exception $e) {
                $message = 'Error deleting user.';
                $message_type = 'error';
            }
        }
    }
}

$stmt = $pdo->prepare("
    SELECT u.*, r.name AS role_name,
           CASE WHEN u.status = 1 THEN 'Active' ELSE 'Inactive' END AS status_text,
           CASE WHEN u.status = 1 THEN 'bg-green-100 text-green-800' ELSE 'bg-red-100 text-red-800' END AS status_class
    FROM users u 
    LEFT JOIN roles r ON u.role_id = r.id 
    WHERE r.id != 1  
    ORDER BY u.full_name
");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="text-3xl font-bold text-gray-800 mb-8">Manage All Users</h2>

<!-- Success/Error Message -->
<?php if ($message): ?>
    <div class="mb-6 p-4 rounded-lg <?= $message_type === 'success' ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300' ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<!-- Add User Button -->
<!-- <a href="add.php" class="mb-6 inline-block bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-6 rounded-lg shadow transition">
    + Add New User
</a> -->

<!-- Users Table -->
<div class="bg-white rounded-xl shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Full Name</th>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Username</th>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Email</th>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Role</th>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (count($users) === 0): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">No users found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            <?= htmlspecialchars($user['full_name'] ?? '—') ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($user['username']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($user['email']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($user['role_name']) ?></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium <?= $user['status_class'] ?>">
                                <?= $user['status_text'] ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-4">
                            <a href="edit.php?id=<?= $user['id'] ?>" class="text-primary hover:underline">Edit</a>

                            <!-- Toggle Status Button -->
                            <?php if ($user['status'] == 1): ?>
                                <a href="?action=toggle_status&id=<?= $user['id'] ?>"
                                   onclick="return confirm('Deactivate this user? They will not be able to log in.')"
                                   class="text-orange-600 hover:underline">Deactivate</a>
                            <?php else: ?>
                                <a href="?action=toggle_status&id=<?= $user['id'] ?>"
                                   onclick="return confirm('Activate this user? They will be able to log in again.')"
                                   class="text-green-600 hover:underline">Activate</a>
                            <?php endif; ?>

                            <!-- Delete Button (with protection) -->
                            <?php if ($user['id'] !== $_SESSION['user_id']): ?>
                                <a href="?action=delete&id=<?= $user['id'] ?>"
                                   onclick="return confirm('Permanently delete this user? This cannot be undone.')"
                                   class="text-red-600 hover:underline">Delete</a>
                            <?php else: ?>
                                <span class="text-gray-400 text-xs">Can't delete self</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>

<?php

require_once '../../includes/footer.php'; // if you have one
