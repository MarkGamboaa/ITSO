<main>
    <div class="itso-container">

        <h2>Register User</h2>
        <form class="w-50">
            <div class="mb-3"><label class="form-label">Full Name</label><input class="form-control" /></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" /></div>
            <div class="mb-3"><label class="form-label">Role</label>
                <select class="form-select"><option>ITSO Personnel</option><option>Associate</option><option>Student</option></select>
            </div>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('users') ?>" class="btn btn-secondary me-2">&larr; Back</a>
                <button class="btn btn-success">Register</button>
            </div>
        </form>
    </div>
</main>
