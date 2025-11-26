<?php 
include 'includes/header.php'; 
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">User Profile</h3>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                    
                    <hr>

                    <h4 class="mt-4">Change Password</h4>
                    <form action="includes/change_password_handler.php" method="POST">
                        <div class="form-outline mb-4">
                            <input type="password" id="current_password" name="current_password" class="form-control" />
                            <label class="form-label" for="current_password">Current Password</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" id="new_password" name="new_password" class="form-control" />
                            <label class="form-label" for="new_password">New Password</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" id="confirm_new_password" name="confirm_new_password" class="form-control" />
                            <label class="form-label" for="confirm_new_password">Confirm New Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
