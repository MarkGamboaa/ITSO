<main>
    <div class="itso-container">
        <h2>Add Equipment</h2>
        
        <?php if(session('errors')): ?>
        <div class="alert alert-danger">
            <p><?= implode('<br>', session('errors')) ?></p>
        </div>
        <?php endif; ?>

        <form class="w-50" method="post" action="<?= base_url('equipment/insert') ?>">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control" placeholder="Laptop (with charger)" name="name"/>
            </div>

            <div class="mb-3">
                <label class="form-label">Count</label>
                <input type="number" class="form-control" value="1" name="count" />
            </div>

            <div class="mb-3">
                <label class="form-label">Accessories / Notes</label>
                <input class="form-control" name="accessories"/>
            </div>

            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('equipment') ?>" class="btn btn-secondary me-2">&larr; Back</a>
                <button class="btn btn-success">Add Item</button>
            </div>
        </form>
    </div>
</main>
