<main>
    <div class="itso-container">
        <h2>Equipment Details</h2>

        <p>
            Equipment ID: <?= esc($equipment['equipment_id']) ?>
        </p>

        <dl class="row">
            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9"><?= esc($equipment['name']) ?></dd>

            <dt class="col-sm-3">Total Count</dt>
            <dd class="col-sm-9"><?= esc($equipment['total_count']) ?></dd>

            <dt class="col-sm-3">Available</dt>
            <dd class="col-sm-9"><?= esc($equipment['available_count']) ?></dd>

            <dt class="col-sm-3">Accessories</dt>
            <dd class="col-sm-9">
                <?= $equipment['accessories'] ? esc($equipment['accessories']) : 'None' ?>
            </dd>
        </dl>

        <div class="mt-3 d-flex justify-content-start">
            <a href="<?= base_url('equipment') ?>" class="btn btn-secondary">&larr; Back</a>
        </div>
    </div>
</main>