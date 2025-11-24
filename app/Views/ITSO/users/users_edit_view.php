<main>
    <div class="itso-container">
        <h2>Edit User</h2>
        <?php
        if(session('errors')):
        ?>
        <div class="alert alert-danger">
            <p><?= implode('<br>', session('errors')) ?></p>
        </div>
        <?php
        endif;
        ?>
        <form class="w-50" action="<?= base_url('users/update/' . $user['user_id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3"><label class="form-label">First Name</label><input class="form-control" name="first_name" id="first_name" value="<?= esc($user['first_name']) ?>" /></div>
            <div class="mb-3"><label class="form-label">Last Name</label><input class="form-control" name="last_name" id="last_name" value="<?= esc($user['last_name']) ?>" /></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" id="email" value="<?= esc($user['email']) ?>" /></div>
            <div class="mb-3"><label class="form-label">Role</label>
                <select class="form-select" name="role" id="role">
                    <option value="Associate" <?= $user['role'] == 'Associate' ? 'selected' : '' ?>>Associate</option>
                    <option value="Student" <?= $user['role'] == 'Student' ? 'selected' : '' ?>>Student</option>
                </select>
            </div>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('users/') ?>" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</main>
