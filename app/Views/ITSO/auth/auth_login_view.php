<main class="d-flex align-items-center justify-content-center min-vh-100 py-5" style="background-color: #0ea75aff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="row g-0 shadow rounded overflow-hidden" style="min-height: 400px;">
                    <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center" style="background:var(--feu-green);">
                        <div class="text-center px-4">
                            <img src="<?= base_url('/public/images/FEU_Logo.png') ?>" alt="FEU ITSO" class="img-fluid rounded-circle" style="max-width:180px">
                            <h3 class="text-white mt-3">FEU Institute of Technology</h3>
                            <p class="text-white-50 small">IT Support Office</p>
                        </div>
                    </div>

                    <div class="col-md-7 bg-white p-4 d-flex align-items-center">
                        <div class="w-100">
                            <h2 class="mb-4">Sign In</h2>

                            <?php if (session()->getFlashdata('msg')): ?>
                                <div class="alert alert-danger"><?= esc(session()->getFlashdata('msg')) ?></div>
                            <?php endif; ?>

                            <form method="post" action="<?= base_url('auth/login') ?>">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="E-Mail" />
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <button type="submit" class="btn btn-success" style="background:var(--feu-green);border:0">LOGIN</button>
                                    <a href="<?= base_url('auth/reset') ?>" class="btn btn-link">Forgot Password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>