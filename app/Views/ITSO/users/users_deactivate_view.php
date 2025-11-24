<main>
    <div class="itso-container">
        <h2>Deactivate User</h2>
        <p>Deactivate user ID: <?= isset($id) ? esc($id) : 'N/A' ?></p>
        <div class="alert alert-warning">Are you sure you want to deactivate this user?</div>
        <form method="post" action="<?= base_url('users/confirmDeactivate/' . esc($id)) ?>">
            <?= csrf_field() ?>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('users') ?>" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <button class="btn btn-danger" type="submit">
                    <i class="bi bi-person-x"></i> Deactivate
                </button>
            </div>
        </form>
    </div>
</main>
