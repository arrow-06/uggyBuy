<?php 
include 'includes/header.php'; 
require_once '../database/db_connect.php';

$result = $conn->query("SELECT * FROM coupons ORDER BY id DESC");
?>

<div class="d-flex justify-content-between align-items-center">
    <h1>Coupons</h1>
    <a href="add_coupon.php" class="btn btn-primary">Add New Coupon</a>
</div>

<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
            <th>Code</th>
            <th>Type</th>
            <th>Value</th>
            <th>Expiry Date</th>
            <th>Usage</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($coupon = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($coupon['code']); ?></td>
                    <td><?php echo ucfirst($coupon['type']); ?></td>
                    <td><?php echo $coupon['type'] === 'percentage' ? $coupon['value'] . '%' : '$' . number_format($coupon['value'], 2); ?></td>
                    <td><?php echo $coupon['expiry_date'] ? date('F j, Y', strtotime($coupon['expiry_date'])) : 'N/A'; ?></td>
                    <td><?php echo $coupon['usage_count']; ?> / <?php echo $coupon['usage_limit'] ?? '∞'; ?></td>
                    <td>
                        <a href="edit_coupon.php?id=<?php echo $coupon['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="delete_coupon.php?id=<?php echo $coupon['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">No coupons found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php 
$conn->close();
include 'includes/footer.php'; 
?>
