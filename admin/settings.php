<?php include 'includes/header.php'; ?>

<h1>Settings</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Payment Gateway Settings</h5>
        <form>
            <div class="form-outline mb-4">
                <input type="text" id="stripe_key" class="form-control" />
                <label class="form-label" for="stripe_key">Stripe API Key</label>
            </div>
            <div class="form-outline mb-4">
                <input type="text" id="paypal_key" class="form-control" />
                <label class="form-label" for="paypal_key">PayPal API Key</label>
            </div>
            <button type="submit" class="btn btn-primary">Save Payment Settings</button>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Tax Settings</h5>
        <form>
            <div class="form-outline mb-4">
                <input type="number" id="gst" class="form-control" />
                <label class="form-label" for="gst">GST/VAT %</label>
            </div>
            <button type="submit" class="btn btn-primary">Save Tax Settings</button>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Website Branding</h5>
        <form>
            <div class="form-outline mb-4">
                <input type="text" id="website_name" class="form-control" />
                <label class="form-label" for="website_name">Website Name</label>
            </div>
            <div class="mb-4">
                <label class="form-label" for="logo">Logo</label>
                <input type="file" class="form-control" id="logo" />
            </div>
            <button type="submit" class="btn btn-primary">Save Branding</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
