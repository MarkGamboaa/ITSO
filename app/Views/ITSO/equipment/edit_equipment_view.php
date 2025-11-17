<main>
    <div class="itso-container">
        <h2>Edit Equipment</h2>
        <form class="w-50">
            <div class="mb-3"><label class="form-label">Item ID</label><input class="form-control" value="EQ-001" disabled /></div>
            <div class="mb-3"><label class="form-label">Name</label><input class="form-control" value="Laptop (with charger)" /></div>
            <div class="mb-3"><label class="form-label">Count</label><input type="number" class="form-control" value="5" /></div>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('equipment') ?>" class="btn btn-secondary me-2">&larr; Back</a>
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</main>
