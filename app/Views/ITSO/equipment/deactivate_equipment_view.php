<main>
    <div class="itso-container">
        <h2>Deactivate Equipment</h2>
        <p>Deactivate equipment ID: <?= isset($id) ? esc($id) : 'N/A' ?></p>
        <div class="alert alert-warning">Are you sure you want to deactivate this equipment?</div>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('equipment') ?>" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <button class="btn btn-danger">
                    <i class="bi bi-x-circle"></i> Deactivate
                </button>
            </div>
    </div>
</main>
