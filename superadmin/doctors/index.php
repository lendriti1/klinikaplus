<?php
require_once '../../includes/header_superadmin.php';
require_once '../../includes/db.php';

// Fetch all doctors with clinic name
$stmt = $pdo->query("
    SELECT d.*, c.name AS clinic_name 
    FROM doctors d 
    LEFT JOIN clinics c ON d.clinic_id = c.id 
    ORDER BY d.last_name
");
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch clinics for the Add Modal
$clinics_stmt = $pdo->query("SELECT id, name FROM clinics ORDER BY name");
$clinics = $clinics_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="text-3xl font-bold text-gray-800 mb-8">Manage Doctors</h2>

<!-- Add Doctor Button -->
<button onclick="openModal()" class="mb-6 bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-6 rounded-lg shadow transition">
    + Add New Doctor
</button>

<!-- Doctors Table -->
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Name</th>
                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">License</th>
                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Specialization</th>
                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Clinic</th>
                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Phone</th>
                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php if (count($doctors) == 0): ?>
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">No doctors found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($doctors as $doc): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        <?= htmlspecialchars($doc['first_name'] . ' ' . $doc['last_name']) ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($doc['license_number']) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($doc['specialization']) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($doc['clinic_name'] ?? '—') ?></td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($doc['phone'] ?? '—') ?></td>
                    <td class="px-6 py-4 text-sm">
                        <a href="edit.php?id=<?= $doc['id'] ?>" class="text-primary hover:underline mr-4">Edit</a>
                        <a href="delete.php?id=<?= $doc['id'] ?>" 
                           onclick="return confirm('Are you sure you want to delete this doctor?')"
                           class="text-red-600 hover:underline">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Add Doctor Modal -->
<div id="addDoctorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Add New Doctor</h3>
        <form action="add.php" method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="first_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="last_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">License Number</label>
                    <input type="text" name="license_number" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Specialization</label>
                    <input type="text" name="specialization" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Personal ID</label>
                    <input type="text" name="personal_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="tel" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Clinic</label>
                    <select name="clinic_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                        <?php foreach ($clinics as $clinic): ?>
                            <option value="<?= $clinic['id'] ?>"><?= htmlspecialchars($clinic['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-4">
                <button type="button" onclick="closeModal()" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg transition font-medium">
                    Save Doctor
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('addDoctorModal').classList.remove('hidden');
    document.getElementById('addDoctorModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('addDoctorModal').classList.add('hidden');
    document.getElementById('addDoctorModal').classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('addDoctorModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>

</div>
</body>
</html>