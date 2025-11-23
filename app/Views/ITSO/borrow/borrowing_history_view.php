<main>
    <div class="itso-container">
        <h2>Borrowing History</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User</th>
                    <th>Item</th>
                    <th>Accessories</th>
                    <th>Quantity</th>
                    <th>Borrowed</th>
                    <th>Returned</th>
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
                    <td><?= date('Y-m-d', strtotime($borrow['returned_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
        <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('borrowing') ?>" class="btn btn-secondary me-2">&larr; Back</a>
        </div>
    </div>
</main>
