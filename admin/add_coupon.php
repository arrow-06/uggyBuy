<?php include 'includes/header.php'; ?>

<h1>Add New Coupon</h1>

<form action="includes/coupon_handler.php" method="POST">
    <input type="hidden" name="action" value="add">
    <div class="form-outline mb-4">
        <input type="text" id="code" name="code" class="form-control" required />
        <label class="form-label" for="code">Coupon Code</label>
    </div>
    <div class="form-outline mb-4">
        <select name="type" class="form-select" required>
            <option value="percentage">Percentage</option>
            <option value="flat">Flat Amount</option>
        </select>
    </div>
    <div class="form-outline mb-4">
        <input type="number" id="value" name="value" class="form-control" step="0.01" required />
        <label class="form-label" for="value">Value</label>
    </div>
    <div class="form-outline mb-4">
        <input type="date" id="expiry_date" name="expiry_date" class="form-control" />
        <label class="form-label" for="expiry_date">Expiry Date (optional)</label>
    </div>
    <div class="form-outline mb-4">
        <input type="number" id="usage_limit" name="usage_limit" class="form-control" />
        <label class="form-label" for="usage_limit">Usage Limit (optional)</label>
    </div>
    <button type="submit" class="btn btn-primary">Add Coupon</button>
</form>

<?php include 'includes/footer.php'; ?>
