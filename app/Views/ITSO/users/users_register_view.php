<main>
    <div class="itso-container">

        <h2>Register User</h2>
         <?php
        if(session('errors')):
        ?>
        <div class="alert alert-danger">
            <p><?= implode('<br>', session('errors')) ?></p>
        </div>
        <?php
        endif;
        ?>
        <form class="w-50" method="post" action="<?= base_url('users/register') ?>" nonvalidate>
            <div class="mb-3"><label class="form-label">First Name</label><input class="form-control" name="first_name" id="first_name" /></div>
            <div class="mb-3"><label class="form-label">Last Name</label><input class="form-control" name="last_name" id="last_name" /></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" id="email" /></div>
            <div class="mb-3"><label class="form-label">Role</label>
                <select class="form-select" name="role" id="role"><option>ITSO Personnel</option><option>Associate</option><option>Student</option></select>
            </div>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('users') ?>" class="btn btn-secondary me-2">&larr; Back</a>
                <button class="btn btn-success">Register</button>
            </div>
        </form>
    </div>
</main>
