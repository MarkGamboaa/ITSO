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
                    <th>User ID</th>
                    <th>User</th>
                    <th>Item</th>
                    <th>Accessories</th>
                    <th>Quantity</th>
                    <th>Date Borrowed</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($borrowing as $borrow): ?>
                <tr>
                    <td><?= $borrow['user_id'] ?></td>
                    <td><?= $borrow['user_name'] ?></td>
                    <td><?= $borrow['equipment_name'] ?></td>
                    <td><?= $borrow['accessories'] ?></td>
                    <td><?= $borrow['borrow_quantity'] ?></td>
                    <td><?= date('Y-m-d', strtotime($borrow['borrowed_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
    </div>
</main>
