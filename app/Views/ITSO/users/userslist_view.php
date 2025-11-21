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
                    <td><?= $user['user_id'] ?></td>
                    <td><?= $user['last_name'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= $user['is_active'] ?></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="<?= base_url('users/view/' . $user['user_id']) ?>">View</a> 
                        <a class="btn btn-sm btn-secondary" href="<?= base_url('users/edit/' . $user['user_id']) ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="<?= base_url('users/deactivate/' . $user['user_id']) ?>">Deactivate</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
    </div>
</main>
