<main>
    <div class="itso-container">
        <h2>Returns</h2>
        <a href="<?= base_url('returns/process') ?>" class="btn btn-primary mb-3">
            <i class="bi bi-arrow-return-left"></i> Process Return
        </a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Fullname</th>
                    <th>Equipment</th>
                    <th>Accessories</th>
                    <th>Return Condition</th>
                    <th>Date Returned</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($returnedItems as $item): ?>
                <tr>
                    <td><?= esc($item['id']) ?></td>
                    <td><?= esc($item['first_name'] . ' ' . $item['last_name']) ?></td>
                    <td><?= esc($item['name']) ?></td>
                    <td><?= esc($item['accessories']) ?></td>
                    <td><?= esc($item['return_condition']) ?></td>
                    <td><?= esc($item['returned_at']) ?></td>
                    <td><?= esc($item['status']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
