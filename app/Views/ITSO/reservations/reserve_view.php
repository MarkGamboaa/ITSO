<main>
    <div class="itso-container">
        <h2>Reserve Equipment</h2>
        <form class="w-50">
            <div class="mb-3"><label class="form-label">Associate Name / Email</label><input class="form-control" /></div>
            <div class="mb-3"><label class="form-label">Item</label><input class="form-control" placeholder="EQ-002 - DLP" /></div>
            <div class="mb-3"><label class="form-label">Reserve Date</label><input type="date" class="form-control" /></div>
            <div class="mb-3"><label class="form-label">Notes</label><input class="form-control" /></div>
            <p class="text-muted">Reservations must be made at least 1 day in advance.</p>
            <div class="mt-3 d-flex justify-content-end">
                <a href="<?= base_url('reservations') ?>" class="btn btn-secondary me-2">&larr; Back</a>
                <button class="btn btn-success">Reserve</button>
            </div>
        </form>
    </div>
</main>
