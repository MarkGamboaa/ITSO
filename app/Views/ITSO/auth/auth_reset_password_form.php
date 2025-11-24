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
                            <h2 class="mb-2">Reset Password</h2>
                            <?php if(session('errors')):?>
                            <div class="alert alert-danger">
                                <p><?= implode('<br>', session('errors')) ?></p>
                            </div>
                            <?php endif;?>
                            <p class="text-muted small">Enter your new password.</p>

                            <form method="post" action="<?= base_url('auth/update_password') ?>">
                                <input type="hidden" name="email" value="<?= esc($email) ?>">
                                
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control"/>
                                </div>

                                <div class="mb-4">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control"/>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left"></i> Back to Login
                                    </a>
                                    <button type="submit" class="btn btn-success" style="background:var(--feu-green);border:0">
                                        <i class="bi bi-key"></i> Reset Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>