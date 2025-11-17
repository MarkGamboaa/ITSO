<main>
    <div class="itso-container">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h2 class="mb-0">User Borrowing History</h2>
        </div>
        <form class="w-50 mb-4">
            <div class="mb-3"><label class="form-label">User Email</label><input class="form-control" /></div>
            <div class="d-flex justify-content-start gap-2">
                <button class="btn btn-primary">Search</button>
                <a href="<?= base_url('reports/userHistory') ?>" class="btn btn-outline-secondary">Clear</a>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Item</th>
                    <th>Borrowed</th>
                    <th>Returned</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>BR-001</td>
                    <td>Laptop (EQ-001)</td>
                    <td>2025-10-15</td>
                    <td>2025-11-17</td>
                </tr>
            </tbody>
        </table>
        <div class="btn-group">
            <a href="<?= base_url('reports') ?>" class="btn btn-secondary">&larr; Back</a>
            <button class="btn btn-outline-primary">Export CSV</button>
        </div>
    </div>
</main>
