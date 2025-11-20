<main class="d-flex align-items-center justify-content-center min-vh-100 py-5" style="background-color: #0ea75aff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="row g-0 shadow rounded overflow-hidden h-100" style="min-height: 400px;">
                    <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center h-100" style="background:var(--feu-green);">
                        <div class="text-center px-4">
                            <img src="<?= base_url('/public/images/FEU_Logo.png') ?>" alt="FEU ITSO" class="img-fluid rounded-circle" style="max-width:180px">
                            <h3 class="text-white mt-3">FEU Institute of Technology</h3>
                            <p class="text-white-50 small">IT Support Office</p>
                        </div>
                    </div>

                    <div class="col-md-7 bg-white p-4 d-flex align-items-center h-100">
                        <div class="w-100">
                            <h2 class="mb-2">Password Reset</h2>
                            <p class="text-muted small">Enter your email to receive a reset link.</p>

                            <form method="post">
                                <div class="mb-4">
                                    <input type="email" name="email" class="form-control" placeholder="E-Mail" required />
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-secondary">&larr; Back</a>
                                    <button type="submit" class="btn btn-success" style="background:var(--feu-green);border:0">Send Reset Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
