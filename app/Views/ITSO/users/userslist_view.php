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
                <tr>
                    <td>1</td>
                    <td>Marlon Viluz</td>
                    <td>Student</td>
                    <td>Active</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="<?= base_url('users/view/1') ?>">View</a> 
                        <a class="btn btn-sm btn-secondary" href="<?= base_url('users/edit/1') ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="<?= base_url('users/deactivate/1') ?>">Deactivate</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>JayCee</td>
                    <td>Associate</td>
                    <td>Active</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="<?= base_url('users/view/1') ?>">View</a> 
                        <a class="btn btn-sm btn-secondary" href="<?= base_url('users/edit/1') ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="<?= base_url('users/deactivate/1') ?>">Deactivate</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
