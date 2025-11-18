<main>
    <div class="itso-container">
        <h2>Users</h2>
        <a href="<?= base_url('users/register') ?>" class="btn btn-success mb-3">Register New User</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['fullname'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= $user['status'] ?></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="<?= base_url('users/view/' . $user['id']) ?>">View</a> 
                        <a class="btn btn-sm btn-secondary" href="<?= base_url('users/edit/' . $user['id']) ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="<?= base_url('users/deactivate/' . $user['id']) ?>">Deactivate</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
    </div>
</main>
