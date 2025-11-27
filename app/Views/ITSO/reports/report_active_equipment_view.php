<main>
    <div class="itso-container">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>   
                    <th>Total Count</th>
                    <th>Available Count</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($equipmentList as $equipment): ?>
                <tr>
                    <td><?= $equipment['equipment_id'] ?></td>
                    <td><?= $equipment['name'] ?></td>
                    <td><?= $equipment['total_count'] ?></td>
                    <td><?= $equipment['available_count'] ?></td>
                    <td><?= $equipment['is_active'] ? 'Active' : 'Inactive' ?></td>
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
