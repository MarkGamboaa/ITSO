<main>
    <div class="itso-container">
        <h2>Add Equipment</h2>
        <form class="w-50">
            <div class="mb-3"><label class="form-label">Item ID</label><input class="form-control" placeholder="EQ-000" /></div>
            <div class="mb-3"><label class="form-label">Name</label><input class="form-control" placeholder="Laptop (with charger)" /></div>
            <div class="mb-3"><label class="form-label">Count</label><input type="number" class="form-control" value="1" /></div>
            <div class="mb-3"><label class="form-label">Accessories / Notes</label><input class="form-control" /></div>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('equipment') ?>" class="btn btn-secondary me-2">&larr; Back</a>
                <button class="btn btn-success">Add Item</button>
            </div>
        </form>
    </div>
</main>
