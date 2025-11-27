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
                    <th>User ID</th>
                    <th>Fullname</th>
                    <th>Equipment</th>
                    <th>Accessories</th>
                    <th>Borrowed At</th>
                    <th>Returned At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($borrowing as $record): ?>
                <tr>
                    <td><?= $record['user_id'] ?></td>
                    <td><?= $record['user_name'] ?></td>
                    <td><?= $record['equipment_name'] ?></td>
                    <td><?= $record['accessories'] ?></td>
                    <td><?= $record['borrowed_at'] ?></td>
                    <td><?= $record['returned_at'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
        <div class="btn-group">
            <a href="<?= base_url('reports') ?>" class="btn btn-secondary">&larr; Back</a>
            <button class="btn btn-outline-primary">Export CSV</button>
        </div>
    </div>
</main>
