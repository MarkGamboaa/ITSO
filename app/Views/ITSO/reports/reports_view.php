<main>
    <div class="itso-container">
        <h2>Reports</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="itso-card">
                    <h5>Active Equipment</h5>
                    <p class="small-muted">List of currently active (usable) equipment.</p>
                    <div class="text-end">
                        <a href="<?= base_url('reports/activeEquipment') ?>" class="btn btn-primary">View Report</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="itso-card">
                    <h5>Unusable Equipment</h5>
                    <p class="small-muted">Items marked unusable or damaged.</p>
                    <div class="text-end">
                        <a href="<?= base_url('reports/unusableEquipment') ?>" class="btn btn-warning">View Report</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="itso-card">
                    <h5>User Borrowing History</h5>
                    <p class="small-muted">Search borrowing records for a specific user.</p>
                    <div class="text-end">
                        <a href="<?= base_url('reports/userHistory') ?>" class="btn btn-outline-secondary">Open</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
