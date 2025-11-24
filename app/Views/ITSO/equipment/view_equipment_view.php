<main>
    <div class="itso-container">
        <h2>Equipment Details</h2>
        <p>Equipment ID: <?= isset($id) ? esc($id) : 'EQ-001' ?></p>
        <dl class="row">
            <dt class="col-sm-3">Name</dt><dd class="col-sm-9">Laptop (with charger)</dd>
            <dt class="col-sm-3">Count</dt><dd class="col-sm-9">5</dd>
            <dt class="col-sm-3">Accessories</dt><dd class="col-sm-9">Charger</dd>
        </dl>
        <div class="mt-3 d-flex justify-content-start">
            <a href="<?= base_url('equipment') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>
</main>
