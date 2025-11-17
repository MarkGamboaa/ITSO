<main>
    <div class="itso-container">
        <h2>Login</h2>
        <form method="post" class="w-50">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="user@feutech.edu.ph" />
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" />
            </div>
            <button class="btn btn-primary">Login</button>
            <a href="<?= base_url('auth/reset') ?>" class="btn btn-link">Forgot password?</a>
        </form>
    </div>
</main>
