<main>
    <div class="itso-container">
        <h2>Borrowing</h2>
        <p>Current borrowed items and quick actions.</p>
            <div class="mb-3 d-flex gap-2">
                <a href="<?= base_url('borrowing/borrow') ?>" class="btn btn-primary">Borrow Item</a>
                <a href="<?= base_url('borrowing/history') ?>" class="btn btn-outline-secondary">Borrowing History</a>
            </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>User</th>
                    <th>Item</th>
                    <th>Date Borrowed</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>BR-001</td>
                    <td>Marlon Viluz</td>
                    <td>Laptop (EQ-001)</td>
                    <td>2025-11-15</td>
                    <td>Borrowed</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
