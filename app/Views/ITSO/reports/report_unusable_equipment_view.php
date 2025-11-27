<main>
    <div class="itso-container">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h2 class="mb-0">Unusable Equipment Report</h2>

        </div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($equipmentList as $equipment): ?>
                <tr>
                    <td><?= $equipment['equipment_id'] ?></td>
                    <td><?= $equipment['name'] ?></td>
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
