<main>
    <div class="itso-container">
        <h2>Reserve Equipment</h2>
        <?php
        if(session('errors')):
        ?>
        <div class="alert alert-danger">
            <p><?= implode('<br>', session('errors')) ?></p>
        </div>
        <?php
        endif;
        ?>
        <form class="w-50" method="post" action="<?= base_url('reservations/insert') ?>">
            <div class="mb-3"><label class="form-label">Associate Email</label><input class="form-control" name="email" /></div>
            <div class="mb-3"><label class="form-label">Item</label><input class="form-control" name="equipment_id" placeholder="EQ-002 - DLP"  /></div>
            <div class="mb-3"><label class="form-label">Quantity</label><input type="number" class="form-control" name="quantity" min="1" value="1" /></div>
            <div class="mb-3"><label class="form-label">Reserve Date</label><input type="date" class="form-control" name="reserved_date" /></div>
            <p class="text-muted">Reservations must be made at least 1 day in advance.</p>
            <div class="mt-3 d-flex justify-content-end">
                <a href="<?= base_url('reservations') ?>" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <button class="btn btn-success" type="submit">
                    <i class="bi bi-check-circle"></i> Reserve
                </button>
            </div>
        </form>
    </div>
</main>
