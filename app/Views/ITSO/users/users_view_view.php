<main>
    <div class="itso-container">

        <h2>User Details</h2>
        <dl class="row">
            <dt class="col-sm-3">ID</dt><dd class="col-sm-9" id="user_id"><?= $user['user_id']?></dd>
            <dt class="col-sm-3">First Name</dt><dd class="col-sm-9" id="first_name"><?= $user['first_name']?></dd>
            <dt class="col-sm-3">Last Name</dt><dd class="col-sm-9" id="last_name"><?= $user['last_name']?></dd>
            <dt class="col-sm-3">Email</dt><dd class="col-sm-9" id="email"> <?= $user['email']?></dd>
            <dt class="col-sm-3">Role</dt><dd class="col-sm-9" id="role"><?= $user['role']?></dd>
        </dl>
        <a href="<?= base_url('users') ?>" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</main>
