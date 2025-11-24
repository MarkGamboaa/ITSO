<main>
    <div class="itso-container">
        <h2>Manage Reservations</h2>
        <p>Cancel or reschedule existing reservations (mock).</p>
        <table class="table">
            <thead><tr><th>Ref</th><th>Associate</th><th>Item</th><th>Date</th><th>Actions</th></tr></thead>
            <tbody>
                <tr><td>RSV-001</td><td>Anna</td><td>DLP</td><td>2025-11-20</td><td><button class="btn btn-sm btn-warning">Reschedule</button> <button class="btn btn-sm btn-danger">Cancel</button></td></tr>
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-end">
            <a href="<?= base_url('reservations') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>
</main>
