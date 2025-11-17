<main>
    <div class="itso-container">
        <h2>Borrow Item</h2>
        <form class="w-50">
            <div class="mb-3"><label class="form-label">Borrower (Associate / Student)</label><input class="form-control" /></div>
            <div class="mb-3"><label class="form-label">Item</label><input class="form-control" placeholder="EQ-001 - Laptop" /></div>
            <div class="mb-3"><label class="form-label">Duration (days)</label><input type="number" class="form-control" value="1" /></div>
            <div class="mb-3"><label class="form-label">Include Accessories</label>
                <div class="form-check"><input class="form-check-input" type="checkbox" id="acc1" /><label class="form-check-label" for="acc1">Charger</label></div>
            </div>
            <p class="text-muted">Note: when an item is borrowed, an email would be sent.</p>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('borrowing') ?>" class="btn btn-secondary me-2">&larr; Back</a>
                <button class="btn btn-success">Confirm Borrow</button>
            </div>
        </form>
    </div>
</main>
