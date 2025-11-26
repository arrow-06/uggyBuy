<?php include 'includes/header.php'; ?>

<main class="container mt-5">
    <h1 class="text-center mb-4">Contact Us</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p class="text-center">Have a question or feedback? Fill out the form below to get in touch with us.</p>
                    <form action="#" method="POST">
                        <div class="form-outline mb-4">
                            <input type="text" id="name" name="name" class="form-control" />
                            <label class="form-label" for="name">Your Name</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" class="form-control" />
                            <label class="form-label" for="email">Your Email</label>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                            <label class="form-label" for="message">Message</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
