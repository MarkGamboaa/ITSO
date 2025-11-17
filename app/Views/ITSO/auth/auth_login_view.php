<main>
    <div class="itso-container">
        <h2>Login</h2>

        <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('msg')) ?></div>
        <?php endif; ?>
        <form method="post" action="<?= base_url('auth/login') ?>" class="w-50">
             <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label" name="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="user@feutech.edu.ph" />
            </div>
            <div class="mb-3">
                <label class="form-label" name="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="<?= base_url('auth/reset') ?>" class="btn btn-link">Forgot password?</a>
            
        </form>
    </div>
</main>
