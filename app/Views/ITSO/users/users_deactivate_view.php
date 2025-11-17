<main>
    <div class="itso-container">
        <h2>Deactivate User</h2>
        <p>Deactivate user ID: <?= isset($id) ? esc($id) : 'N/A' ?></p>
        <div class="alert alert-warning">Are you sure you want to deactivate this user?</div>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('users') ?>" class="btn btn-secondary me-2">&larr; Back</a>
                <button class="btn btn-danger">Deactivate</button>
            </div>
    </div>
</main>
