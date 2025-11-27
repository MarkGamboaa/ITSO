<main>
    <div class="itso-container">
        <h2>Edit Equipment</h2>

        <form class="w-50" method="post" action="<?= base_url('equipment/update/'.$equipment['equipment_id']) ?>">
            
            <div class="mb-3">
                <label class="form-label">Item ID</label>
                <input class="form-control" value="<?= esc($equipment['equipment_id']) ?>" disabled />
            </div>

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control" name="name" value="<?= esc($equipment['name']) ?>" />
            </div>

            <div class="mb-3">
                <label class="form-label">Count</label>
                <input type="number" class="form-control" name="total_count" value="<?= esc($equipment['total_count']) ?>" />
            </div>

            <div class="mb-3">
                <label class="form-label">Accessories / Notes</label>
                <input class="form-control" name="accessories" value="<?= esc($equipment['accessories']) ?>" />
            </div>

            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('equipment') ?>" class="btn btn-secondary me-2">
                    Back
                </a>

                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</main>
