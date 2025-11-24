<main>
    <div class="itso-container">
        <h2>Process Return</h2>
        <form class="w-50">
            <div class="mb-3"><label class="form-label">Reference</label><input class="form-control" /></div>
            <div class="mb-3"><label class="form-label">Condition</label>
                <select class="form-select"><option>Good</option><option>Damaged</option><option>Missing Accessory</option></select>
            </div>
            <p class="text-muted">Note: an email would be sent to the borrower upon processing.</p>
            <div class="mt-3 d-flex justify-content-end">
                <a href="<?= base_url('returns') ?>" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <button class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Complete Return
                </button>
            </div>
        </form>
    </div>
</main>
