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
                <tr>
                    <td>EQ-001</td>
                    <td>Laptop (with charger)</td>
                    <td>5</td>
                    <td>Available</td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-sm btn-primary" href="<?= base_url('equipment/view/EQ-001') ?>">View</a>
                        <a class="btn btn-sm btn-secondary" href="<?= base_url('equipment/edit/EQ-001') ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="<?= base_url('equipment/deactivate/EQ-001') ?>">Deactivate</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
