<main>
    <div class="itso-container">
        <h2>Users</h2>
        <a href="<?= base_url('users/register') ?>" class="btn btn-success mb-3">
            <i class="bi bi-person-plus"></i> Register New User
        </a>
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
                    <td><?= $user['is_active'] == 1 ? 'Active' : 'Deactivated' ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a class="btn btn-sm" 
                               style="background-color: #007bff; color: #fff; border: 1px solid #007bff;"
                               href="<?= base_url('users/view/' . $user['user_id']) ?>">
                                <i class="bi bi-eye"></i> View
                            </a> 
                            <a class="btn btn-sm" 
                               style="background-color: #6c757d; color: #fff; border: 1px solid #6c757d;"
                               href="<?= base_url('users/edit/' . $user['user_id']) ?>">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a class="btn btn-sm" 
                               style="background-color: #dc3545; color: #fff; border: 1px solid #dc3545;"
                               href="<?= base_url('users/deactivate/' . $user['user_id']) ?>">
                                <i class="bi bi-person-x"></i> Deactivate
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
    </div>
</main>
