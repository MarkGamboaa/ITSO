<main>
    <div class="itso-container">
        <h2>Equipment Management</h2>
        <a href="<?= base_url('equipment/add') ?>" class="btn btn-success mb-3">Add Equipment</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($equipment)): ?>
                    <?php foreach ($equipment as $item): ?>
                        <tr>
                            <td><?= $item['equipment_id']  ?></td>
                            <td><?= esc($item['name']) ?></td>
                            <td><?= esc($item['available_count']) ?> / <?= esc($item['total_count']) ?></td>
                            <td><?= $item['is_active'] ? 'Available' : 'Inactive' ?></td>
                            <td class="d-flex gap-2">
                                <a class="btn btn-sm btn-primary" href="<?= base_url('equipment/view/'.$item['equipment_id']) ?>">View</a>
                                <a class="btn btn-sm btn-secondary" href="<?= base_url('equipment/edit/'.$item['equipment_id']) ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="<?= base_url('equipment/deactivate/'.$item['equipment_id']) ?>">Deactivate</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">No equipment found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
